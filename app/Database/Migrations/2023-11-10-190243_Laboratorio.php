<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laboratorio extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idLab' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'numeroLab' => [
                'type' => 'VARCHAR',
                'constraint' => '10',
                'null' => false,
            ],
            'deleted_at' => [
                'type' => 'INT',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('idLab', true);
        $this->forge->createTable('Laboratorio');
    }

    public function down()
    {
        $this->forge->dropTable('Laboratorio');
    }
}
