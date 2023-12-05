<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dependencia extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'IdDependencia' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Departamento' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('IdDependencia', true);
        $this->forge->createTable('Dependencia');

        $data = [
            ['Departamento' => 'Departamento de computación']
        ];

        // Datos definidos
        $this->db->table('Dependencia')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('Dependencia');
    }
}
