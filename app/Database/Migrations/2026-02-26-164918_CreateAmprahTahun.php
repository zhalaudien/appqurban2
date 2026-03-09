<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAmprahTahun extends Migration
{
    public function up()
    {
        $this->forge->addColumn('amprah', [
            'tahun' => [
                'type' => 'YEAR',
                'after' => 'KLS'
            ]
        ]);

        $this->forge->addKey('tahun');
    }

    public function down()
    {
        $this->forge->dropColumn('amprah', 'tahun');
    }
}
