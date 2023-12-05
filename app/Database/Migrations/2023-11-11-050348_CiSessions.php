<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CiSessions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '128',
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => '45',
            ],
            'timestamp' => [
                'type' => 'TIMESTAMP    ',
                'default' => null,
            ],
            'data' => [
                'type' => 'BLOB',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('timestamp'); 
        $this->forge->createTable('ci_sessions');
    }

    public function down()
    {
        $this->forge->dropTable('ci_sessions');
    }
}
