<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RealisasiSeeder extends Seeder
{
    public function run()
    { {
            $tahun = date('Y');
            $now   = date('Y-m-d H:i:s');

            // Ambil semua cabang
            $cabangList = $this->db->table('cabang')->where('pusat', 7)->get()->getResultArray();

            $data = [];

            foreach ($cabangList as $cabang) {
                $data[] = [
                    'cabang_id' => $cabang['id'],
                    'R_TS'   => 0,
                    'R_TK'   => 0,
                    'R_A'    => 0,
                    'R_M'    => 0,
                    'R_OS'   => 0,
                    'R_OK'   => 0,
                    'R_K_S'  => 0,
                    'R_K_KB' => 0,
                    'R_KK_S' => 0,
                    'R_KLS'  => 0,
                    'tahun'      => $tahun,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            if (!empty($data)) {
                $this->db->table('realisasi')->insertBatch($data);
            }
        }
    }
}
