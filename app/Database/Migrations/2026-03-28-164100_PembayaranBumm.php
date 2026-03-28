<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranBumm extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'cabang_id' => ['type' => 'INT'],
            'nama' => ['type' => 'VARCHAR(255)'],
            'pembayaran' => ['type' => 'int'],
            'keterangan' => ['type' => 'VARCHAR(255)'],
            'catatan' => ['type' => 'TEXT(255)'],
            'tahun' => ['type' => 'YEAR'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');
        $this->forge->createTable('pembayaran_bumm');
    }
    public function down()
    {
        $this->forge->dropTable('pembayaran_bumm');
    }
}
