<?php

namespace App\Controllers;

use Config\MyFunctions as ConfigMyFunctions;
use App\Models\EventsModel;
use App\Models\ProjectsModel;
use App\Models\ReportsModel;
use App\Models\ReportsPaginatedModel;

class Reports extends BaseController
{

    public function index()
    {
        $conn = db_connect();

        $user = $_SESSION['user'];
        $user_id = $user['user_id'];
        $user_level = $user['level'];

        $data = [];

        $conn = db_connect();
        $model = new ReportsPaginatedModel();
        $eventsModel = new EventsModel($conn);
        $projectsModel = new ProjectsModel($conn);

        if ($user_level < 4) {
            $data = [

                'reports' => $model->where(['reports.deleted_flag' => 0])
                    ->join('events', 'reports.report_event = events.event_id', 'left')
                    ->join('project', 'reports.report_project = project.project_id', 'left')
                    ->join('user', 'reports.created_by = user.user_id', 'left')
                    ->orderBy('reports.report_id', 'ASC')
                    ->paginate(10),
                'events' => $eventsModel->getEvents(),
                'availableProjects' => $projectsModel->getProjects(),
                'pager' => $model->pager,
            ];
        } else {
            $data = [

                'reports' => $model->where(['reports.created_by' => $user_id, 'reports.deleted_flag' => 0])
                    ->join('project', 'reports.report_project = project.project_id', 'left')
                    ->join('members', 'reports.created_by = members.user_id', 'left')
                    ->orderBy('reports.report_id', 'ASC')
                    ->paginate(10),
                'events' => $eventsModel->getEvents(),
                'availableProjects' => $projectsModel->getMemberLedProject($user_id),
                'pager' => $model->pager,
            ];
        }

        // print_r($data['projects']);
        if (empty($data['reports'])) {
            $data['none'] = 'No Reports Found.';
            return (view('reports', $data));
        } else {
            return view('reports', $data);
        }
    }

    public function addReport()
    {
        if ($this->request->getMethod() == 'post') {

            helper(['form']);
            $data = [];
            $rules = [
                'file' => [
                    'rules' => 'uploaded[file]',
                    'label' => 'File',
                    'errors' => [
                        'uploaded' => 'Please Upload at least 1 File.',
                    ]
                ],

                'description' => [
                    'rules' => 'required',
                    'label' => 'Description',
                    'errors' => [
                        'required' => 'Description Field Cannot be Empty.',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $created_by = $user_data['user_id'];
                if (isset($_POST['event_id'])) {
                    $event_id = ($_POST['event_id']);
                } else {
                    $event_id = 'NULL';
                }

                if (isset($_POST['project_id'])) {
                    $project_id = ($_POST['project_id']);
                } else {
                    $project_id = 'NULL';
                }
                $description = $_POST['description'];

                // User Image Uploading
                $file = $this->request->getFile('file');
                $filename = '';

                if ($file->isValid() && !$file->hasMoved()) {
                    $name = $file->getRandomName();
                    $file->move('./uploads/reports', "$name");

                    $filename = $file->getName();
                }

                $conn = db_connect();
                $model = new ReportsModel($conn);

                $insertionData = [
                    'report_id' => "RP" . ConfigMyFunctions::generateID(),
                    'file' => json_encode($filename),
                    'report_event' => $event_id,
                    'report_project' => $project_id,
                    'report_description' => json_encode($description),
                    'created_by' => $created_by,
                ];

                $result = $model->addReport($insertionData);

                // $existingReports = $model->getGallery($event_id); 

                // if (!empty($existingPhotos)) {
                //     // There are existing photos for the event_id
                //     $existingPhotosForEvent = $existingPhotos[0]['photos'];
                //     $existingPhotosArray = json_decode($existingPhotosForEvent, true);
                //     $updatedPhotosArray = array_merge($existingPhotosArray, $filenames);

                //     $insertionData = [
                //         'event_id' => $event_id,
                //         'photos' => json_encode($updatedPhotosArray),
                //         'created_by' => $created_by,
                //     ];

                //     $result = $model->updateGallery($insertionData, $event_id); 
                // } else {
                //     // No existing photos for the event_id
                //     $insertionData = [
                //         'event_id' => $event_id,
                //         'photos' => json_encode($filenames),
                //         'created_by' => $created_by,
                //     ];

                //     $result = $model->addGallery($insertionData); 
                // }

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't create Report, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];
                } else {
                    $_SESSION['success'] = "Report Created Successfully.";
                    $data['response'] = $_SESSION['success'];
                    return redirect('reports');
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occurred, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }

        return redirect('reports');
    }

    public function downloadReport()
    {
        if ($this->request->getMethod() == 'post') {

            helper(['form']);
            $data = [];
            $rules = [
                'report_id' => [
                    'rules' => 'required',
                    'label' => 'File',
                    'errors' => [
                        'required' => 'Please Select a file to download',
                    ]
                ],

                'file' => [
                    'rules' => 'required',
                    'label' => 'File',
                    'errors' => [
                        'required' => 'Please Select a file to download',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $file = $_POST['file'];

                $filePath = './uploads/reports/'.$file; 
                
                if (file_exists($filePath)) {
                    // Set appropriate headers
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filePath));
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Methods: GET');
        
                    readfile($filePath); // Send the file to the user
                    $_SESSION['success'] = "Report Downloaded Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return redirect('reports');
                    exit;
                    
                } else {
                    // File not found
                    $_SESSION['error'] = "Couldn't Download Report, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occurred, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }

        return redirect('reports');

    }

    public function deleteReport()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'report_id' => [
                    'rules' => 'required',
                    'label' => 'Report ID',
                    'errors' => [
                        'required' => 'Please Select a Report to delete.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $deleted_by = $user_data['user_id'];

                $report_id = $_POST['report_id'];

                $data = [
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new ReportsModel($conn);

                $result = $model->updateReport($data, $report_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete Report, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Report Deleted Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('users', $data));
                    return redirect('reports');
                    // return redirect()->to('users');
                }
                
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }
        // return (view('users', $data));
        return redirect('reports');
    }
}
