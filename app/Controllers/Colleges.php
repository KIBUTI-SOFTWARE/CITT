<?php

namespace App\Controllers;
use Config\MyFunctions as ConfigMyFunctions;
use App\Models\CollegesModel;
use App\Models\CollegesPaginatedModel;

class Colleges extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new CollegesPaginatedModel();
        $user = $_SESSION['user'];
        $user_role = $_SESSION['user_role'];
        $user_privileges = json_decode($user_role[0]['privileges'], true);
        $data = [];
        
        $data = [
            
            'colleges' => $model->where(['colleges.deleted_flag' => 0])
                                ->orderBy('colleges.college_id', 'ASC')
                                ->paginate(10),
            'pager' => $model->pager,
        ];

        if (empty($data['colleges'])) {
            $data['none'] = 'No Colleges Found.';
            return (view('colleges', $data));   
        } else {
            return view('colleges', $data);
        }

    }

    public function addCollege()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'name' => [
                    'rules' => 'required',
                    'label' => 'College Name',
                    'errors' => [
                        'required' => 'College Name Field Cannot be Empty.'
                    ]
                ],

                'short_name' => [
                    'rules' => 'required',
                    'label' => 'College Short Name',
                    'errors' => [
                        'required' => 'College Short Name Field Cannot be Empty.'
                    ]
                ],

            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $created_by = $user_data['user_id'];

                $name = $_POST['name'];
                $short_name = $_POST['short_name'];
                $others = $_POST['others'];

                $conn = db_connect();
                $model = new CollegesModel($conn);
                
                $insertionData = [
                    'college_id' => "CO" .ConfigMyFunctions::generateID(),
                    'college_name' => $name,
                    'short_name' => $short_name,
                    'others' => json_encode($others),
                    'created_by' =>$created_by,
                ];
                $result = $model->addCollege($insertionData);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Add College, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "College Added Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('branches', $data));
                    return redirect('colleges');
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
        return redirect('colleges');

    }

    public function addDepartment()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'college' => [
                    'rules' => 'required',
                    'label' => 'College Name',
                    'errors' => [
                        'required' => 'College Name Field Cannot be Empty.'
                    ]
                ],

                'department' => [
                    'rules' => 'required',
                    'label' => 'Department Name',
                    'errors' => [
                        'required' => 'Department Name Field Cannot be Empty.'
                    ]
                ],

            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];

                $college = $_POST['college'];
                $department = $_POST['department'];

                $conn = db_connect();
                $model = new CollegesModel($conn);

                $department_data = [
                    "DP" .ConfigMyFunctions::generateID() => $department,      
                ];

                $college_departments = $model->getCollege($college);

                if (empty($college_departments[0]['departments'])) {

                    $newDepartment = ($department_data);

                } else {
                    $existing_departments = json_decode($college_departments[0]['departments'], true);
                    $newDepartment = array_merge($existing_departments , $department_data);
                }
                
                $newData = [
                    'departments' => json_encode($newDepartment)
                ];
                

                $result = $model->updateCollege($newData, $college);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Add Department, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Department Added Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('branches', $data));
                    return redirect('colleges');
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
        return redirect('colleges');

    }

    public function editCollege()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [

                'category_id' => [
                    'rules' => 'required',
                    'label' => 'Category ID',
                    'errors' => [
                        'required' => 'Please Select a Category to Update.'
                    ]
                ],

                'name' => [
                    'rules' => 'required',
                    'label' => 'Category Name',
                    'errors' => [
                        'required' => 'Category Name Field Cannot be Empty.'
                    ]
                ],

                'description' => [
                    'rules' => 'required',
                    'label' => 'Category Description',
                    'errors' => [
                        'required' => 'Category Description Field Cannot be Empty.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];

                $category_id = $_POST['category_id'];
                $name = $_POST['name'];
                $description = json_encode($_POST['description']);

                $conn = db_connect();
                $model = new CollegesModel($conn);
                
                $newData = [
                    'name' => $name,
                    'description' => $description,
                ];
                $result = $model->updateCategory($newData, $category_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Update Category Informations, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Category Informations Updated Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('branches', $data));
                    return redirect('categories');
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
        return redirect('categories');

    }

    public function deleteCollege()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
                'category_id' => [
                    'rules' => 'required',
                    'label' => 'Category ID',
                    'errors' => [
                        'required' => 'Please Select a Category to Update.'
                    ]
                ],
            ];

            if ($this->validate($rules)) {
                $user_data = $_SESSION['user'];
                $deleted_by = $user_data['user_id'];

                $category_id = $_POST['category_id'];

                $data = [
                    'status' => 0,
                    'deleted_flag' => 1,
                    'deleted_on' => date('Y-m-d H:i:s'),
                    'deleted_by' => $deleted_by,
                ];

                $conn = db_connect();
                $model = new CollegesModel($conn);

                $result = $model->updateCategory($data, $category_id);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Delete Category, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Category Deleted Successfully.";
                    $data['response'] = $_SESSION['success'];
                    // return (view('management', $data));
                    return redirect('categories');
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
        return redirect('categories');
    }

}
