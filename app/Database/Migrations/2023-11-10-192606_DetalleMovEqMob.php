<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetalleMovEqMob extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDetalleMovEqMob' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'noMovimiento' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'idEquipoMobiliario' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idDetalleMovEqMob', true);
        $this->forge->addForeignKey('noMovimiento', 'Movimiento', 'noMovimiento', '', 'CASCADE');
        $this->forge->addForeignKey('idEquipoMobiliario', 'EquipoMobiliario', 'idEquipoMobiliario', '', 'CASCADE');
        $this->forge->createTable('detalleMovEqMob');
    }

    public function down()
    {
        $this->forge->dropTable('detalleMovEqMob');
    }
}
