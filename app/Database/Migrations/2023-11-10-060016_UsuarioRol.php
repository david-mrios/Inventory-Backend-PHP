<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuarioRol extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_role' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'role_name' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'role_description' => [
                'type' => 'VARCHAR',
                'constraint' => 250,
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_role', true);
        $this->forge->createTable('user_rol');


        $data = [
            [
                'role_name' => 'Instructor',
                'role_description' => 'Encargados de los laboratorios'
            ]
        ];

        // Datos definidos
        $this->db->table('user_rol')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('user_rol');
    }
}
