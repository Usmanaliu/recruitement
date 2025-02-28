<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUniqueToCnicField extends Migration
{
    public function up()
    {
        // Add unique constraint on the 'cnic' field
        $this->forge->modifyColumn('applications', [
            'cnic' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'unique' => true,  // Set the 'cnic' field to be unique
            ],
        ]);
    }

    public function down()
    {
        // If rollback is needed, remove the unique constraint
        $this->forge->modifyColumn('applications', [
            'cnic' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
    }
}
