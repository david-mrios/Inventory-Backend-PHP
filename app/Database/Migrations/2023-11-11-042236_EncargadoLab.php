<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EncargadoLab extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idEncargado' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'idLab' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'noCarnet' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'fechaEntrada' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'fechaSalida' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idEncargado', true);
        $this->forge->addForeignKey('noCarnet', 'Instructor', 'noCarnet', '', 'CASCADE');
        $this->forge->addForeignKey('idLab', 'Laboratorio', 'idLab', '', 'CASCADE');
        $this->forge->createTable('EncargadoLab');
    }

    public function down()
    { 
        $this->forge->dropTable('EncargadoLab');
    }
}
