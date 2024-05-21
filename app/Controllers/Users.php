<?php

namespace App\Controllers;
use Config\MyFunctions as ConfigMyFunctions;

use App\Models\UsersModel;
use App\Models\UsersPaginatedModel;
use App\Models\RolesModel;

class Users extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new UsersPaginatedModel();
        $usersModel = new UsersModel($conn);
        $rolesModel = new RolesModel($conn);

        $user_data = $_SESSION['user'];


        $data = [];

        $data = [ 
            'users' => $model->where(['user.deleted_flag' => 0, 'user.status' => 1])
                                ->join('role', 'user.role_id = role.role_id', 'LEFT')
                                ->orderBy('user.user_id', 'ASC')
                                ->paginate(10),
            'roles' => $rolesModel->getRoles(),
            'pager' => $model->pager,
        ];

        if (empty($data['users'])) {
            $data['none'] = 'No Users Found.';
            return (view('users', $data));   
        } else {
            return view('users', $data);
        }

    }

    public function addUser()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'firstname' => [
                    'rules' => 'required',
                    'label' => 'First Name',
                    'errors' => [
                        'required' => 'First Name Field Cannot be Empty.'
                    ]
                ],

                'lastname' => [
                    'rules' => 'required',
                    'label' => 'Last Name',
                    'errors' => [
                        'required' => 'Last Name Field Cannot be Empty.'
                    ]
                ],

                'email' => [
                    'rules' => 'required|valid_email',
                    'label' => 'Email',
                    'errors' => [
                        'required' => 'Email Field Cannot be Empty.',
                        'valid_email' => 'Please Enter a Valid Email.'
                    ]
                ],

                'phone' => [
                    'rules' => 'required|exact_length[10]',
                    'label' => 'Phone',
                    'errors' => [
                        'required' => 'Phone Field Cannot be Empty.',
                        'exact_length' => 'Please Enter a Valid Phone.'
                    ]
                ],

                'role' => [
                    'rules' => 'required',
                    'label' => 'User Role',
                    'errors' => [
                        'required' => 'User Role Field Cannot be Empty.'
                    ]
                ],

                'level' => [
                    'rules' => 'required|in_list[3,4]',
                    'label' => 'User Level',
                    'errors' => [
                        'required' => 'User Level Field Cannot be Empty.',
                        'in_list' => 'Please Select a Valid User Level.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = ($_POST['email']);
                $phone = ($_POST['phone']);
                $level = ($_POST['level']);
                $role_id = ($_POST['role']);

                $conn = db_connect();
                $model = new UsersModel($conn);

                //Check Email And Phone if Exist.
                $availableEmail = $model->isUserWithEmailExisting($email);
                $availablePhone = $model->isUserWithPhoneExisting($phone);
                
                if (empty($availableEmail) && empty($availablePhone)) {

                    $insertionData = [
                        'user_id' => "US" .ConfigMyFunctions::generateID(),
                        'role_id' => $role_id,
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                        'phone' => $phone,
                        'password' => password_hash(strtolower($firstname), PASSWORD_DEFAULT),
                        'level' => $level,
                    ];
                    $result = $model->addUser($insertionData);
    
                    if (empty($result)) {
                        $_SESSION['error'] = "Couldn't Add User, Please Try Again.";
                        $response = $_SESSION['error'];
                        $data['response'] = $_SESSION['error'];
    
                    } else {
                        $_SESSION['success'] = "User Added Successfully.";
                        $data['response'] = $_SESSION['success'];
                        // return (view('branches', $data));
                        return redirect('users');
                        // return redirect()->to('branches');
                    }
                } else {
                    if ($availableEmail && $availablePhone) {
                        $_SESSION['error'] = "User With Similar Phone Number and Email Address Already Exists.";
                        $response = $_SESSION['error'];
                        $data['response'] = $_SESSION['error'];
                    }
                    if (empty($availableEmail)) {
                        $_SESSION['error'] = "User With Similar Phone Number Already Exists.";
                        $response = $_SESSION['error'];
                        $data['response'] = $_SESSION['error'];
                    }
                    if (empty($availablePhone)) {
                        $_SESSION['error'] = "User With Similar Email Address Already Exists.";
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
        return redirect('users');

    }

    public function editPhoto()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [

                'user_id' => [
                    'rules' => 'required',
                    'label' => 'User ID',
                    'errors' => [
                        'required' => 'User ID Field Cannot be Empty.',
                    ]
                ],

                'photo' => [
                    'rules' => 'is_image[photo]',
                    'label' => 'Photo',
                    'errors' => [
                        'uploaded' => 'User Photo Field Cannot be Empty.',
                        'is_image' => 'Please Upload a Valid Photo.',
                    ]
                ],
            ];

            // var_dump($_POST);

            if ($this->validate($rules)) {
                $user_id = $_POST['user_id'];
                
                // echo $user_id;
                $conn = db_connect();
                $model = new UsersModel($conn);

                $photo = $this->request->getFile('photo');

                $filename = '';
                if ($photo->isValid() && !$photo->hasMoved()) {
                    $name = $photo->getRandomName();
                    $photo->move('./uploads/users', "$name");

                    $filename = $photo->getName();
                }
                
                $newPhoto = [
                    'photo' => $filename,
                ];
                $result = $model->editUserPhoto($newPhoto, $user_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Edit User Image, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "User Image Edited Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('users', $data));
                    return redirect('users');
                    // return redirect()->to('users');
                }
                
            } else {
                
                $_SESSION['error2'] = $this->validator;
                $data['response'] = $_SESSION['error2'];
                // $data['validation'] = $this->validator;
            }
            
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again";
            $data['response'] = $_SESSION['error'];
        }
        return redirect('users');
        // // return (view('newBranch', $data));

    }

    public function editUser()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'user_id' => [
                    'rules' => 'required',
                    'label' => 'User ID',
                    'errors' => [
                        'required' => 'Please Select a User to update first.'
                    ]
                ],

                'firstname' => [
                    'rules' => 'required',
                    'label' => 'First Name',
                    'errors' => [
                        'required' => 'First Name Field Cannot be Empty.'
                    ]
                ],

                'lastname' => [
                    'rules' => 'required',
                    'label' => 'Last Name',
                    'errors' => [
                        'required' => 'Last Name Field Cannot be Empty.'
                    ]
                ],

                'email' => [
                    'rules' => 'required|valid_email',
                    'label' => 'Email',
                    'errors' => [
                        'required' => 'Email Field Cannot be Empty.',
                        'valid_email' => 'Please Enter a Valid Email.'
                    ]
                ],

                'phone' => [
                    'rules' => 'required|exact_length[10]',
                    'label' => 'Phone',
                    'errors' => [
                        'required' => 'Phone Field Cannot be Empty.',
                        'exact_length' => 'Please Enter a Valid Phone.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_id = ($_POST['user_id']);
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = ($_POST['email']);
                $phone = ($_POST['phone']);

                $conn = db_connect();
                $model = new UsersModel($conn);

                $insertionData = [

                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'email' => $email,
                    'phone' => $phone,
                ];
                $result = $model->updateUser($insertionData, $user_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Update User, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "User Updated Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('users', $data));
                    return redirect('users');
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
        return redirect('users');

    }

    public function deleteUser()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'user_id' => [
                    'rules' => 'required',
                    'label' => 'User ID',
                    'errors' => [
                        'required' => 'Please Select a User to delete.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $deleted_by = $user_data['user_id'];

                $user_id = $_POST['user_id'];

                $data = [
                    'status' => 0,
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new UsersModel($conn);

                $result = $model->updateUser($data, $user_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete User, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "User Deleted Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('users', $data));
                    return redirect('users');
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
        return redirect('users');
    }
}