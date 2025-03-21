<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class CreateJobApplicationsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'application_id' => ['type' => 'BIGINT', 'constraint' => 20, 'auto_increment' => true],
            'job_id' => ['type' => 'INT', 'constraint' => 11,],
            'form_number' => ['type' => 'INT', 'constraint' => 11,],
            'district_domicile' => ['type' => 'VARCHAR', 'constraint' => 255],
            'cand_name_urdu' => ['type' => 'VARCHAR', 'constraint' => 255],
            'cand_name_eng' => ['type' => 'VARCHAR', 'constraint' => 255],
            'father_name_urdu' => ['type' => 'VARCHAR', 'constraint' => 255],
            'father_name_eng' => ['type' => 'VARCHAR', 'constraint' => 255],
            'father_occupation' => ['type' => 'VARCHAR', 'constraint' => 255],
            'religion' => ['type' => 'VARCHAR', 'constraint' => 255],
            'cast' => ['type' => 'VARCHAR', 'constraint' => 255],
            'education' => ['type' => 'VARCHAR', 'constraint' => 255],
            'dob' => ['type' => 'DATE'],
            'cnic' => ['type' => 'VARCHAR', 'constraint' => 15],
            'email' => ['type' => 'VARCHAR', 'constraint' => 30],
            'permanent_district' => ['type' => 'VARCHAR', 'constraint' => 255],
            'permanent_address' => ['type' => 'TEXT'],
            'permanent_add_ps' => ['type' => 'VARCHAR', 'constraint' => 255],
            'current_district' => ['type' => 'VARCHAR', 'constraint' => 255],
            'current_address' => ['type' => 'TEXT'],
            'current_add_ps' => ['type' => 'VARCHAR', 'constraint' => 255],
            'qualification' => ['type' => 'VARCHAR', 'constraint' => 255],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'job_experience' => ['type' => 'TEXT', 'null' => true],
            'noc_number' => ['type' => 'TEXT', 'null' => true],
            'ex_army' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'ex_army_discharge_certificate_number' => ['type' => 'TEXT', 'null' => true],
            'ex_army_discharge_certificate_date' => ['type' => 'DATE', 'null' => true],
            'army_joining_date' => ['type' => 'DATE', 'null' => true],
            'relative_Police' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'relative_name' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Nil'],
            'relation_relative' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'relative_rank' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'relative_belt_number' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'relative_district' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'relative_job_status' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'testimonial1_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Nil'],
            'testimonial1_father' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Nil'],
            'testimonial1_address' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Nil'],
            'testimonial1_phone' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Nil'],
            'testimonial2_name' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Nil'],
            'testimonial2_father' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Nil'],
            'testimonial2_address' => ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'Nil'],
            'testimonial2_phone' => ['type' => 'VARCHAR', 'constraint' => 100, 'default' => 'Nil'],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other'],
            ],
            'picture' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'Incomplete'
            ],
            'remarks' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'Incomplete'
            ],

            'applied_at' => ['type' => 'TIMESTAMP', 'null' => false,  'default' => null, 'on update' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'TIMESTAMP', 'null' => false, 'default' => null, 'on update' => 'CURRENT_TIMESTAMP'],

        ]);

        $this->forge->addPrimaryKey('application_id');
        $this->forge->addForeignKey('job_id', 'jobs', 'job_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('job_applications');
    }

    public function down()
    {
        $this->forge->dropTable('job_applications');
    }
}
