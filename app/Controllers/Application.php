<?php

    namespace App\Controllers;

    

    class Application extends BaseController{
        public function index(){
            
                $data =[
                    'job_title' => 'Constable',
                    'candidate_name' => 'usman',
                    'cnic' => '3520229198827',
                    'father_name' => 'Muhammad Irshad'
                ];
                
                $applicationModel = new \App\Models\Application();


                echo view('templates/header');
                echo view('application', $data);
                echo view('templates/footer');

          
        }
    }