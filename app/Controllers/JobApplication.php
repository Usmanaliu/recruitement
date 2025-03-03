<?php

namespace App\Controllers;

use App\Models\JobApplicationModel;
use App\Models\JobsModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpParser\Node\Expr\FuncCall;

class JobApplication extends Controller
{
    public function index()
    {
        $model = new JobApplicationModel();
        $cnic = '3520000145888';
        $application = $model->where('cnic',$cnic)->first();
        
        if ($application) {
            $age = $this->getAge($application['dob']);
        } else {
            $age = null; // Handle case when no record is found
        }
    
        // Correct way to pass data
        $data = [
            'age' => $age,
            'application' => $application
        ];        return view('job_applications/application', $data);
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
    public function vacancies(){
        $model = new JobsModel();
        $data['jobs'] = $model->findAll();
        return view('apply/vacancies', $data);
    }
    public function requirements($job_id){
        $model = new JobsModel();
        $requirement = $model->find($job_id);
        $data = [
            'requirement' => $requirement
        ];
        return view('apply/requirements', $data);
    }

    public function apply($job_id){
        $model = new JobsModel();
        $job = $model->find($job_id);
    
        // Load the form validation library
        $validation = \Config\Services::validation();
    
        // Set validation rules
        $validation->setRules([
            'cand_cnic' => 'required|numeric|min_length[13]|max_length[13]'
        ]);
    
        // Check if the form validation passes
        if ($this->request->getMethod() === 'post' && $validation->withRequest($this->request)->run()) {
            $cnic = $this->request->getPost('cand_cnic');
            $data = [
                'job' => $job,
                'cnic' => $cnic
            ];
            return view('apply/apply', $data);
        } else {
            // Validation failed, show errors
            $data = [
                'job' => $job,
                'validation' => $validation
            ];
            return view('apply/apply', $data);
        }
    }
}
