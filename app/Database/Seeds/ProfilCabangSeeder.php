<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProfilCabangSeeder extends Seeder
{
    public function run()
    {
        $now   = date('Y-m-d H:i:s');

        $cabangList = $this->db->table('cabang')->where('pusat', 7)->get()->getResultArray();

        $data = [];

        foreach ($cabangList as $cabang) {
            $data[] = [
                'cabang_id' => $cabang['id'],
                'alamat'   => 0,
                'ketua' => 0,
                'ketua_hp' => 0,
                'panitia_nama' => 0,
                'panitia_hp' => 0,
                'perwakilan' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($data)) {
            $this->db->table('profilcabang')->insertBatch($data);
        }
    }
}
