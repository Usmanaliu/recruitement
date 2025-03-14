<?php

namespace App\Controllers;

use App\Models\JobApplicationModel;
use App\Models\JobsModel;
use App\Models\ReqModel;
use App\Models\EducationModel;

use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpParser\Node\Expr\FuncCall;

class JobApplication extends Controller
{
    protected $educationModel;
    protected $applicationModel;
    protected $jobModel;
    protected $requirementModel;

    public function __construct()
    {
        $this->educationModel = new EducationModel();
        $this->applicationModel = new JobApplicationModel();
        $this->jobModel = new JobsModel();
        $this->requirementModel = new ReqModel();
    }
    public function index()
    {
        $model = new JobApplicationModel();
        $cnic = '3520000145888';
        $application = $model->where('cnic', $cnic)->first();

        if ($application) {
            $age = $this->getAge($application['dob']);
        } else {
            $age = null; // Handle case when no record is found
        }

        // Correct way to pass data
        $data = [
            'age' => $age,
            'application' => $application
        ];
        return view('job_applications/application', $data);
    }

    private function getAge($dob)
    {
        $dobObject = new \DateTime($dob);
        $today = new \DateTime();
        $year = $dobObject->diff($today)->y; // Get difference in years
        $month = $dobObject->diff($today)->m; // Get difference in years
        $days = $dobObject->diff($today)->d; // Get difference in years
        $age = [
            'year' => $year,
            'month' => $month,
            'days'  => $days
        ];
        return $age;
    }

    public function generatePDF($id)
    {
        $model = new JobApplicationModel();
        $data['application'] = $model->find($id);

        $dompdf = new Dompdf();
        $options = new Options();
        $options->set('defaultFont', 'Noto Nastaliq Urdu');
        $dompdf->setOptions($options);

        $html = view('job_applications/pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("job_application.pdf", ["Attachment" => 1]);
    }



    public function vacancies()
    {


        $jobs = $this->jobModel->findAll();

        $data = [
            'jobs' => $jobs,
        ];

        return view('apply/vacancies', $data);
    }



    public function getRequirements($job_id)
    {
        $model = $this->requirementModel; // Your model that handles requirements
        $requirements = $model->select([
            'education',
            'height_male',
            'height_female',
            'chest',
            'chest_expended',
            'running_male',
            'running_female',
            'running_duration_male',
            'running_duration_female',
            'age_min',
            'age_max'
        ])->where('job_id', $job_id)->findAll();
        $requirement = [];

        if (!empty($requirements[0]['education'])) {
            $requirement['education'] = "Education is " . $requirements[0]['education'] . " with grade C";
        }

        if (!empty($requirements[0]['height_male'])) {
            $requirement['height'] = "For Male height is " . $requirements[0]['height_male'] . " and for Female height is " . $requirements[0]['height_female'];
        }

        if (!empty($requirements[0]['chest'])) {
            $requirement['chest'] = "Chest (only for Male) " . $requirements[0]['chest'] . "inch and after expand: " . $requirements[0]['chest_expended'] . "inch";
        }

        if (!empty($requirements[0]['running_male']) && isset($requirements[0]['running_female'])) {
            $requirement['running'] = "Running for male:" . $requirements[0]['running_male'] . " in " . $requirements[0]['running_duration_male'] . " and for Female: " . $requirements[0]['running_female'] . " in duration " . $requirements[0]['running_duration_female'];
        }

        if (!empty($requirements[0]['age_min']) && isset($requirements[0]['age_max'])) {
            $requirement['age'] = "Age should be between " . $requirements[0]['age_min'] . " and " . $requirements[0]['age_max'];
        }
        return $this->response->setJSON($requirement);
    }

    public function apply($job_id)
    {
        $Jobsmodel = $this->jobModel;;
        $applicationModel = $this->applicationModel;
        $cnic = $this->request->getPost('cand_cnic');
        $job = $Jobsmodel->find($job_id);

        $application = $applicationModel->where('cnic', $cnic)->where('job_id', $job_id)->first();
        //    $application =  $this->response->setJSON($application); 


        if (!empty($application)) {

            $data = [
                'job' => $job,
                'application' => $application
            ];

            return view('apply/apply', $data);
        } else {
            $applicationModel->insert([
                'job_id' => (int)$job_id,
                'cnic' => $cnic,
            ]);
            $application = $applicationModel->where('cnic', $cnic)->where('job_id', $job_id)->first();
            $data = [
                'job' => $job,
                'cnic' => $cnic,
                'application' => $application
            ];
            return view('apply/apply', $data);
        }
    }

    public function uploadedImage()
    {

        $model = $this->applicationModel;
        $applicationId = $this->request->getPost('application_id');




        // Get application data
        $application = $model->find($applicationId);
        if (!$application) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Application not found']);
        }

        // Get uploaded file
        $file = $this->request->getFile('profile_pic');
        if ($file->getSizeByUnit('mb') > 2) { // 2MB limit
            return $this->response->setJSON(['status' => 'error', 'message' => 'File size exceeds 2MB limit']);
        }
        if (!$file->isValid()) {
            return $this->response->setJSON(['status' => 'error', 'message' => $file->getErrorString()]);
        }

        // Generate filename: cnic-jobID.extension
        $fileName = $application['cnic'] . '-' . $application['application_id'] . '.' . $file->getClientExtension();
        // Define upload path
        $uploadPath = FCPATH . 'assets/uploads/';

        // Ensure upload directory exists
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        // Move file to uploads directory
        try {
            $file->move($uploadPath, $fileName, true);
            // Update database record
            log_message('info', 'File uploaded: ' . $fileName);
            $model->update($applicationId, ['picture' => $fileName]);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Image uploaded successfully',
                'fileName' => $fileName // Add this line
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Upload failed: ' . $e->getMessage()]);
        }
    }

    // Save Personal Info
    public function savePersonalInfo()
    {
        $model =  $this->applicationModel;
        $applicationId = $this->request->getPost('application_id');

        $data = [
            'cand_name_eng' => $this->request->getPost('cand_name_eng'),
            // Add all other fields
        ];

        if ($model->update($applicationId, $data)) {
            return $this->response->setJSON(['status' => 'success']);
        }
    }

    // Check Completion
    public function checkCompletion($applicationId)
    {
        $model = $this->applicationModel;
        $application = $model->find($applicationId);
        $complete = null;
        // $complete = !empty($application['picture']) 
        //     && !empty($application['cand_name_eng']) 
        //     && $this->educationModel->existsForApplication($applicationId);

        return $this->response->setJSON(['complete' => $complete]);
    }

    // Submit Application
    public function submitApplication($applicationId)
    {
        $model = $this->applicationModel;
        $model->update($applicationId, ['status' => 'submitted']);
        // Add any final validation logic
    }



    public function genInfoSave()
    {
        // Load form helper and validation
        helper('form');

        $applicationId = $this->request->getPost('application_id');

        $model = $this->applicationModel;
        $jobmodel = $this->jobModel;

        // Validate data
        $rules = [
            'district' => 'required|max_length[255]',
            'cand_name_urdu' => 'required|max_length[255]',
            'cand_name_eng' => 'required|max_length[255]',
            'father_name_urdu' => 'required|max_length[255]',
            'father_name_eng' => 'required|max_length[255]',
            'father_occupation' => 'required|max_length[255]',
            'religion' => 'required|max_length[255]',
            'email' => 'required|max_length[30]',
            'cast' => 'required|max_length[255]',
            'dob' => 'required|max_length[255]',
            'address' => 'required|max_length[255]',
            'phone' => 'required|max_length[255]',

        ];

        if ($this->validate($rules)) {
            // Get form data
            $data = [
                'district' => $this->request->getPost('district'),
                'cand_name_urdu' => $this->request->getPost('cand_name_urdu'),
                'cand_name_eng' => $this->request->getPost('cand_name_urdu'),
                'father_name_urdu' => $this->request->getPost('father_name_urdu'),
                'father_name_eng' => $this->request->getPost('father_name_eng'),
                'father_occupation' => $this->request->getPost('father_occupation'),
                'religion' => $this->request->getPost('religion'),
                'email' => $this->request->getPost('email'),
                'cast' => $this->request->getPost('cast'),
                'dob' => $this->request->getPost('dob'),
                'address' => $this->request->getPost('address'),
                'phone' => $this->request->getPost('phone'),
                // Add all other fields
            ];

            // Insert into database
            if ($model->update($applicationId, $data)) {
                // Redirect back with success 
                $application = $model->find($applicationId);

                $appData = [
                    'job' => $jobmodel->find($application['job_id']),
                    'application' => $application
                ];
                return view('apply/apply', $appData);
            } else {
                // Redirect back with error message
                return redirect()->back()->with('error', 'Failed to save data!');
            }
            // $model->update($applicationId,$data);

            // Redirect back with success message
            // return redirect()->back()->with('success', 'Data saved successfully!');
        } else {
            // Return with validation errors
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
    }

    public function form_info($errors = null)
    {
        helper('form');
        if($this->request->getMethod() == 'post'){
            $application_id = $this->request->getPost('application_id');
        }else{
            $application_id = $this->request->getGet('application_id');
        }
        
        $data = [
            'application_id' => $application_id,
            'errors' => $errors
        ];
        return view('apply/gen_info_form', $data);
    }


    public function eduForm()
    {
        helper('form');
        if($this->request->getMethod() == 'post'){
            $application_id = $this->request->getPost('application_id');
        }else{
            $application_id = $this->request->getGet('application_id');
        }
        
        $data = [
            'educations' => $this->educationModel->where('application_id', $application_id)->findAll(),
            'application_id' => $application_id,
        ];
        return view('apply/education_form', $data);
    }

    public function add()
    {
        helper('form');
        $application_id = $this->request->getPost('application_id');
        $degree = [
            '1' => 'Matric',
            '2' => 'Intermediate',
            '3' => 'Bachelor',
            '4' => 'Masters',
            '5' => 'PhD'
        ];
        $deg_key = (string)($this->request->getPost('set_id'));
        $degree_name = isset($degree[$deg_key]) ? $degree[$deg_key] : 'Unknown';
        $eduData = [
            'application_id' => $application_id,
            'set_id' => $this->request->getPost('set_id'),
            'institue_name' => $this->request->getPost('institue_name'),
            'degree' => $degree_name,
            'degree_title' => $this->request->getPost('degree_title'),
            'board' => $this->request->getPost('board'),
            'obt_marks' => $this->request->getPost('obt_marks'),
            'full_marks' => $this->request->getPost('full_marks'),
            'percentage' => $this->request->getPost('percentage'),
            'result_date' => $this->request->getPost('result_date'),
        ];

        $rules = [
            'set_id' => 'required|numeric',
            'degree_title' => 'required|max_length[255]',
            'institue_name' => 'required|max_length[255]',
            'board' => 'required|max_length[255]',
            'obt_marks' => 'required|numeric',
            'full_marks' => 'required|numeric',
            'percentage' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'result_date' => [
                'rules' => 'valid_date|past_date',
                'errors' => [
                    'past_date' => 'Result date must be in the past'
                ]
            ],
            'application_id' => 'required|numeric'
        ];
        $existing = $this->educationModel
            ->where('application_id', $application_id)
            ->where('set_id', $eduData['set_id'])
            ->first();

        if (!$this->validate($rules)) {

            $errors = $this->validator->getErrors();
            return redirect()->back()->withInput()->with('errors',$errors);
        }

        if ($existing) {

            if ($this->educationModel->update($existing['edu_id'], $eduData)) {

                $this->updateEduInAppli($application_id);

                return $this->eduFormView($application_id);
            } else {

                $errors = ['msg' => 'Failed to add education'];
                return $this->eduFormView($application_id, $errors);
            }
        } else {
            if ($this->educationModel->insert($eduData)) {

                $this->updateEduInAppli($application_id);
                return $this->eduFormView($application_id);
            } else {

                $errors = ['msg' => 'Failed to add education'];
                return $this->eduFormView($application_id, $errors);
            }
        }
    }

    public function updateEduInAppli($application_id)
    {


        $maxSetId = $this->educationModel->selectMax('set_id')
            ->where('application_id', $application_id)
            ->get()
            ->getRow()
            ->set_id; // Extract the max set_id

        // Fetch the full row where set_id is max
        $education = $this->educationModel->where('application_id', $application_id)
            ->where('set_id', $maxSetId)
            ->get()
            ->getRow();
        $this->applicationModel->update($application_id, ['education' => $education->degree]);
    }


    public function delete($id, $application_id)
    {
        helper('form');
        if ($this->educationModel->delete($id)) {
            $this->updateEduInAppli($application_id);
            return $this->eduFormView($application_id);
        } else {
            $errors = [
                'msg' => 'Failed to delete education entry.'
            ];
            return $this->eduFormView($application_id, $errors);
        }
    }

    public function eduFormView($application_id, $errors = null)
    {
        helper('form');


        $data = [
            'educations' => $this->educationModel->where('application_id', $application_id)->findAll(),
            'application_id' => $application_id,
            'errors' => $errors
        ];

        return view('apply/education_form', $data);
    }

    public function applicationPage()
    {
        if ($this->request->getMethod('get')) {
            $application_id = $this->request->getGet('application_id');
        } else {

            $application_id = $this->request->getPost('application_id');
        }

        $application = $this->applicationModel->find($application_id);

        $data = [
            'application' => $application,
            'job'        => $this->jobModel->find($application['job_id'])
        ];
        return view('apply/apply', $data);
    }


    public function relativeFormData()
    {
        helper('form');

        if($this->request->getMethod() == 'post'){
            $application_id = $this->request->getPost('application_id');
        }else{
            $application_id = $this->request->getGet('application_id');
        }
        $data = [
            'application_id' => $application_id,
        ];
        return view('apply/relatives_form', $data);
    }

    public function relativesFormSave()
    {
        helper('form');
$application_id = $this->request->getPost('application_id');
        $is_relative = $this->request->getPost('relative_Police');
        if ($is_relative == 0) {
            $data['relation_relative'] = 'Nil';
            $data['relative_rank'] = 'Nil';
            $data['relative_belt_number'] = 'Nil';
            $data['relative_district'] = 'Nil';
            $data['relative_Police'] = 0;
        }else{
            $data = [
                'relative_Police' => $this->request->getPost('relative_Police'),
                'relation_relative' => $this->request->getPost('relation_relative'),
                'relative_rank' => $this->request->getPost('relative_rank'),
                'relative_belt_number' => $this->request->getPost('relative_belt_number'),
                'relative_district' => $this->request->getPost('relative_district'),
            ];
            $rules = [
                'relative_Police' => 'required|numeric',
                'relation_relative' => 'required|max_length[255]',
                'relative_rank' => 'required|max_length[255]',
                'relative_belt_number' => 'required|max_length[255]',
                'relative_district' => 'required|max_length[255]',
                ];
                if(!$this->validate($rules)){
                    return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
                }
        }
        
            if ($this->applicationModel->update($application_id, $data)) {
                return redirect()->to('/application-page?application_id=' . $application_id);
            } else {
                return redirect()->back()->with('errors', 'Failed to save data!');
            }
        
    }

    public function experianceFromView(){

        helper('form');

        $application_id = $this->request->getVar('application_id');
        
        return view('apply/Exp_form', ['application_id' => $application_id]);
    }

    public function ExpSave(){
        
    }
}
