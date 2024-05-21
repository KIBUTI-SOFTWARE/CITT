<?php

namespace App\Controllers;
use Config\MyFunctions as ConfigMyFunctions;
use App\Models\CategoriesModel;
use App\Models\CategoriesPaginatedModel;

class Categories extends BaseController
{
    public function index()
    {
        $conn = db_connect();
        $model = new CategoriesPaginatedModel();
        $user = $_SESSION['user'];
        $user_role = $_SESSION['user_role'];
        $user_privileges = json_decode($user_role[0]['privileges'], true);
        $data = [];
        
        $data = [
            
            'categories' => $model->where(['category.deleted_flag' => 0])
                                ->orderBy('category.category_id', 'ASC')
                                ->paginate(10),
            'pager' => $model->pager,
        ];

        if (empty($data['categories'])) {
            $data['none'] = 'No Categories Found.';
            return (view('categories', $data));   
        } else {
            return view('categories', $data);
        }

    }

    public function addCategory()
    {
        if ($this->request->getMethod() == 'post') {
            helper(['form']);
            $data = [];

            $rules = [
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
                $created_by = $user_data['user_id'];

                $name = $_POST['name'];
                $description = $_POST['description'];

                $conn = db_connect();
                $model = new CategoriesModel($conn);
                
                $insertionData = [
                    'category_id' => "CT" .ConfigMyFunctions::generateID(),
                    'name' => $name,
                    'description' => json_encode($description),
                    'created_by' =>$created_by,
                ];
                $result = $model->addCategory($insertionData);

                if (empty($result)) {
                    $_SESSION['error'] = "Couldn't Add Category, Please Try Again.";
                    $response = $_SESSION['error'];
                    $data['response'] = $_SESSION['error'];

                } else {
                    $_SESSION['success'] = "Category Added Successfully.";
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

    public function editCategory()
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
                $model = new CategoriesModel($conn);
                
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

    public function deleteCategory()
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
                $model = new CategoriesModel($conn);

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
