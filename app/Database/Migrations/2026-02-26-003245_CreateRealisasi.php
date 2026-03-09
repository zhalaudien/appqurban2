<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRealisasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'cabang_id' => ['type' => 'INT'],
            'R_TS' => ['type' => 'INT'],
            'R_TK' => ['type' => 'INT'],
            'R_A' => ['type' => 'INT'],
            'R_M' => ['type' => 'INT'],
            'R_OS' => ['type' => 'INT'],
            'R_OK' => ['type' => 'INT'],
            'R_K_S' => ['type' => 'INT'],
            'R_K_KB' => ['type' => 'INT'],
            'R_KK_S' => ['type' => 'INT'],
            'R_KLS' => ['type' => 'INT'],
            'tahun' => ['type' => 'YEAR'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');
        $this->forge->createTable('realisasi');
    }
    public function down()
    {
        $this->forge->dropTable('realisasi');
    }
}
