<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class CreateTableRequirements extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'req_id' => [
                'type' => 'BIGINT', 
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'job_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
            ],
            'education' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'height_male' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'height_female' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'chest' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'chest_expended' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'running_male' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'running_female' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'running_duration_male' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'running_duration_female' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'age_min' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => true
            ],
            'age_max' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => Time::now('Asia/Karachi', 'en_US')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addPrimaryKey('req_id');
        $this->forge->addForeignKey('job_id', 'jobs', 'job_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('job_requirements');
    }

    public function down()
    {
        //
        $this->forge->dropTable('job_requirements');
    }
}
