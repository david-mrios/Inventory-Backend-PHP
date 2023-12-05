<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Instructor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'noCarnet' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => false,
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'telefono' => [
                'type' => 'INT',
                'null' => false,
            ],
            'cedula' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('noCarnet', true);
        $this->forge->createTable('instructor');
    }

    public function down()
    {
        $this->forge->dropTable('instructor');
    }
}
