<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCabang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'nama_cabang' => ['type' => 'VARCHAR', 'constraint' => 100],
            'pusat' => ['type' => 'INT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('cabang');
    }
    public function down()
    {
        $this->forge->dropTable('cabang');
    }
}
