<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAmprah extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'cabang_id' => ['type' => 'INT'],
            'TS' => ['type' => 'INT'],
            'TK' => ['type' => 'INT'],
            'A' => ['type' => 'INT'],
            'M' => ['type' => 'INT'],
            'OS' => ['type' => 'INT'],
            'OK' => ['type' => 'INT'],
            'K_S' => ['type' => 'INT'],
            'K_KB' => ['type' => 'INT'],
            'KK_S' => ['type' => 'INT'],
            'KLS' => ['type' => 'INT'],
            'tahun' => ['type' => 'YEAR'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');
        $this->forge->createTable('amprah');
    }
    public function down()
    {
        $this->forge->dropTable('amprah');
    }
}
