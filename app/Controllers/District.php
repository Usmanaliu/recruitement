<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;


use App\Models\Districts;
use App\Models\PoliceStations;

class District extends BaseController
{
    protected $districtModel;
    protected $policeStationModel;
    
    public function __construct()
    {
        $this->districtModel = new Districts();
        $this->policeStationModel = new PoliceStations();
    }
    
    public function edit()
    {
        
        $data = $this->districtModel->getAllDistricts();        
        return $data;
    }

    public function getPoliceStations()
    {
        $districtId = $this->request->getVar('district_id');
        $policeStations = $this->policeStationModel->getPoliceStationsByDistrict($districtId);
        
        return $this->response->setJSON($policeStations);
    }

    public function update()
    {
        // Handle form submission and update candidate info
        $data = [
            'permanent_district' => $this->request->getPost('permanent_district'),
            'permanent_add_ps'    => $this->request->getPost('permanent_add_ps'),
            'current_district'    => $this->request->getPost('current_district'),
            'current_add_ps'      => $this->request->getPost('current_add_ps'),
            // ... other fields
        ];
        
        // Save to database using your candidate model
        // $candidateModel->update($id, $data);
        
        return redirect()->back()->with('success', 'Information updated successfully');
    }
}
