<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePanitiaTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'cabang_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'seksi_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'jabatan' => [
                'type' => 'ENUM',
                'constraint' => ['koordinator', 'anggota'],
                'default' => 'anggota',
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
        $this->forge->addKey('cabang_id');
        $this->forge->addKey('seksi_id');

        $this->forge->createTable('panitia', true);
    }

    public function down()
    {
        $this->forge->dropTable('panitia', true);
    }
}
