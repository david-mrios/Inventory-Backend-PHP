<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetalleInvEqMobiliario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDetalleInv' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'idInventario' => [
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

        $this->forge->addKey('idDetalleInv', true);
        $this->forge->addForeignKey('idInventario', 'Inventario', 'idInventario', '', 'CASCADE');
        $this->forge->addForeignKey('idEquipoMobiliario', 'EquipoMobiliario', 'idEquipoMobiliario', '', 'CASCADE');
        $this->forge->createTable('Detalle_Inv_EqMobiliario');
    }

    public function down()
    {
        $this->forge->dropTable('Detalle_Inv_EqMobiliario');
    }
}
