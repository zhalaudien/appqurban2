<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PanitiaSeeder extends Seeder
{
    public function run()
    {
        // Optional: kosongkan dulu tabel
        $this->db->table('panitia')->truncate();

        $now = date('Y-m-d H:i:s');

        $data = [

            [
                'nama'       => 'Ahmad Fauzi',
                'no_hp'      => '081234567890',
                'cabang_id'  => 15,
                'seksi_id'   => 1, // Ketua
                'jabatan'    => 'Koordinator',
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        $this->db->table('panitia')->insertBatch($data);
    }
}
