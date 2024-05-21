<?php

namespace App\Controllers;

use Config\MyFunctions as ConfigMyFunctions;
use App\Models\UsersModel;
use App\Models\MembersModel;
use App\Models\ProjectsModel;
use App\Models\CollegesModel;
use TCPDF;

class Profile extends BaseController
{
    public function index()
    {
        return view('profile');
    }

    public function profileUpdate()
    {
        return view('profile-update');
    }

    public function passwordUpdate()
    {
        $user = $_SESSION['user'];
        $user_id = $user['user_id'];

        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'current_password' => [
                    'rules' => 'required',
                    'label' => 'Current Password',
                    'errors' => [
                        'required' => 'Current Password Field Cannot be Empty.'
                    ]
                ],

                'new_password' => [
                    'rules' => 'required',
                    'label' => 'New Password',
                    'errors' => [
                        'required' => 'New Password Field Cannot be Empty.'
                    ]
                ],

                'confirm_password' => [
                    'rules' => 'required',
                    'label' => 'Confirm Password',
                    'errors' => [
                        'required' => 'Confirm Password Field Cannot be Empty.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $current_password = $_POST['current_password'];
                $new_password = $_POST['new_password'];

                $conn = db_connect();
                $model = new UsersModel($conn);
                $memberModel = new MembersModel($conn);

                $user = $model->getUser($user_id);

                if (!empty($user)) {

                    $user_password = $user['password'];
                    if (password_verify($current_password, $user_password)) {
                        $newPassword = [
                            'password' => password_hash($new_password, PASSWORD_DEFAULT),
                        ];
                        $result = $model->updateUser($newPassword, $user_id);

                        if (empty($result)) {
                            $_SESSION['error'] = "Couldn't Update User Data, Please Try Again.";
                            $response = $_SESSION['error'];
                            $data['response'] = $_SESSION['error'];
                        } else {
                            $_SESSION['success'] = "User Password Updated Successfully.";
                            $data['response'] = $_SESSION['success'];
                            // return (view('profile', $data));
                            return redirect('profile');
                            // return redirect()->to('profile');
                        }
                    } else {
                        $_SESSION['error'] = "Incorrect Current Password.";
                        $response = $_SESSION['error'];
                        $data['response'] = $_SESSION['error'];
                        return redirect('profile-update');
                    }
                } else {
                    $memberData = $memberModel->getMember($user_id);

                    if (!empty($memberData)) {
                        $user_password = $memberData[0]['password'];
                        if (password_verify($current_password, $user_password)) {
                            $newPassword = [
                                'password' => password_hash($new_password, PASSWORD_DEFAULT),
                            ];
                            $result = $memberModel->updateMember($newPassword, $user_id);

                            if (empty($result)) {
                                $_SESSION['error'] = "Couldn't Update Member Data, Please Try Again.";
                                $response = $_SESSION['error'];
                                $data['response'] = $_SESSION['error'];
                            } else {
                                $_SESSION['success'] = "Member Password Updated Successfully.";
                                $data['response'] = $_SESSION['success'];
                                // return (view('profile', $data));
                                return redirect('profile');
                                // return redirect()->to('profile');
                            }
                        } else {
                            $_SESSION['error'] = "Incorrect Current Password.";
                            $response = $_SESSION['error'];
                            $data['response'] = $_SESSION['error'];
                            return redirect('profile-update');
                        }
                    } else {
                        $_SESSION['error'] = "An Error Occured, Please Try Again..";
                        $response = $_SESSION['error'];
                        $data['response'] = $_SESSION['error'];
                    }
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again.";
            $data['response'] = $_SESSION['error'];
        }
        return (view('profile', $data));
        // return redirect('profile');
    }

    public function deleteAccount()
    {
        $user = $_SESSION['user'];
        $user_id = $user['user_id'];

        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'accountDeactivation' => [
                    'rules' => 'required',
                    'label' => 'Account Deactivation',
                    'errors' => [
                        'required' => 'Account Deactivation Field must be Checked.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {

                $conn = db_connect();
                $model = new UsersModel($conn);

                $insertionData = [
                    'status' => 0,
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y_m_d H:i:s'),
                    'deleted_by' => $user_id,
                ];
                $result = $model->updateUser($insertionData, $user_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Deactivate Account, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];
                } else {
                    session_destroy();
                    unset($_SESSION['user']);
                    return redirect('/');
                }
            } else {
                $_SESSION['validationErrors'] = $this->validator;
            }
        } else {
            $_SESSION['error'] = "An Error Occured, Please Try Again.";
            $data['response'] = $_SESSION['error'];
        }
        // return (view('profile', $data));
        return redirect('profile');
    }

    public function getCV()
    {

        $user = $_SESSION['user'];
        $user_id = $user['user_id'];

        $conn = db_connect();
        $userModel = new UsersModel($conn);
        $projectModel = new ProjectsModel($conn);
        $memberModel = new MembersModel($conn);
        $collegeModel = new CollegesModel($conn);

        $memberData = $memberModel->getMember($user_id);
        $memberLedProjects = $projectModel->getMemberLedProject($user_id);

        if (!empty($memberData)) {
            $memberProfileData = $memberData[0];
            $memberProfile = json_decode($memberProfileData['member_details'], true);

            $pdf = new TCPDF();

            // Set document information
            $pdf->SetCreator('CITT Software');
            $pdf->SetAuthor('CITT Software');
            $pdf->SetTitle($memberProfile['firstname'] . " " . $memberProfile['lastname'] . " CV");
            $pdf->SetSubject('CV for ' . $memberProfile['firstname'] . " " . $memberProfile['lastname']);
            $pdf->SetKeywords('CV, CITT');

            // Add a page
            $pdf->AddPage();

            // Set some content
            $pdf->SetFont('helvetica', '', 12);

            // Add a table
            $pdf->SetFillColor(200, 200, 200); // Set the background color of the table
            $pdf->SetTextColor(0); // Set the text color
            $pdf->SetDrawColor(0, 0, 0); // Set the border color
            $pdf->SetLineWidth(0.2); // Set the border width

            // // Define table columns
            // $columnWidths = array(40, 40, 40, 40, 40); // Adjust column widths as needed
            // $columnHeaders = array('Project Title', 'Lead Developer', 'Other Developers', 'Stage', 'Created On');
            // $pdf->setLineWidth($columnWidths);

            // // Set table header style
            // $pdf->SetFont('helvetica', 'B', 12);
            // $pdf->Row($columnHeaders, $fill = true, $align = 'C', $header = true);

            // Set table row style
            $pdf->SetFont('helvetica', '', 12);
            $pdf->SetTextColor(0); // Set the text color for the rows

            $pdf->Cell(0, 10, 'Personal Details', 0, 1);
            $pdf->Cell(0, 10, 'FullName: ' . $memberProfile['firstname'] . " " . $memberProfile['lastname'], 0, 1);
            $pdf->Cell(0, 10, 'Email: ' . $memberProfileData['email'], 0, 1);
            $pdf->Cell(0, 10, 'Phone: ' . $memberProfileData['phone'], 0, 1);
            $pdf->Cell(0, 10, 'Gender: ' . $memberProfile['gender'], 0, 1);
            $pdf->Cell(0, 10, 'Department: ' . $memberProfile['department'], 0, 1);
            // Add more user details as needed

            $pdf->Cell(0, 10, 'Projects', 0, 1);

            if (!empty($memberLedProjects)) {
                $s = 1;
                foreach ($memberLedProjects as $project) {
                    $pdf->Cell(0, 10, 'Project Name: ' . $project['project_title'], 0, 1);
                    // $rowData = array(
                    //     $s++,
                    //     $project['project_title'],
                    //     $project['lead_developer'],
                    //     $project['other_developers'],
                    //     $project['stage'],
                    //     $project['created_on']
                    // );
    
                    // $pdf->Cell($rowData);
                    // Add more project details as needed
                }
            } else {
                $pdf->Cell(0, 10, 'No Available Projects Found.', 0, 1);
            }

            // Output the PDF as a response
            $pdf->Output('my_cv.pdf', 'D');
        } else {
            # code...
        }
    }
}
