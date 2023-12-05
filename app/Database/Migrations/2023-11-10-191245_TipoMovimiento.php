<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TipoMovimiento extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idTipoMovimiento' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'tipoMovimiento' => [
                'type' => 'VARCHAR',
                'constraint' => '25',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idTipoMovimiento', true);
        $this->forge->createTable('Tipo_Movimiento');

        $data = [
            ['tipoMovimiento' => 'Traslado'],
            ['tipoMovimiento' => 'Mantenimiento'],
            ['tipoMovimiento' => 'Asignacion']  
        ];

        // Datos definidos
        $this->db->table('Tipo_Movimiento')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('Tipo_Movimiento');

    }
}
