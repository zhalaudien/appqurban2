<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfilCabang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'cabang_id'    => ['type' => 'INT',],
            'alamat'       => ['type' => 'TEXT', 'null' => true],
            'ketua'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'ketua_hp'     => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'panitia_nama' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'panitia_hp'   => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'perwakilan'   => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true], // Sragen / Karanganyar
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('cabang_id', 'cabang', 'id');
        $this->forge->createTable('profilcabang');
    }

    public function down()
    {
        $this->forge->dropTable('profilcabang');
    }
}
