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
            'post_id' => ['type' => 'INT', 'constraint' => 11],
            'district' => ['type' => 'VARCHAR', 'constraint' => 255],
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
            'address' => ['type' => 'TEXT'],
            'qualification' => ['type' => 'VARCHAR', 'constraint' => 255],
            'phone' => ['type' => 'VARCHAR', 'constraint' => 20],
            'job_experience' => ['type' => 'TEXT', 'null' => true],
            'noc_number' => ['type' => 'TEXT', 'null' => true],
            'ex_army' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'ex_army_discharge_certificate_number' => ['type' => 'TEXT', 'null' => true],
            'ex_army_discharge_certificate_date' => ['type' => 'DATE', 'null' => true],
            'army_joining_date' => ['type' => 'DATE', 'null' => true],
            'relative_inPolice' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'relation_relative' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'relative_rank' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'relative_belt_number' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'relative_district' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'applied_at' => ['type' => 'TIMESTAMP', 'null' => false,  'TIMESTAMP','default' => Time::now('Asia/Karachi', 'en_US')],
            'updated_at' => ['type' => 'TIMESTAMP', 'null' => true, 'default' => null, 'on update' => 'CURRENT_TIMESTAMP'],
        ]);

        $this->forge->addPrimaryKey('application_id');
        $this->forge->addForeignKey('post_id', 'jobs', 'job_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('job_applications');
    }

    public function down()
    {
        $this->forge->dropTable('job_applications');
    }
}
