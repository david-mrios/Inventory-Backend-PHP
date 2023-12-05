<?php

namespace App\Database\Migrations;


use CodeIgniter\Database\Migration;

class EquipoTecnologico extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idEquipoTecnologico' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'inss' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'numeroArt' => [
                'type' => 'INT',
                'null' => false,
            ],
            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'etiqueta' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'cantidad' => [
                'type' => 'INT',
                'null' => false,
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => false,
            ],
            'modelo' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'idMarca' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'serie' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
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
                'constraint' => '150',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idEquipoTecnologico', true);

        $this->forge->addForeignKey('inss', 'custodio', 'inss', '', 'CASCADE');
        $this->forge->addForeignKey('idMarca', 'marca_equipo', 'idMarca', '', 'CASCADE');
        $this->forge->addForeignKey('idEstado', 'estado', 'idEstado', '', 'CASCADE');
        
        $this->forge->createTable('EquipoTecnologico');


    }

    public function down()
    {
        $this->forge->dropTable('EquipoTecnologico');
    }
}
