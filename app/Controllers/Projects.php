<?php

namespace App\Controllers;

use Config\MyFunctions as ConfigMyFunctions;
use App\Models\ProjectsModel;
use App\Models\ProjectsPaginatedModel;
use App\Models\MembersModel;
use App\Models\CategoriesModel;
use App\Models\CollegesModel;

class Projects extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new ProjectsPaginatedModel();
        $membersModel = new MembersModel($conn);
        $categoriesModel = new CategoriesModel($conn);
        $collegesModel = new CollegesModel($conn);

        $user = $_SESSION['user'];
        $user_role = $_SESSION['user_role'];
        $user_privileges = json_decode($user_role[0]['privileges'], true);
        $data = [];
        
        if ($user['level'] === '4') {
            $data = [
            
                'projects' => $model->where(['project.lead_developer' => $user['user_id'], 'project.deleted_flag' => 0])
                                    ->join('members', 'project.lead_developer = members.member_id', 'left')
                                    ->join('category', 'project.category = category.category_id', 'left')
                                    ->join('colleges', 'project.department = colleges.college_id', 'left')
                                    ->join('user', 'project.created_by = user.user_id', 'left')
                                    ->orderBy('project.project_id', 'ASC')
                                    ->paginate(10),
                'members' => $membersModel->getMembers(),
                'categories' => $categoriesModel->getCategories(),
                'colleges' => $collegesModel->getColleges(),
                'pager' => $model->pager,
            ];
        } else {
            $data = [
            
                'projects' => $model->where(['project.deleted_flag' => 0])
                                    ->join('members', 'project.lead_developer = members.member_id', 'left')
                                    ->join('category', 'project.category = category.category_id', 'left')
                                    ->join('colleges', 'project.department = colleges.college_id', 'left')
                                    ->join('user', 'project.created_by = user.user_id', 'left')
                                    ->orderBy('project.project_id', 'ASC')
                                    ->paginate(10),
                'members' => $membersModel->getMembers(),
                'categories' => $categoriesModel->getCategories(),
                'colleges' => $collegesModel->getColleges(),
                'pager' => $model->pager,
            ];
        }
        

        if (empty($data['projects'])) {
            $data['none'] = 'No Projects Found.';
            return (view('projects', $data));   
        } else {
            return view('projects', $data);
        }

    }

    public function addProject()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
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
                    'rules' => 'required|in_list[1,2,3,4,5]',
                    'label' => 'Project Stage',
                    'errors' => [
                        'required' => 'Project Stage Field Cannot be Empty.',
                        'in_list' => 'Please Select a Valid Stage.'
                    ]
                ],

                'registration_status' => [
                    'rules' => 'required|in_list[1,2,3]',
                    'label' => 'Project Registration Status',
                    'errors' => [
                        'required' => 'Project Registration Status Field Cannot be Empty.',
                        'in_list' => 'Please Select a Valid Project Registration Status.'
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
                $created_by = $user_data['user_id'];

                $project_title = $_POST['project_title'];
                $category = $_POST['category'];
                $stage = ($_POST['stage']);
                $lead_developer = ($_POST['lead_developer']);
                $other_developers = json_encode($_POST['other_developers']);
                $department = ($_POST['department']);
                $registration_status = ($_POST['registration_status']);
                $description = json_encode($_POST['description']);

                $conn = db_connect();
                $model = new ProjectsModel($conn);
                
                $insertionData = [
                    'project_id' => "PR" .ConfigMyFunctions::generateID(),
                    'project_title' => $project_title,
                    'category' => $category,
                    'lead_developer' => $lead_developer,
                    'other_developers' => $other_developers,
                    'department' => $department,
                    'stage' => $stage,
                    'reg_status' => $registration_status,
                    'project_description' => $description,
                    'created_by' =>$created_by,
                ];
                $result = $model->addProject($insertionData);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Add Project, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Project Added Successfully.";
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

    public function editProject()
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

    public function deleteProject()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'project_id' => [
                    'rules' => 'required',
                    'label' => 'Project ID',
                    'errors' => [
                        'required' => 'Please Select a Project to delete first.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $deleted_by = $user_data['user_id'];

                $project_id = $_POST['project_id'];

                $data = [
                    'status' => 0,
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new ProjectsModel($conn);

                $result = $model->updateProject($data, $project_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete Project, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Project Deleted Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('management', $data));
                    return redirect('projects');
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
        return redirect('projects');
    }

}
