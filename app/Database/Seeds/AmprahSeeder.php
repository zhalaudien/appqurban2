<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AmprahSeeder extends Seeder
{
    public function run()
    {
        $tahun = date('Y');
        $now   = date('Y-m-d H:i:s');

        // Ambil semua cabang
        $cabangList = $this->db->table('cabang')->where('pusat', 7)->get()->getResultArray();

        $data = [];

        foreach ($cabangList as $cabang) {
            $data[] = [
                'cabang_id' => $cabang['id'],
                'TS'   => 0,
                'TK'   => 0,
                'A'    => 0,
                'M'    => 0,
                'OS'   => 0,
                'OK'   => 0,
                'K_S'  => 0,
                'K_KB' => 0,
                'KK_S' => 0,
                'KLS'  => 0,
                'tahun'      => $tahun,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($data)) {
            $this->db->table('amprah')->insertBatch($data);
        }
    }
}
