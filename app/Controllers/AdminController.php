<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends BaseController
{
    protected $userModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        //
    }


    public function login()
    {
       
        if ($this->request->getMethod() === "POST") {
            $session = session();
            $cnic = $this->request->getPost('cnic');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
        
            // Validate input
            $validation = \Config\Services::validation();
            $validation->setRules([
                'cnic'     => 'required|exact_length[13]|numeric', // CNIC must be 13 digits
                'email'    => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ]);
        
            if (!$validation->withRequest($this->request)->run()) {
                return redirect()->back()->withInput()->with('validation', $validation);
            }
        
            // Check user in the database
            $user = $this->userModel->where('cnic', $cnic)->where('email', $email)->first();
        
            if ($user) {

              
                if (password_verify($password, $user['password'])) {
                    // Regenerate session to prevent fixation and clear old data
                    $session->regenerate(true);
        
                    $sessionData = [
                        'id'        => $user['user_id'],
                        'isLoggedIn' => true
                    ];
                    
                    $session->set($sessionData);
                    return redirect()->to('joinpunjabpolice/admin/create-user');
                } else {
                    return redirect()->to(current_url())->with('error', 'Invalid password');
                }
            } else {
                return redirect()->to(current_url())->with('error', 'User not found');
            }
        }
        
        return view('user/login');
    }        
    public function logout()
    {
        session()->destroy();
        return redirect()->to('joinpunjabpolice/admin/login-for-admin');
    }


    public function createJob()
    {
        return view('user/create_job');
    }

    public function createUser()
    {
      

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'user_name' => [
                    'rules'  => 'required|max_length[255]',
                    'errors' => [
                        'required'   => 'Full Name is required.',
                        'max_length' => 'Full Name cannot exceed 255 characters.'
                    ]
                ],
                'cnic' => [
                    'rules'  => 'required|max_length[255]|is_unique[users.cnic]',
                    'errors' => [
                        'required'   => 'CNIC is required.',
                        'max_length' => 'CNIC cannot exceed 13 characters.',
                        'is_unique'  => 'This CNIC is already registered.'
                    ]
                ],
                'email' => [
                    'rules'  => 'required|valid_email|max_length[255]|is_unique[users.email]',
                    'errors' => [
                        'required'    => 'Email is required.',
                        'valid_email' => 'Please enter a valid email address.',
                        'max_length'  => 'Email cannot exceed 255 characters.',
                        'is_unique'   => 'This email is already registered.'
                    ]
                ],
                'password' => [
                    'rules'  => 'required|min_length[8]|max_length[255]',
                    'errors' => [
                        'required'   => 'Password is required.',
                        'min_length' => 'Password must be at least 8 characters long.',
                        'max_length' => 'Password cannot exceed 255 characters.'
                    ]
                ],
                'phone' => [
                    'rules'  => 'required|max_length[255]',
                    'errors' => [
                        'required'   => 'Phone number is required.',
                        'max_length' => 'Phone number cannot exceed 11 characters.'
                    ]
                ],
                'role' => [
                    'rules'  => 'required|in_list[user,admin]',
                    'errors' => [
                        'required' => 'Role selection is required.',
                        'in_list'  => 'Invalid role selected.'
                    ]
                ],
                'status' => [
                    'rules'  => 'required|in_list[active,inactive]',
                    'errors' => [
                        'required' => 'Status selection is required.',
                        'in_list'  => 'Invalid status selected.'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            $hashedPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $cnic =  $this->request->getPost('cnic');
            // Save to database

            $this->userModel->save([
                'user_name' => $this->request->getPost('user_name'),
                'cnic'      => str_replace('-', '', $cnic),
                'email'     => $this->request->getPost('email'),
                'password'  => $hashedPassword,
                'phone'     => $this->request->getPost('phone'),
                'role'      => $this->request->getPost('role'),
                'status'    => $this->request->getPost('status')
            ]);

            return redirect()->to(current_url())->with('success', 'User added successfully!');
        }

        return view('user/create_user');
    }


    public function candList(){

        $data = [];
        return view('user/candidates_list',$data);
    }


    public function usersList(){
        return view('user/users_list');
    }

    public function fetchUsers()
    {
        $request = service('request');

        // DataTables parameters
        $draw = $request->getGet('draw');
        $start = (int) $request->getGet('start');
        $length = (int) $request->getGet('length');
        $searchValue = $request->getGet('search')['value'];

        

        // Search filter
        if (!empty($searchValue)) {
            $this->userModel->like('user_name', $searchValue);
            $this->userModel->orLike('email', $searchValue);
            $this->userModel->orLike('cnic', $searchValue);
        }

        // Get filtered data
        $users = $this->userModel->limit($length, $start)->find();

        // Total records
        $totalRecords = $this->userModel->countAll();
        $totalFiltered = $this->userModel->like('user_name', $searchValue)->orLike('email', $searchValue)->countAllResults();

        // Format response
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                $user['user_id'],
                $user['user_name'],
                $user['email'],
                $user['cnic'],
                $user['phone'],
                $user['role'],
                $user['status']
            ];
        }

        return $this->response->setJSON([
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }
   
}
