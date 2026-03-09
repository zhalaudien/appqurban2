<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabangSeeder2 extends Seeder
{
    public function run()
    {
        $this->db->table('cabang')->insertBatch([
            ['id' => 9998, 'nama_cabang' => 'Bankom', 'pusat' => null],
            ['id' => 9997, 'nama_cabang' => 'Satgas', 'pusat' => null],
            ['id' => 9996, 'nama_cabang' => 'Parkir', 'pusat' => null],
            ['id' => 33, 'nama_cabang' => 'Masaran 2', 'pusat' => null],
            ['id' => 34, 'nama_cabang' => 'Masaran 3', 'pusat' => null],
            ['id' => 35, 'nama_cabang' => 'Masaran 5', 'pusat' => null],
            ['id' => 36, 'nama_cabang' => 'Sidoharjo 1', 'pusat' => null],
        ]);
    }
}
