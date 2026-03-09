<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePequrban extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'cabang_id' => ['type' => 'INT'],
            'jenis_hewan' => ['type' => 'ENUM', 'constraint' => ['sapi', 'kambing']],
            'sumber' => ['type' => 'ENUM', 'constraint' => ['bumm', 'mandiri']],
            'harga' => ['type' => 'INT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');
        $this->forge->createTable('pequrban');
    }
    public function down()
    {
        $this->forge->dropTable('pequrban');
    }
}
