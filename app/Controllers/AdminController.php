<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\JobsModel;
use App\Models\ReqModel;
use App\Models\JobApplicationModel;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends BaseController
{
    protected $userModel;
    protected $applicationModel;
    protected $jobModel;
    protected $requiremetsModel;
    protected $educationModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->applicationModel = new JobApplicationModel();
        $this->jobModel = new JobsModel();
        $this->requiremetsModel = new ReqModel();
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
        if ($this->request->getMethod() === "POST") {
            $rules = [
                'job_title' => [
                    'rules'  => 'required|max_length[255]',
                    'errors' => [
                        'required'   => 'Job Title is required.',
                        'max_length' => 'Job Title cannot exceed 255 characters.'
                    ]
                ],
                'job_type' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Job Type is required.'
                    ]
                ],
                'job_scale' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Job Scale is required.'
                    ]
                ],
                'requirements' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => ' required.'
                    ]
                ],
                'job_district' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'district is required.'
                    ]
                ],
                'start_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'start date is required.'
                    ]
                ],
                'closing_date' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'closing data is required.'
                    ]
                ],
                // Add more validation rules as needed
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            } else {
                $jobData = [
                    'job_title' => $this->request->getPost('job_title'),
                    'job_type' => $this->request->getPost('job_type'),
                    'job_scale' => $this->request->getPost('job_scale'),
                    'job_district' => $this->request->getPost('job_district'),
                    'requirements' => $this->request->getPost('requirements'),
                    'start_date' => $this->request->getPost('start_date'),
                    'closing_date' => $this->request->getPost('closing_date')
                ];

                // Save to database
                if ($this->jobModel->save($jobData)) {
                    $jobId = $this->jobModel->insertID();
                    $reqData = [
                        'job_id' => $jobId,
                        'education' => $this->request->getPost('education'),
                        'age_min' => $this->request->getPost('age_min'),
                        'age_max' => $this->request->getPost('age_max'),
                        'height_male' => $this->request->getPost('height_male'),
                        'height_female' => $this->request->getPost('height_female'),
                        'chest' => $this->request->getPost('chest'),
                        'chest_expended' => $this->request->getPost('chest_expended'),
                        'running_male' => $this->request->getPost('running_male'),
                        'running_female' => $this->request->getPost('running_female'),
                        'running_duration_male' => $this->request->getPost('running_duration_male'),
                        'running_duration_female' => $this->request->getPost('running_duration_female'),
                    ];
                    // Save to database
                    if (!$this->requiremetsModel->save($reqData)) {
                        return redirect()->back()->withInput()->with('errors', $this->requiremetsModel->errors());
                    }

                    return redirect()->to(current_url())->with('success', 'Job created successfully!');
                }
            }
        }
        return view('user/create_job');
    }
    public function JobList()
    {
        
        $data['job_list'] = $this->jobModel->select('jobs.*, job_requirements.*')
                                     ->join('job_requirements', 'jobs.job_id = job_requirements.job_id')
                                     ->findAll();
        return view('user/job_list', $data);
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


    public function candList()
    {

        $data = [];
        return view('user/candidates_list', $data);
    }

    public function fetchCandidates()
    {
        $request = service('request');

        // DataTables parameters
        $draw = $request->getGet('draw');
        $start = (int) $request->getGet('start');
        $length = (int) $request->getGet('length');
        $searchValue = $request->getGet('search')['value'];



        // Search filter
        if (!empty($searchValue)) {
            $this->applicationModel->like('cand_name_eng', $searchValue);
            $this->applicationModel->orLike('father_name_eng', $searchValue);
            $this->applicationModel->orLike('cnic', $searchValue);
        }

        // Get filtered data
        $candidates = $this->applicationModel
            ->whereIn('status', ['submitted', 'Rejected'])
            ->limit($length, $start)
            ->find();

        // Total records with filtered status
        $totalRecords = $this->applicationModel
            ->whereIn('status', ['submitted', 'Rejected'])
            ->countAllResults();

        // Total filtered records (with search)
        $totalFiltered = $this->applicationModel
            ->groupStart()
            ->like('cand_name_eng', $searchValue)
            ->orLike('father_name_eng', $searchValue)
            ->groupEnd()
            ->whereIn('status', ['submitted', 'Rejected']) // Ensures filtering applies only to submitted/rejected
            ->countAllResults();

        // Format response
        $data = [];
        $sr = 0;
        foreach ($candidates as $candidate) {
            $sr++;
            $data[] = [
                $sr,
                $candidate['form_number'],
                $candidate['district_domicile'],
                $candidate['cand_name_eng'],
                $candidate['father_name_eng'],
                $candidate['cnic'],
                $candidate['phone'],
                $candidate['status']
            ];
        }
        return $this->response->setJSON([
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ]);
    }


    public function usersList()
    {
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

    public function dashboard()
    {
        return view('user/dashboard');
    }
}
