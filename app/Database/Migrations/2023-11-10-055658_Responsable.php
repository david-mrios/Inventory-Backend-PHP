<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Responsable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'inss' => [
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

        $this->forge->addKey('inss', true);
        $this->forge->createTable('responsable');
    }

    public function down()
    {
        $this->forge->dropTable('responsable');
    }
}
