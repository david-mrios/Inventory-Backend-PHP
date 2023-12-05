<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Inventario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idInventario' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'NumInventario' => [
                'type' => 'INT',
                'null' => false,
            ],
            'idFacultad' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'idRecinto' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'idDependencia' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'ResponsableInss' => [
                'type' => 'INT',
                'null' => false,
            ],
            'CustodioInss' => [
                'type' => 'INT',
                'null' => false,
            ],
            'FechaIngreso' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('idInventario', true);
        $this->forge->addForeignKey('idFacultad', 'Facultad', 'idFacultad', '', 'CASCADE');
        $this->forge->addForeignKey('idRecinto', 'Recinto', 'idRecinto',  '', 'CASCADE');
        $this->forge->addForeignKey('idDependencia', 'Dependencia', 'IdDependencia',  '', 'CASCADE');
        $this->forge->createTable('Inventario');
    }

    public function down()
    {
        $this->forge->dropTable('Inventario');
    }
}
