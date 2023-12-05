<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MarcaEquipo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idMarca' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'marca' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idMarca', true);
        $this->forge->createTable('marca_equipo');

        $data = [
            'marca' => 'Lenovo'
        ];

        // Using Query Builder to insert data
        $this->db->table('marca_equipo')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('marca_equipo');
    }
}
