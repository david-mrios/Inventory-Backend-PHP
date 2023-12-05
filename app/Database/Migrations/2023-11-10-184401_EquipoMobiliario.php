<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EquipoMobiliario extends Migration
{
public function up()
    {
        $this->forge->addField([
            'idEquipoMobiliario' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'inss' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'numeroArticulo' => [
                'type' => 'INT',
                'null' => true,
            ],
            'etiqueta' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'cantidad' => [
                'type' => 'INT',
                'null' => true,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'costo' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
            'idEstado' => [
                'type' => 'INT',
                'unsigned' => true, 
                'null' => true,
            ],
            'observacion' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idEquipoMobiliario', true);
        $this->forge->addForeignKey('inss', 'custodio', 'inss', '', 'CASCADE');
        $this->forge->addForeignKey('idEstado', 'estado', 'idEstado', '', 'CASCADE');
        $this->forge->createTable('EquipoMobiliario');

    }

    public function down()
    {
        $this->forge->dropTable('EquipoMobiliario');
    }
}
