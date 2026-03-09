<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTahunToPequrban extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pequrban', [
            'tahun' => [
                'type' => 'YEAR',
                'after' => 'harga'
            ]
        ]);

        $this->forge->addKey('tahun');
    }

    public function down()
    {
        $this->forge->dropColumn('pequrban', 'tahun');
    }
}
