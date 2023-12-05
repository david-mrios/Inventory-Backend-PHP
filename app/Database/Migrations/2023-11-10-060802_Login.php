<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApplicationUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_application_user' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'idrole' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => false,
            ],
            'userName' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'names' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'surNames' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'deleted_at' => [
                'type' => 'VARCHAR',
                'constraint' => '30',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_application_user', true);
        $this->forge->addForeignKey('idrole', 'user_rol', 'id_role', '', 'CASCADE');
        $this->forge->createTable('application_user');
    }

    public function down()
    {
        $this->forge->dropTable('application_user');
    }
}
