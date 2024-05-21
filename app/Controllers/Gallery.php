<?php

namespace App\Controllers;

use Config\MyFunctions as ConfigMyFunctions;
use App\Models\GalleryModel;
use App\Models\GalleryPaginatedModel;
use App\Models\EventsModel;
use App\Models\ProjectsModel;
use App\Models\UsersModel;
use App\Models\MembersModel;
use App\Models\CategoriesModel;
use App\Models\CollegesModel;

class Gallery extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new GalleryPaginatedModel();
        $usersModel = new UsersModel($conn);
        $eventsModel = new EventsModel($conn);
        $categoriesModel = new CategoriesModel($conn);
        $collegesModel = new CollegesModel($conn);

        $user = $_SESSION['user'];
        $user_role = $_SESSION['user_role'];
        $user_privileges = json_decode($user_role[0]['privileges'], true);
        $data = [];

        $data = [

            'galleries' => $model->where(['gallery.deleted_flag' => 0])
                ->join('events', 'gallery.event_id = events.event_id', 'left')
                ->join('user', 'gallery.created_by = user.user_id', 'left')
                ->orderBy('gallery.created_on', 'ASC')
                ->paginate(10),
            'events' => $eventsModel->getEvents(),
            'users' => $usersModel->getUsers($user['level']),
            'pager' => $model->pager,
        ];


        if (empty($data['galleries'])) {
            $data['none'] = 'No Galleries Found.';
            return (view('galleries', $data));
        } else {
            return view('galleries', $data);
        }
    }


    public function addGallery()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form', 'image']);
            $data = [];
            $rules = [
                'event_id' => [
                    'rules' => 'required',
                    'label' => 'Event ID',
                    'errors' => [
                        'required' => 'Event ID Field Cannot be Empty.'
                    ]
                ],
                'photos' => [
                    'rules' => 'uploaded[photos.0]|is_image[photos]',
                    'label' => 'Images',
                    'errors' => [
                        'uploaded' => 'Please Upload at least 1 Image.',
                        'is_image' => 'Please Upload a valid Image File.',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $created_by = $user_data['user_id'];
                $event_id = $_POST['event_id'];

                // User Image Uploading
                $images = $this->request->getFiles();
                $filenames = [];

                foreach ($images['photos'] as $image) {
                    if ($image->isValid() && !$image->hasMoved()) {
                        $name = $image->getRandomName();
                        $image->move('./uploads/events/gallery/', "$name");

                        $fileName = $image->getName();
                        $filenames[] = $fileName;
                    }
                }

                $conn = db_connect();
                $model = new GalleryModel($conn);

                $existingPhotos = $model->getGallery($event_id); 

                if (!empty($existingPhotos)) {
                    // There are existing photos for the event_id
                    $existingPhotosForEvent = $existingPhotos[0]['photos'];
                    $existingPhotosArray = json_decode($existingPhotosForEvent, true);
                    $updatedPhotosArray = array_merge($existingPhotosArray, $filenames);

                    $insertionData = [
                        'event_id' => $event_id,
                        'photos' => json_encode($updatedPhotosArray),
                        'created_by' => $created_by,
                    ];

                    $result = $model->updateGallery($insertionData, $event_id); 
                } else {
                    // No existing photos for the event_id
                    $insertionData = [
                        'event_id' => $event_id,
                        'photos' => json_encode($filenames),
                        'created_by' => $created_by,
                    ];

                    $result = $model->addGallery($insertionData); 
                }

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't add to Gallery, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];
                } else {
                    $_SESSION['success'] = "Added to Gallery Successfully.";
                    $data['response'] = $_SESSION['success'];
                    return redirect('gallery');
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occurred, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }

        return redirect('gallery');
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

    public function deleteGallery()
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
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new GalleryModel($conn);

                $result = $model->updateGallery($data, $event_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete from Gallery, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];
                } else {
                    $_SESSION['success'] = "Deleted from Gallery Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('management', $data));
                    return redirect('gallery');
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
        return redirect('gallery');
    }
}
