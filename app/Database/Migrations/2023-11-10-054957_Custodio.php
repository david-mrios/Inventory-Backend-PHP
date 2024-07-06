<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Custodio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'inss' => [
                'type' => 'INT',
                'unsigned' => true, //  el campo solo puede contener valores no negativos
                'auto_increment' => false
            ],
            'nombres' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'apellidos' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'telefono' => [
                'type' => 'INT',
                'null' => false,
            ],
            'cedula' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('inss', true);
        $this->forge->createTable('custodio');

        $data = [
            'inss' => 22043593, // Valor del inss
            'nombres' => 'David Antonio', // Nombre del custodio
            'apellidos' => 'Mendoza Rios', // Apellido del custodio
            'telefono' => 88407469, // Número de teléfono
            'cedula' => '12345678912345', // Valor de la cédula
            'deleted_at' => null, // No eliminado
        ];

        // Using Query Builder to insert data
        $this->db->table('custodio')->insertBatch($data);

    }

    public function down()
    {
        $this->forge->dropTable('custodio');
    }
}
