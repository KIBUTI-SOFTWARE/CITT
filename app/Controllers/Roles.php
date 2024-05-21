<?php

namespace App\Controllers;
use Config\MyFunctions as ConfigMyFunctions;
use App\Models\RolesModel;
use App\Models\RolesPaginatedModel;

class Roles extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new RolesPaginatedModel();
        $user = $_SESSION['user'];
        $user_role = $_SESSION['user_role'];
        $user_privileges = json_decode($user_role[0]['privileges'], true);
        $data = [];
        
        $data = [
            
            'roles' => $model->where(['role.deleted_flag' => 0])
                                ->orderBy('role.role_id', 'ASC')
                                ->paginate(10),
            'pager' => $model->pager,
        ];

        if (empty($data['roles'])) {
            $data['none'] = 'No Roles Found.';
            return (view('roles', $data));   
        } else {
            return view('roles', $data);
        }

    }

    public function createRole()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'name' => [
                    'rules' => 'required',
                    'label' => 'Role Name',
                    'errors' => [
                        'required' => 'Role Name Field Cannot be Empty.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];

                $name = $_POST['name'];
                $description = $_POST['description'];
                $created_by = $user_data['user_id'];
                //
                $view_members = empty($_POST['view_members']) ? 0 : 1;
                $add_members = empty($_POST['add_members']) ? 0 : 1;
                $edit_members = empty($_POST['edit_members']) ? 0 : 1;
                $delete_members = empty($_POST['delete_members']) ? 0 : 1;
                //
                $view_projects = empty($_POST['view_projects']) ? 0 : 1;
                $add_projects = empty($_POST['add_projects']) ? 0 : 1;
                $edit_projects = empty($_POST['edit_projects']) ? 0 : 1;
                $delete_projects = empty($_POST['delete_projects']) ? 0 : 1;
                //
                $view_categories = empty($_POST['view_categories']) ? 0 : 1;
                $add_categories = empty($_POST['add_categories']) ? 0 : 1;
                $edit_categories = empty($_POST['edit_categories']) ? 0 : 1;
                $delete_categories = empty($_POST['delete_categories']) ? 0 : 1;
                //
                $view_events = empty($_POST['view_events']) ? 0 : 1;
                $add_events = empty($_POST['add_events']) ? 0 : 1;
                $edit_events = empty($_POST['edit_events']) ? 0 : 1;
                $delete_events = empty($_POST['delete_events']) ? 0 : 1;
                //
                $create_reports = empty($_POST['create_reports']) ? 0 : 1;
                $view_reports = empty($_POST['view_reports']) ? 0 : 1;
                $delete_reports = empty($_POST['delete_reports']) ? 0 : 1;
                //
                $view_colleges = empty($_POST['view_colleges']) ? 0 : 1;
                $add_colleges = empty($_POST['add_colleges']) ? 0 : 1;
                $edit_colleges = empty($_POST['edit_colleges']) ? 0 : 1;
                $delete_colleges = empty($_POST['delete_colleges']) ? 0 : 1;
                //
                $view_user = empty($_POST['view_user']) ? 0 : 1;
                $add_user = empty($_POST['add_user']) ? 0 : 1;
                $edit_user = empty($_POST['edit_user']) ? 0 : 1;
                $delete_user = empty($_POST['delete_user']) ? 0 : 1;
                //
                $view_role = empty($_POST['view_role']) ? 0 : 1;
                $add_role = empty($_POST['add_role']) ? 0 : 1;
                $edit_role = empty($_POST['edit_role']) ? 0 : 1;
                $delete_role = empty($_POST['delete_role']) ? 0 : 1;
                // $view_deletedData = empty($_POST['view_reports']) ? 0 : 1;

                $conn = db_connect();
                $model = new RolesModel($conn);

                //Check if Role Exists.
                $availableRole = $model->isRoleExisting($name);
                
                if (empty($availableRole)) {
                    //Role Privileges
                    $privileges = json_encode([
                        //
                        "view_members" => $view_members,
                        "add_members" => $add_members,
                        "edit_members" => $edit_members,
                        "delete_members" => $delete_members,
                        //
                        "view_projects" => $view_projects,
                        "add_projects" =>  $add_projects,
                        "edit_projects" =>  $edit_projects,
                        "delete_projects" => $delete_projects,
                        //
                        "view_categories" => $view_categories,
                        "add_categories" => $add_categories,
                        "edit_categories" => $edit_categories,
                        "delete_categories" => $delete_categories,
                        //
                        "view_events" => $view_events,
                        "add_events" => $add_events,
                        "edit_events" => $edit_events,
                        "delete_events" => $delete_events,
                        //
                        "create_reports" => $create_reports,
                        "view_reports" => $view_reports,
                        "delete_reports" => $delete_reports,
                        //
                        "view_colleges" => $view_colleges,
                        "add_colleges" => $add_colleges,
                        "edit_colleges" => $edit_colleges,
                        "delete_colleges" => $delete_colleges,
                        //
                        "view_user" => $view_user,
                        "add_user" => $add_user,
                        "edit_user" => $edit_user,
                        "delete_user" => $delete_user,
                        //
                        "view_role" => $view_role,
                        "add_role" => $add_role,
                        "edit_role" => $edit_role,
                        "delete_role" => $delete_role,
                        //
                        // "view_departments" => $view_deletedData,
                    ]);
                    
                    $insertionData = [
                        'role_id' => "RO" .ConfigMyFunctions::generateID(),
                        'role_name' => $name,
                        'description' => $description,
                        'privileges' => $privileges,
                        'created_by' => $created_by,
                    ];
                    $result = $model->addRole($insertionData);
    
                    if (empty($result)) {
                        $_SESSION['error'] = "Couldn't Create Role, Please Try Again.";
                        $response = $_SESSION['error'];
                        $data['response'] = $_SESSION['error'];
    
                    } else {
                        $_SESSION['success'] = "Role Created Successfully.";
                        $data['response'] = $_SESSION['success'];
                        // return (view('branches', $data));
                        return redirect('roles');
                        // return redirect()_>to('branches');
                    }
                } else {
                    if ($availableRole) {
                        $_SESSION['error'] = "Role With Similar Name Already Exists";
                        $response = $_SESSION['error'];
                        $data['response'] = $_SESSION['error'];
                    } 
                }
                
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }
        // return (view('newBranch', $data));
        return redirect('roles');

    }

    public function deleteRole()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'role_id' => [
                    'rules' => 'required',
                    'label' => 'Role',
                    'errors' => [
                        'required' => 'Please Select a Role to delete.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $deleted_by = $user_data['user_id'];

                $role_id = $_POST['role_id'];

                $data = [
                    'status' => 0,
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new RolesModel($conn);

                $result = $model->updateRole($data, $role_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete Role, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Role Deleted Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('roles', $data));
                    return redirect('roles');
                    // return redirect()->to('roles');
                }
                
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }
        // return (view('roles', $data));
        return redirect('roles');
    }

}
