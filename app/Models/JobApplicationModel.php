<?php

namespace App\Models;

use CodeIgniter\Model;

class JobApplicationModel extends Model
{
    protected $table            = 'job_applications';
    protected $primaryKey       = 'application_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'job_id','district','cand_name_urdu','cand_name_eng','father_name_urdu','father_name_eng', 'father_occupation','religion','cast','education','dob','cnic','address','qualification','phone', 'job_experience','noc_number','ex_army','ex_army_discharge_certificate_number','ex_army_discharge_certificate_date','army_joining_date','relative_inPolice','relation_relative','relative_rank','relative_belt_number','relative_district','picture'];
    
    
    
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected array $casts = [];
    protected array $castHandlers = [];
    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function job()
    {
        return $this->belongsTo(jobsModel::class, 'job_id');
    }

    
    
}


