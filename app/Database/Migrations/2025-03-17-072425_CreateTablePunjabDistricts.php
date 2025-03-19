<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePunjabDistricts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'district_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'district_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ]
        ]);

        $this->forge->addPrimaryKey('district_id');
        $this->forge->createTable('punjab_districts');
    }

    public function down()
    {
        $this->forge->dropTable('punjab_districts');
    }
}
