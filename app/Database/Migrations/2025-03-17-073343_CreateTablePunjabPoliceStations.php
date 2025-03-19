<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePunjabPoliceStations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'district_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ]
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('district_id', 'punjab_districts', 'district_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('police_stations');
    }

    public function down()
    {
        $this->forge->dropTable('police_stations');
    }
}
