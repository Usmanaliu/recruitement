<?php

namespace App\Controllers;

use App\Models\JobApplicationModel;
use App\Models\JobsModel;
use App\Models\ReqModel;
use App\Models\EducationModel;
use App\Controllers\District;

use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

// use setasign\Fpdi\Tcpdf\Tcpdf;
use TCPDF;

use Illuminate\Contracts\Validation\Validator;
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
    public function index($job_id)
    {
        $data = [
            'application' => null,
            'age' => null,
        ];
        if($this->request->getMethod() === 'POST'){
            $cnic = $this->request->getPost('cnic');
            $application = $this->applicationModel->where('cnic', $cnic)->where('job_id',$job_id)->first();

        if ($application) {
            
                $data['application'] = $application;
                $data['age']   = $this->getAge($application['dob']);
        
        } else {
            session()->setFlashdata('error', 'no record');
        }
        }
        
        return view('getApplication/application', $data);
    }
    public function download($application_id) {
        // Clean output buffer
        ob_start();
    
        $application = $this->applicationModel->find($application_id);
        $data = [
            'application' => $application,
            'age' => $this->getAge($application['dob']),
            'job' => $this->jobModel->find($application['job_id'])
        ];
        
        return view('job_applications/application_copy', $data);
        // $html = ob_get_clean();
    
        // // Remove extra whitespace
        // $html = preg_replace('/>\s+</', '><', $html);
        
        // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // $pdf->SetCreator('Punjab Police');
        // $pdf->AddPage();
        // $pdf->writeHTML($html, true, false, true, false, '');
        // $pdf->Output('application_form.pdf', 'D');
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

        $data['jobs'] = $this->jobModel->select('jobs.*, job_requirements.*')
                                     ->join('job_requirements', 'jobs.job_id = job_requirements.job_id')
                                     ->findAll();
        return view('apply/vacancies', $data);

        // $jobs = $this->jobModel->findAll();

        // $data = [
        //     'jobs' => $jobs,
        // ];

        // return view('apply/vacancies', $data);
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
    
        if (!$application) {
            return $this->response->setJSON(['error' => 'Application not found']);
        }
    
        $complete = !empty($application['picture']) 
            && !empty($application['cand_name_eng']) 
            && !empty($application['education']) 
            && isset($application['relative_Police']) // Since it can be "0", check with isset()
            && !empty($application['testimonial1_name']) 
            && $this->educationModel->existsForApplication($applicationId);
    
        $status = $application['status'] != 'Rejected';
    
        if($complete){
            if($status){$form_number = $this->applicationModel
                ->where('district_domicile', $application['district_domicile'])
                ->selectMax('form_number')
                ->get()
                ->getRowArray();
            
            $form_number = $form_number['form_number'] ?? 0; // Ensure default value if NULL
            $form_number = $form_number + 1;
            
            $updateData = [
                'status' => 'submitted',
                'remarks' => 'pending',
                'form_number' => $form_number
            ];
            
            if ($this->applicationModel->update($applicationId, $updateData)) {
                return redirect()->to('/SearchApplication/' . $application['job_id']);  
            } else {
                return redirect()->back()->with('status', 'Fail to submit your application');
            }
            

            }else{
                
               return redirect()->back()->with('status',$application['status']);
            }
        }else{
            return redirect()->back()->with('status','Please add your complete information first');
        }

        return $this->response->setJSON([
            'complete' => $complete,
            'status' => $status,
            'application' => $application
        ]);
    }
    


    // Submit Application
    public function submitApplication($applicationId)
    {
        $model = $this->applicationModel;
        $model->update($applicationId, ['status' => 'submitted']);
        // Add any final validation logic
    }
    function checkAge($dob, $minAge, $maxAge, $lastDate) {
        $dob = new \DateTime($dob); // Convert string DOB to DateTime object
        $today = new \DateTime($lastDate);   // Get current date
    
        // Calculate the minimum and maximum allowed birth dates
        $minDate = (clone $today)->modify("-{$maxAge} years -1 day"); // Max age limit (25 years + 1 day)
        $maxDate = (clone $today)->modify("-{$minAge} years"); // Min age limit (18 years)
    
        if ($dob > $maxDate) {
            return "Underage";
        } elseif ($dob <= $minDate) {
            return "Overage";
        } else {
            return "Eligible";
        }
    }
    
    


    public function genInfoSave()
    {
        // Load form helper and validation
        helper('form');

        $applicationId = $this->request->getPost('application_id');
        
        $model = $this->applicationModel;
        $application = $model->find($applicationId);
        $jobmodel = $this->jobModel;
        $job = $jobmodel->find($application['job_id']);
        $requirement = $this->requirementModel->where('job_id',$application['job_id'])->first();

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
            'phone' => 'required|max_length[255]',

        ];

        $status = ($this->checkAge($this->request->getPost('dob'),$requirement['age_min'],$requirement['age_max'],$job['closing_date']) === 'Eligible') ? 'Eligible': 'Rejected';
        $remarks = $this->checkAge($this->request->getPost('dob'),$requirement['age_min'],$requirement['age_max'],$job['closing_date']);
        if ($this->validate($rules)) {
            // Get form data
            $data = [
                'district_domicile' => $this->request->getPost('district'),
                'cand_name_urdu' => $this->request->getPost('cand_name_urdu'),
                'cand_name_eng' => $this->request->getPost('cand_name_eng'),
                'gender' => $this->request->getPost('gender'),
                'father_name_urdu' => $this->request->getPost('father_name_urdu'),
                'father_name_eng' => $this->request->getPost('father_name_eng'),
                'father_occupation' => $this->request->getPost('father_occupation'),
                'religion' => $this->request->getPost('religion'),
                'email' => $this->request->getPost('email'),
                'cast' => $this->request->getPost('cast'),
                'dob' => $this->request->getPost('dob'),
                'phone' => $this->request->getPost('phone'),
                'status' => $status,
                'remarks' => $remarks
            ];
            
            // Insert into database
            if ($model->update($applicationId, $data)) {
                // Redirect back with success 
                
                return redirect()->to('/application-page?application_id=' . $applicationId);
                
            } else {
                // Redirect back with error message
                return redirect()->back()->with('error', 'Failed to save data!');
            }
        } else {
            // Return with validation errors
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }
    }

    public function form_info($Getapplication_id = null)
    {
        helper('form');
        if ($this->request->getMethod() == 'POST') {
            $application_id = $this->request->getPost('application_id');
        } else {
            $application_id = $Getapplication_id;
        }
        
        $data = [
            'application' => $this->applicationModel->find($application_id),
            'application_id' =>$application_id
        ];
        return view('apply/gen_info_form', $data);
    }


    public function eduForm($Getapplication_id = null)
    {
        helper('form');
        if ($this->request->getMethod() == 'POST') {
            $application_id = $this->request->getPost('application_id');
        } else {
            $application_id = $Getapplication_id;
        }

        $data = [
            'educations' => $this->educationModel->where('application_id', $application_id)->findAll(),
            'application_id' => $application_id
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
            return redirect()->back()->withInput()->with('errors', $errors);
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

    public function applicationPage($application_id = null)
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


    public function relativeFormData($Getapplication_id = null)
    {
        helper('form');

        if ($this->request->getMethod() == 'post') {
            $application_id = $this->request->getPost('application_id');
        } else {
            $application_id = $Getapplication_id;
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
            $data['relation_name'] = 'Nil';
            $data['relation_relative'] = 'Nil';
            $data['relative_rank'] = 'Nil';
            $data['relative_belt_number'] = 'Nil';
            $data['relative_district'] = 'Nil';
            $data['relative_job_status'] = 'Nil';
            $data['relative_Police'] = 0;
        } else {
            $data = [
                'relative_Police' => $this->request->getPost('relative_Police'),
                'relation_relative' => $this->request->getPost('relation_relative'),
                'relative_name' => $this->request->getPost('relative_name'),
                'relative_rank' => $this->request->getPost('relative_rank'),
                'relative_belt_number' => $this->request->getPost('relative_belt_number'),
                'relative_job_status' => $this->request->getPost('relative_job_status'),
                'relative_district' => $this->request->getPost('relative_district'),
            ];
            $rules = [
                'relative_Police' => 'required|numeric',
                'relation_relative' => 'required|max_length[255]',
                'relative_rank' => 'required|max_length[255]',
                'relative_belt_number' => 'required|max_length[255]',
                'relative_district' => 'required|max_length[255]',
            ];
            if (!$this->validate($rules)) {
                return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
            }
        }

        if ($this->applicationModel->update($application_id, $data)) {
            return redirect()->to('/application-page?application_id=' . $application_id);
        } else {
            return redirect()->back()->with('errors', 'Failed to save data!');
        }
    }

    public function experianceFromView($Getapplication_id = null)
    {

        helper('form');
        if ($this->request->getMethod() === 'GET') {

            $application_id = $Getapplication_id;
        }


        return view('apply/Exp_form', ['application_id' => $application_id]);
    }

    public function ExpSave()
    {

        if ($this->request->getMethod() === 'POST') {
            $application_id = $this->request->getVar('application_id');
            $isExp = $this->request->getVar('isExperience');
            $Ex_army = $this->request->getVar('ex_army');
        }

        if (!$isExp) {

            $expData = [
                'job_experience' => 'Nil',
                'noc_number' => 'Nil'
            ];
        } else {
            $expData = [
                'job_experience' => $this->request->getVar('job_experience'),
                'noc_number' => $this->request->getVar('noc_number')
            ];
        }


        if (!$Ex_army) {

            $armyData = [
                'ex_army'=> false,
                'army_joining_date' => null,
                'ex_army_discharge_certificate_number' => 'Nil',
                'ex_army_discharge_certificate_date' => null
            ];
        } else {

            $armyData = [
                'ex_army'=> $this->request->getVar('ex_army'),
                'army_joining_date' => $this->request->getVar('army_joining_date'),
                'ex_army_discharge_certificate_number' => $this->request->getVar('ex_army_discharge_certificate_number'),
                'ex_army_discharge_certificate_date' => $this->request->getVar('ex_army_discharge_certificate_date')
            ];
        }

        $data = [
            'job_experience' => $expData['job_experience'],
            'noc_number' => $expData['noc_number'],
            'ex_army' => $armyData['ex_army'],
            'army_joining_date' => $armyData['army_joining_date'],
            'ex_army_discharge_certificate_number' => $armyData['ex_army_discharge_certificate_number'],
            'ex_army_discharge_certificate_date' => $armyData['ex_army_discharge_certificate_date'] 
        ];

        if($this->applicationModel->update($application_id,$data)){
            return redirect()->to('/application-page?application_id=' . $application_id);
        }else{
            redirect()->back()->with('errors', 'failed to save data');
        }
    }

    public function AddInfo($application_id)
{
    helper('form');
    $districtController = new District();
    $districts = $districtController->edit();
    $application = $this->applicationModel->find($application_id);
    $data = [
        'application' => $application,
        'districts' => $districts
    ];

    if ($this->request->getMethod() === 'POST') { 
        $rules = [
            'permanent_district' => 'required',
            'permanent_add_ps' => 'required',
            'permanent_address' => 'required',
            'current_district' => 'required',
            'current_add_ps' => 'required',
            'current_address' => 'required'
        ];

        if ($this->validate($rules)) {
            $addData = [
                'permanent_district' => $this->request->getVar('permanent_district'),
                'permanent_add_ps' => $this->request->getVar('permanent_add_ps'),
                'permanent_address' => $this->request->getVar('permanent_address'),
                'current_district' => $this->request->getVar('current_district'),
                'current_add_ps' => $this->request->getVar('current_add_ps'),
                'current_address' => $this->request->getVar('current_address')
            ];
        } else {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }
            // Ensure data is not empty before 
            
            if (!empty(array_filter($addData))) {
                if ($this->applicationModel->update($application_id, $addData)) {
                    log_message('info','message',$addData);
                    return redirect()->to('/application-page?application_id=' . $application_id);
                } else {
                    return redirect()->back()->with('error', 'Failed to update information.');
                }
            } else {
                return redirect()->back()->with('error', 'No changes detected.');
            }

    }else{

        return view('apply/Address_form', $data);
    }

}

public function testimonial($application_id){
    helper('form');
       
    if($this->request->getMethod() === 'POST'){
        $application_id = $this->request->getPost('application_id');
        $rules = [
            'testimonial1_name' =>      'required',             
	        'testimonial1_father' => 'required',
            'testimonial1_address' => 'required',
            'testimonial1_phone' => 'required',
            'testimonial2_name' =>  'required',
            'testimonial2_father' =>  'required',
            'testimonial2_address' =>  'required',
            'testimonial2_phone' =>  'required',
        ];
        if(!$this->validate($rules)){
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }else{
            $data = [
            'testimonial1_name' =>  $this->request->getPost('testimonial1_name'),
	        'testimonial1_father' => $this->request->getPost('testimonial1_father'),
            'testimonial1_address' => $this->request->getPost('testimonial1_address'),
            'testimonial1_phone' => $this->request->getPost('testimonial1_phone'),
            'testimonial2_name' =>  $this->request->getPost('testimonial2_name'),
            'testimonial2_father' =>  $this->request->getPost('testimonial2_father'),
            'testimonial2_address' =>  $this->request->getPost('testimonial2_address'),
            'testimonial2_phone' =>  $this->request->getPost('testimonial2_phone'),
                
            ];
            if(!empty(array_filter($data))){
                $data = array_filter($data, fn($value) => !empty($value));
                log_message('debug', 'Application ID: ' . print_r($application_id, true));
log_message('debug', 'Data to update: ' . print_r($data, true));

            if($this->applicationModel->update($application_id,$data)){
                return redirect()->to('/application-page?application_id=' . $application_id);
            }else{
                  return redirect()->back()->with('error', 'Failed to update information.')->withInput();
            }
        }else{
            return redirect()->back()->with('errorData', 'no data.')->withInput();
        }
        }
    }


    return view('apply/testimonial_form',['application_id' => $application_id]);
}

}
