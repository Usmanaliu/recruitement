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
    protected $allowedFields    = [
        'job_id',
        'district_domicile',
        'form_number',
        'cand_name_urdu',
        'cand_name_eng',
        'father_name_urdu',
        'father_name_eng',
        'father_occupation',
        'religion',
        'cast',
        'education',
        'email',
        'dob',
        'cnic',
        'address',
        'qualification',
        'phone',
        'job_experience',
        'noc_number',
        'ex_army',
        'ex_army_discharge_certificate_number',
        'ex_army_discharge_certificate_date',
        'army_joining_date',
        'relative_inPolice',
        'relative_name',
        'relative_job_status',
        'relation_relative',
        'relative_rank',
        'relative_belt_number',
        'relative_district',
        'picture',
        'permanent_district',
        'permanent_add_ps',
        'permanent_address',
        'current_district',
        'current_add_ps',
        'current_address',
        'testimonial1_name',
        'testimonial1_father',
        'testimonial1_address',
        'testimonial1_phone',
        'testimonial2_name',
        'testimonial2_father',
        'status',
        'remarks',
        'testimonial2_address',
        'testimonial2_phone',
        'applied_at',
        'updated_at'
    ];



    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = false;
    protected array $casts = [];
    protected array $castHandlers = [];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'applied_at';
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
