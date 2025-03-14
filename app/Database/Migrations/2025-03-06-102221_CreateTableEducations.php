<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEducationTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'edu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'set_id' => [
                'type' => 'TINYINT',
                'constraint' => 2,
                'comment' => '1=Matric, 2=Intermediate, 3=Bachelor, 4=Masters, 5=PhD'
            ],
            'application_id' => [
                'type' => 'BIGINT',
                'constraint' => 20,
                
            ],
            'degree' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            
            'degree_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            
            'institue_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'board' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],

            'result_date' => [
                'type' => 'DATE',
                'null' => false
            ],
            'obt_marks' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'full_marks' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'percentage' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('edu_id');
        $this->forge->addForeignKey('application_id', 'job_applications', 'application_id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('educations');
    }

    public function down()
    {
        $this->forge->dropTable('educations');
    }
}