<?php

namespace App\Controllers;

use Config\MyFunctions as ConfigMyFunctions;
use App\Models\EventsModel;
use App\Models\EventsPaginatedModel;
use App\Models\ProjectsModel;
use App\Models\UsersModel;
use App\Models\MembersModel;
use App\Models\CategoriesModel;
use App\Models\CollegesModel;

class Events extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new EventsPaginatedModel();
        $usersModel = new UsersModel($conn);
        $projectsModel = new ProjectsModel($conn);
        $categoriesModel = new CategoriesModel($conn);
        $collegesModel = new CollegesModel($conn);

        $user = $_SESSION['user'];
        $user_role = $_SESSION['user_role'];
        $user_privileges = json_decode($user_role[0]['privileges'], true);
        $data = [];
        
        $data = [
            
            'events' => $model->where(['events.deleted_flag' => 0])
                                ->join('user', 'events.event_leader = user.user_id', 'left')
                                ->orderBy('events.created_on', 'ASC')
                                ->paginate(10),
            'availableProjects' => $projectsModel->getProjects(),
            'users' => $usersModel->getUsers($user['level']),
            'pager' => $model->pager,
        ];
        

        if (empty($data['events'])) {
            $data['none'] = 'No Events Found.';
            return (view('events', $data));   
        } else {
            return view('events', $data);
        }

    }

    public function addEvent()
    {
        
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'event_title' => [
                    'rules' => 'required',
                    'label' => 'Event Title',
                    'errors' => [
                        'required' => 'Event Title Field Cannot be Empty.'
                    ]
                ],

                'event_leader' => [
                    'rules' => 'required',
                    'label' => 'Event Leader',
                    'errors' => [
                        'required' => 'Event Leader Field Cannot be Empty.'
                    ]
                ],

                'starts_on' => [
                    'rules' => 'required',
                    'label' => 'Starts On',
                    'errors' => [
                        'required' => 'Starts On Field Cannot be Empty.',
                    ]
                ],

                'ends_on' => [
                    'rules' => 'required',
                    'label' => 'Ends On',
                    'errors' => [
                        'required' => 'Ends On Field Cannot be Empty.',
                    ]
                ],

                'projects' => [
                    'rules' => 'required',
                    'label' => 'Projects',
                    'errors' => [
                        'required' => 'Projects Field Cannot be Empty.',
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

                $event_title = $_POST['event_title'];
                $event_leader = $_POST['event_leader'];
                $starts_on = ($_POST['starts_on']);
                $ends_on = ($_POST['ends_on']);
                $projects = json_encode($_POST['projects']);
                $description = json_encode($_POST['description']);

                $conn = db_connect();
                $model = new EventsModel($conn);
                
                $insertionData = [
                    'event_id' => "EV" .ConfigMyFunctions::generateID(),
                    'event_name' => $event_title,
                    'projects' => $projects,
                    'event_leader' => $event_leader,
                    'starts_on' => $starts_on,
                    'ends_on' => $ends_on,
                    'event_description' => $description,
                    'created_by' =>$created_by,
                ];
                $result = $model->addEvent($insertionData);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Add Event, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Event Created Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('branches', $data));
                    return redirect('events');
                    // return redirect()->to('branches');
                }
                
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }
        // return (view('newBranch', $data));
        return redirect('events');

    }

    public function editEvent()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [

                'project_id' => [
                    'rules' => 'required',
                    'label' => 'Project ID',
                    'errors' => [
                        'required' => 'Please Select a Project to update first.'
                    ]
                ],

                'project_title' => [
                    'rules' => 'required',
                    'label' => 'Project Title',
                    'errors' => [
                        'required' => 'Project Title Field Cannot be Empty.'
                    ]
                ],

                'category' => [
                    'rules' => 'required',
                    'label' => 'Project Category',
                    'errors' => [
                        'required' => 'Project Category Field Cannot be Empty.'
                    ]
                ],

                'stage' => [
                    'rules' => 'required|in_list[1,2,3]',
                    'label' => 'Project Stage',
                    'errors' => [
                        'required' => 'Project Stage Field Cannot be Empty.',
                        'in_list' => 'Please Select a Valid Stage.'
                    ]
                ],

                'lead_developer' => [
                    'rules' => 'required',
                    'label' => 'Lead Developer',
                    'errors' => [
                        'required' => 'Lead Developer Field Cannot be Empty.',
                    ]
                ],

                'other_developers' => [
                    'rules' => 'required',
                    'label' => 'Other Developers',
                    'errors' => [
                        'required' => 'Other Developers Field Cannot be Empty.'
                    ]
                ],

                'department' => [
                    'rules' => 'required',
                    'label' => 'Department',
                    'errors' => [
                        'required' => 'Department Field Cannot be Empty.',
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

                $project_id = $_POST['project_id'];
                $project_title = $_POST['project_title'];
                $category = $_POST['category'];
                $stage = ($_POST['stage']);
                $lead_developer = ($_POST['lead_developer']);
                $other_developers = json_encode($_POST['other_developers']);
                $department = ($_POST['department']);
                $stage = ($_POST['stage']);
                $description = json_encode($_POST['description']);

                $conn = db_connect();
                $model = new ProjectsModel($conn);
                
                $newData = [
                    'project_title' => $project_title,
                    'category' => $category,
                    'lead_developer' => $lead_developer,
                    'other_developers' => $other_developers,
                    'department' => $department,
                    'stage' => $stage,
                    'description' => $description,
                ];
                $result = $model->updateProject($newData, $project_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Update Project Informations, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Project Informations Updated Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('branches', $data));
                    return redirect('projects');
                    // return redirect()->to('branches');
                }
                
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }
        // return (view('newBranch', $data));
        return redirect('projects');

    }

    public function deleteEvent()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'event_id' => [
                    'rules' => 'required',
                    'label' => 'Event ID',
                    'errors' => [
                        'required' => 'Please Select an Event to delete first.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $deleted_by = $user_data['user_id'];

                $event_id = $_POST['event_id'];

                $data = [
                    'status' => 0,
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new EventsModel($conn);

                $result = $model->updateEvent($data, $event_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete Event, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Event Deleted Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('management', $data));
                    return redirect('events');
                    // return redirect()->to('management');
                }
                
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }
        // return (view('management', $data));
        return redirect('events');
    }

}
