<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Recinto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idRecinto' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'Recinto' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idRecinto', true);
        $this->forge->createTable('Recinto');

        $data = [
            ['Recinto' => 'Rubén Darío RURD-016P1001-C']
        ];

        // Datos definidos
        $this->db->table('Recinto')->insertBatch($data);


    }

    public function down()
    {
        $this->forge->dropTable('Recinto');
    }
}
