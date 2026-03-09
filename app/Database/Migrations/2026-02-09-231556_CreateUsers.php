<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'role_id' => ['type' => 'INT'],
            'cabang_id' => ['type' => 'INT', 'null' => true],
            'pusat' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('role_id', 'roles', 'id');
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');
        $this->forge->createTable('users');
    }
    public function down()
    {
        $this->forge->dropTable('users');
    }
}
