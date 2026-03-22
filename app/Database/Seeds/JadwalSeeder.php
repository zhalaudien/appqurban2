<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run()
    {
        $now   = date('Y-m-d H:i:s');

        $cabangList = $this->db->table('cabang')->where('pusat', 7)->get()->getResultArray();

        $data = [];

        foreach ($cabangList as $cabang) {
            $data[] = [
                'cabang_id' => $cabang['id'],
                'antrian'   => 0,
                'kirim_hewan' => 0,
                'kirim_besek' => 0,
                'status' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($data)) {
            $this->db->table('jadwal')->insertBatch($data);
        }
    }
}
