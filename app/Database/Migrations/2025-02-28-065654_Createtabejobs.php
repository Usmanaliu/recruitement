<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class Createtabejobs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'job_id' => [
                'type' => 'INT', 'constraint' => 11, 'auto_increment' => true,
            ],
            'job_type' => [
                'type' => 'VARCHAR', 'constraint' => 255
            ],
            'job_title' => [
                'type' => 'VARCHAR', 'constraint' => 255
            ],
            'job_scale' => [
                'type' => 'VARCHAR', 'constraint' => 255
            ],
            'requirements' => [
                'type' => 'VARCHAR', 'constraint' => 255
            ],
            'job_district' => [
                'type' => 'VARCHAR', 'constraint' => 255
            ],
            'start_date' => ['type' => 'DATE'],
            'closing_date' => ['type' => 'DATE'],
        ]);
        $this->forge->addPrimaryKey('job_id');
        $this->forge->createTable('jobs');   
    }

    public function down()
    {
        //
        $this->forge->dropTable('jobs');
    }
}
