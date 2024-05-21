<?php

namespace App\Controllers;
use Config\MyFunctions as ConfigMyFunctions;
use App\Models\MembersModel;
use App\Models\CollegesModel;
use App\Models\MembersPaginatedModel;

class Members extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new MembersPaginatedModel();
        $collegesModel = new CollegesModel($conn);

        $user = $_SESSION['user'];
        $user_role = $_SESSION['user_role'];
        $user_privileges = json_decode($user_role[0]['privileges'], true);
        $data = [];
        
        $data = [
            
            'members' => $model->where(['members.deleted_flag' => 0])
                                ->orderBy('members.member_id', 'ASC')
                                ->paginate(10),
            'colleges' => $collegesModel->getColleges(),
            'pager' => $model->pager,
        ];

        if (empty($data['members'])) {
            $data['none'] = 'No Members Found.';
            return (view('members', $data));   
        } else {
            return view('members', $data);
        }

    }

    public function addMember()
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

                'department' => [
                    'rules' => 'required',
                    'label' => 'Member Department',
                    'errors' => [
                        'required' => 'Member Department Field Cannot be Empty.'
                    ]
                ],

                'gender' => [
                    'rules' => 'required|in_list[Male,Female,Other]',
                    'label' => 'Gender',
                    'errors' => [
                        'required' => 'Gender Field Cannot be Empty.',
                        'in_list' => 'Please Select a Valid Gender.'
                    ]
                ],

            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $created_by = $user_data['user_id'];

                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = ($_POST['email']);
                $phone = ($_POST['phone']);
                $department = ($_POST['department']);
                $gender = ($_POST['gender']);

                $conn = db_connect();
                $model = new MembersModel($conn);

                $member_details = json_encode([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'gender' => $gender,
                    'department' => $department,
                ]);

                $member_id = "MB" .ConfigMyFunctions::generateID();
                
                $insertionData = [
                    'member_id' => $member_id,
                    'user_id' => $member_id,
                    'member_details' => $member_details,
                    'email' => $email,
                    'phone' => $phone,
                    'role_id' => 'RO230713062508193',
                    'password' => password_hash(strtolower('password'), PASSWORD_DEFAULT),
                    'created_by' =>$created_by,
                ];
                $result = $model->addMember($insertionData);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Add Member, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Member Added Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('branches', $data));
                    return redirect('members');
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
        return redirect('members');

    }

    public function editMember()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'member_id' => [
                    'rules' => 'required',
                    'label' => 'Management Member',
                    'errors' => [
                        'required' => 'Please Select a Member to delete.'
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

                'department' => [
                    'rules' => 'required',
                    'label' => 'Member Department',
                    'errors' => [
                        'required' => 'Member Department Field Cannot be Empty.'
                    ]
                ],

                'gender' => [
                    'rules' => 'required|in_list[Male,Female,Other]',
                    'label' => 'Gender',
                    'errors' => [
                        'required' => 'Gender Field Cannot be Empty.',
                        'in_list' => 'Please Select a Valid Gender.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];

                $member_id = $_POST['member_id'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $email = ($_POST['email']);
                $phone = ($_POST['phone']);
                $department = ($_POST['department']);
                $gender = ($_POST['gender']);

                $conn = db_connect();
                $model = new MembersModel($conn);
                
                $member_details = json_encode([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'gender' => $gender,
                    'department' => $department,
                ]);

                $newData = [
                    'member_details' => $member_details,
                    'email' => $email,
                    'phone' => $phone,
                ];
                $result = $model->updateMember($newData, $member_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Update Member Informations, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Member Informations Updated Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('branches', $data));
                    return redirect('members');
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
        return redirect('members');

    }

    public function updateMemberPhoto()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'member_id' => [
                    'rules' => 'required',
                    'label' => 'Management Member',
                    'errors' => [
                        'required' => 'Please Select a Member to delete.'
                    ]
                ],
                
                'photo' => [
                    'rules' => 'uploaded[photo]|is_image[photo]',
                    'label' => 'Photo',
                    'errors' => [
                        'uploaded' => 'Please Upload atleast 1 Image.',
                        'is_image' => 'Please Upload a valid Image File.',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];

                $member_id = $_POST['member_id'];

                $image = $this->request->getFile('photo');
                if ($image->isValid() && !$image->hasMoved()) {

                        $name = $image->getRandomName();
                        $image->move('./uploads/members', "$name");

                        $fileName = './uploads/members/' . $image->getName();

                        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                        $file = pathinfo($fileName, PATHINFO_FILENAME);

                        $filename = $file .'.'. $fileExt;
                    }
                
                $data = [
                    'photo' => $filename,
                ];

                $conn = db_connect();
                $model = new MembersModel($conn);

                $result = $model->updateMemberPhoto($data, $member_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Update Member Photo, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Member Photo Updated Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('management', $data));
                    return redirect('members');
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
        return redirect('members');
    }
    
    public function deleteMember()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'member_id' => [
                    'rules' => 'required',
                    'label' => 'Management Member',
                    'errors' => [
                        'required' => 'Please Select a Member to delete.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $deleted_by = $user_data['user_id'];

                $member_id = $_POST['member_id'];

                $data = [
                    'status' => 0,
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new MembersModel($conn);

                $result = $model->updateMember($data, $member_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete Member, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Member Deleted Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('management', $data));
                    return redirect('members');
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
        return redirect('members');
    }

}
