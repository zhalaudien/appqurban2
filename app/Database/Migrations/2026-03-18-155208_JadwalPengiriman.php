<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalPengiriman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'cabang_id' => [
                'type'       => 'INT',
            ],
            'antrian' => [
                'type'       => 'INT',
                'constraint' => 5,
            ],
            'kirim_hewan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'kirim_besek' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['antrian', 'proses', 'selesai', 'pending'],
                'default'    => 'antrian',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Primary Key
        $this->forge->addKey('id', true);

        // Foreign Key (relasi ke tabel cabang)
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');

        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
