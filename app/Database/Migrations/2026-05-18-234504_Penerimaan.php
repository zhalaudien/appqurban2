<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penerimaan extends Migration
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
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pengirim' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sapi' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'kambing' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'pembayaran' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'default'    => 0,
            ],
            'shadaqoh' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'default'    => 0,
            ],
            'ket' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');
        $this->forge->createTable('penerimaan');
    }

    public function down()
    {
        $this->forge->dropTable('penerimaan');
    }
}
