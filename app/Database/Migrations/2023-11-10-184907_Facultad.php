<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Facultad extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idFacultad' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Facultdad' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idFacultad', true);
        $this->forge->createTable('Facultad');

        $data = [
            ['Facultdad' => 'Ciencias e Ingeniería']
        ];

        // Datos definidos
        $this->db->table('Facultad')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('Facultad');
    }
}
