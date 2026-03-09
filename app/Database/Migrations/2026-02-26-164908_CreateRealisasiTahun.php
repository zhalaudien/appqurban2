<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRealisasiTahun extends Migration
{
    public function up()
    {
        $this->forge->addColumn('realisasi', [
            'tahun' => [
                'type' => 'YEAR',
                'after' => 'R_KLS'
            ]
        ]);

        $this->forge->addKey('tahun');
    }

    public function down()
    {
        $this->forge->dropColumn('realisasi', 'tahun');
    }
}
