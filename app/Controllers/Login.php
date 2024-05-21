<?php

namespace App\Controllers;

use Config\MyFunctions as ConfigMyFunctions;
use App\Models\LoginModel;
use App\Models\RolesModel;
use App\Models\UsersModel;
use App\Models\MembersModel;

use function PHPUnit\Framework\returnSelf;

class Login extends BaseController
{
    public function index()
    {
        return redirect('/');
    }

    public function dashboard()
    {
        $conn = db_connect();

        $user = $_SESSION['user'];
        $user_branch = 'SYSTEM';

        $data = [];

        return view('dashboard', $data);
    }

    public function login_disabled()
    {
        $data = [$_POST];
        if ($this->request->getMethod() == 'post') {
            $_SESSION['error'] = "Sorry, Service Temporalily Suspended. Please Contact System Administrator for Support.";
        }

        return (view('welcome', $data));
    }
    
    public function login()
    {
        $data = [$_POST];
        if ($this->request->getMethod() == 'post') {
            helper(['form']);

            $rules = [
                'email-phone' => [
                    'rules' => 'required',
                    'label' => 'Username',
                    'errors' => [
                        'required' => 'Username Field Cannot be Empty.',
                    ]
                ],

                'password' => [
                    'rules' => 'required',
                    'label' => 'Password',
                    'errors' => [
                        'required' => 'Password field Cannot be Empty.'
                    ]
                ]
            ];

            if ($this->validate($rules)) {
                $conn = db_connect();
                $model = new LoginModel($conn);
                $rolesModel = new RolesModel($conn);
                $result = $model->getUser($_POST['email-phone']);

                if (empty($result)) {
                    $member_login = $model->getMember($_POST['email-phone']);

                    // print_r($member_login);
                    // exit;
                    if (empty($member_login)) {
                        $_SESSION['error'] = "Couldn't Find User with the UserName.";
                    } else {
                        if ($member_login['deleted_flag'] == 1) {
                            $_SESSION['error'] = "Account Not Found.";
                            // $data['response'] = $_SESSION['error'];
                        }else {
                            if ($member_login['status'] == 1) {
                                if (password_verify($_POST['password'], $member_login['password'])) {
                                       
                                    $_SESSION['user'] = $member_login;
                                
                                    $role_id = $_SESSION['user']['role_id'];
                                    $role_result = $rolesModel->getRole($role_id);


    
                                    if (!empty($role_result)) {
                                        $_SESSION['success'] = "Logged In Successfully.";
                                        // $data['response'] = $_SESSION['success'];
    
                                        $_SESSION['user_role'] = $role_result;
                                        return redirect('dashboard');
                                    } else {
                                        $_SESSION['error'] = "Undefined Role, Please Contact the System Administrator.";
                                        // $data['response'] = $_SESSION['error'];
                                    }
                                    
                                    
                                } else {
                                    $_SESSION['error'] = "Incorrect Password.";
                                    // $data['response'] = $_SESSION['error'];
                                }
                            } else {
                                $_SESSION['error'] = "Your Account is Disabled.";
                                // $data['response'] = $_SESSION['error'];
                            }
                            
                        }
                    }
                    
                    // $data['response'] = $_SESSION['error'];
 
                } else {

                    if ($result['deleted_flag'] == 1) {
                        $_SESSION['error'] = "Account Not Found.";
                        // $data['response'] = $_SESSION['error'];
                    }else {
                        if ($result['status'] == 1) {
                            if (password_verify($_POST['password'], $result['password'])) {
                                   
                                $_SESSION['user'] = $result;

                                $role_id = $_SESSION['user']['role_id'];
                                $role_result = $rolesModel->getRole($role_id);

                                if (!empty($role_result)) {
                                    $_SESSION['success'] = "Logged In Successfully.";
                                    // $data['response'] = $_SESSION['success'];

                                    $_SESSION['user_role'] = $role_result;
                                    return redirect('dashboard');
                                } else {
                                    $_SESSION['error'] = "Undefined Role, Please Contact the System Administrator.";
                                    // $data['response'] = $_SESSION['error'];
                                }
                                
                                
                            } else {
                                $_SESSION['error'] = "Incorrect Password.";
                                // $data['response'] = $_SESSION['error'];
                            }
                        } else {
                            $_SESSION['error'] = "Your Account is Disabled.";
                            // $data['response'] = $_SESSION['error'];
                        }
                        
                    }
                    
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        }

        return (view('welcome', $data));
    }

    public function forgotPassword()
    {
        return view('forgot-password');
    }

    public function forgotPassword2()
    {
        return view('forgot-password2');
    }

    public function forgotPassword3()
    {
        return view('forgot-password3');
    }

    public function forgotPassword1()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            helper(['form']);

            $rules = [
                'email-phone' => [
                    'rules' => 'required',
                    'label' => 'Username',
                    'errors' => [
                        'required' => 'Username Field Cannot be Empty.',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $conn = db_connect();
                $model = new LoginModel($conn);

                $result = $model->getUser($_POST['email-phone']);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Find User with Email or Phone Number.";
                    // $data['response'] = $_SESSION['error'];

                } else {

                    if ($result['deleted_flag'] == 1) {
                        $_SESSION['error'] = "Account Not Found.";
                        // $data['response'] = $_SESSION['error'];
                    }else {
                        if ($result['status'] == 1) {
                            $hasPhoneExceededOTPLimit = $model->hasPhoneExceededOTPLimit($result['phone']);
                            
                            if (count($hasPhoneExceededOTPLimit) > 2) {
                                    
                                $OTP = ConfigMyFunctions::generateNumberOTP();

                                $APIResponse = json_decode(ConfigMyFunctions::sendOTP($result['phone'], $OTP), true);

                                $_SESSION['OTPSentTo'] = $result['phone'];

                                if (!empty($APIResponse['success'])) {
                                    if ($APIResponse['success'] == true) {
                                        $OTP_data = [
                                            'sent_to' => $result['phone'],
                                            'OTP' => $OTP,
                                        ];
    
                                        $OTP_model = new LoginModel($conn);
                                        $sent_OTP = $OTP_model->sentOTP($OTP_data);
    
                                        $_SESSION['info'] = "Please Fill the OTP code sent to your Phone.";
                                        // $data['response'] = $_SESSION['info'];
                                        
                                        return redirect('forgot-password2');
                                    } else {
                                        $_SESSION['error'] = "An Error Occurred, Please Try Again.";
                                        // $data['response'] = $_SESSION['error'];
                                    }
                                } else {
                                    $_SESSION['info'] = "Please Connect to the Internet to continue.";
                                    $data['response'] = $_SESSION['info'];
                                    return redirect('forgot-password');
                                }
                                
                            } else {
                                $_SESSION['info'] = "You have reached the OTP Limit, Please Contact the Branch Admin for Support.";
                                // $data['response'] = $_SESSION['info'];
                            }
                            
                        } else {
                            $_SESSION['error'] = "Your Account is Disabled.";
                            // $data['response'] = $_SESSION['error'];
                        }
                        
                    }
                    
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        }

        // return (view('welcome', $data));
        return redirect('/');
    }

    public function verifyOTP()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            helper(['form']);

            $rules = [
                'OTP' => [
                    'rules' => 'required',
                    'label' => 'OTP',
                    'errors' => [
                        'required' => 'OTP Field Cannot be Empty.',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $sent_to = $_SESSION['OTPSentTo'];
                $OTP = $_POST['OTP'];

                $conn = db_connect();
                $model = new LoginModel($conn);
                $result = $model->getOTP($sent_to, $OTP);

                if (empty($result)) {
                    $_SESSION['error'] = "Incorrect OTP Code.";
                    // $data['response'] = $_SESSION['error'];
                    unset($_SESSION['OTPSentTo']);

                } else {

                    if ($result['deleted_flag'] == 1) {
                        $_SESSION['error'] = "Incorrect OTP Code.";
                        // $data['response'] = $_SESSION['error'];
                        unset($_SESSION['OTPSentTo']);
                    }else {
                        return redirect('forgot-password3');    
                    }
                    
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        }

        // return (view('welcome', $data));
        return redirect('/');
    }

    public function recoverPassword()
    {
        $data = [];
        if ($this->request->getMethod() == 'post') {
            helper(['form']);

            $rules = [
                'password' => [
                    'rules' => 'required',
                    'label' => 'Password',
                    'errors' => [
                        'required' => 'Password Field Cannot be Empty.',
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $password = $_POST['password'];
                $user_phone = $_SESSION['OTPSentTo'];

                $conn = db_connect();
                $model = new LoginModel($conn);
                $userModel = new UsersModel($conn);
                $result = $model->getUser($user_phone);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Find User with Email or Phone Number.";
                    // $data['response'] = $_SESSION['error'];

                } else {

                    if ($result['deleted_flag'] == 1) {
                        $_SESSION['error'] = "Account Not Found.";
                        // $data['response'] = $_SESSION['error'];
                    }else {
                        if ($result['status'] == 1) {
                            $user_id = $result['user_id'];
                            $newPassword = [
                                'password' => password_hash($password, PASSWORD_DEFAULT),
                            ];
                            
                            $result = $userModel->updateUser($newPassword, $user_id);
        
                            if (empty($result)) {
                                $_SESSION['error'] = "Couldn't Update User Password, Please Try Again.";
                                // $data['response'] = $_SESSION['error'];
                            } else {
                                $_SESSION['success'] = "User Password Updated Successfully.";
                                // $data['response'] = $_SESSION['success'];

                                unset($_SESSION['OTPSentTo']);

                                return redirect('/');
                            }
                        } else {
                            $_SESSION['error'] = "Your Account is Disabled.";
                            // $data['response'] = $_SESSION['error'];
                        }
                        
                    }
                    
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        }

        // return (view('welcome', $data));
        return redirect('/');
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user']);

        return redirect('/');
    }
}
