<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetalleMovEqTec extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDetalleMovEqTec' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'noMovimiento' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'idEquipoTecnologico' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idDetalleMovEqTec', true);
        $this->forge->addForeignKey('noMovimiento', 'Movimiento', 'noMovimiento', '', 'CASCADE');
        $this->forge->addForeignKey('idEquipoTecnologico', 'EquipoTecnologico', 'idEquipoTecnologico', '', 'CASCADE');
        $this->forge->createTable('detalleMovEqTec');
    }

    public function down()
    {
        $this->forge->dropTable('detalleMovEqTec');
    }
}
