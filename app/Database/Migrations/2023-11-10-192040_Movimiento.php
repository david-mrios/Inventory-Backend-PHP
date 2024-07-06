<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Movimiento extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'noMovimiento' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'inss' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'idLab' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'idTpMovimiento' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'Fecha' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'LocacionNueva' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'Observacion' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => false,
            ],
        ]);

        $this->forge->addKey('noMovimiento', true);
        $this->forge->addForeignKey('inss', 'responsable', 'inss', '', 'CASCADE');
        $this->forge->addForeignKey('idTpMovimiento', 'Tipo_Movimiento', 'idTipoMovimiento', '', 'CASCADE');
        $this->forge->addForeignKey('idLab', 'Laboratorio', 'idLab', '', 'CASCADE');
        $this->forge->createTable('Movimiento');
    }

    public function down()
    {
        $this->forge->dropTable('Movimiento');
    }
}
