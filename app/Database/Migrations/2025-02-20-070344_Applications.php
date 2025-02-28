<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\I18n\Time;

class Applications extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'applicaton_id' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true, // AUTO_INCREMENT for primary key
            ],
            'job_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255, // Correct length for VARCHAR
            ],
            'candidate_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'cnic' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'father_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'applied_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                 'default' => Time::now('Asia/Karachi', 'en_US'), // Use CURRENT_TIMESTAMP for default value
            ],
        ]);
        

        // Add primary key for auto_increment column
        $this->forge->addPrimaryKey('applicaton_id');
        
        // Create the table
        $this->forge->createTable('applications');
    }

    public function down()
    {
        $this->forge->dropTable('applications');
    }
}
