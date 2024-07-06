<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Estado extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idEstado' => [
                'type' => 'INT',
                'unsigned' => true, 
                'auto_increment' => true,
            ],
            'estado' => [
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idEstado', true);
        $this->forge->createTable('estado');

        $data = [
            ['estado' => 'Bueno'],
            ['estado' => 'Malo'],
        ];

        // Datos definidos
        $this->db->table('estado')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('estado');
    }
}
