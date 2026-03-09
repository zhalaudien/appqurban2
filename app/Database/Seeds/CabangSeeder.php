<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabangSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('cabang')->insertBatch([
            ['id' => 1, 'nama_cabang' => 'Gesi', 'pusat' => 7],
            ['id' => 2, 'nama_cabang' => 'Gondang 1', 'pusat' => 7],
            ['id' => 3, 'nama_cabang' => 'Gondang 2', 'pusat' => 7],
            ['id' => 4, 'nama_cabang' => 'Gondang 3', 'pusat' => 7],
            ['id' => 5, 'nama_cabang' => 'Gondang 4', 'pusat' => 7],
            ['id' => 6, 'nama_cabang' => 'Jenar', 'pusat' => 7],
            ['id' => 7, 'nama_cabang' => 'Jenawi 1', 'pusat' => 7],
            ['id' => 8, 'nama_cabang' => 'Jenawi 2', 'pusat' => 7],
            ['id' => 9, 'nama_cabang' => 'Karangmalang 1', 'pusat' => 7],
            ['id' => 10, 'nama_cabang' => 'Karangmalang 2', 'pusat' => 7],
            ['id' => 11, 'nama_cabang' => 'Karangmalang 3', 'pusat' => 7],
            ['id' => 12, 'nama_cabang' => 'Karangmalang 4', 'pusat' => 7],
            ['id' => 13, 'nama_cabang' => 'Karangmalang 5', 'pusat' => 7],
            ['id' => 14, 'nama_cabang' => 'Kedawung 1', 'pusat' => 7],
            ['id' => 15, 'nama_cabang' => 'Kedawung 2', 'pusat' => 7],
            ['id' => 16, 'nama_cabang' => 'Kedawung 3', 'pusat' => 7],
            ['id' => 17, 'nama_cabang' => 'Kedawung 4', 'pusat' => 7],
            ['id' => 18, 'nama_cabang' => 'Kedawung 5', 'pusat' => 7],
            ['id' => 19, 'nama_cabang' => 'Kerjo 2', 'pusat' => 7],
            ['id' => 20, 'nama_cabang' => 'Kerjo 4', 'pusat' => 7],
            ['id' => 21, 'nama_cabang' => 'Ngrampal 1', 'pusat' => 7],
            ['id' => 22, 'nama_cabang' => 'Ngrampal 2', 'pusat' => 7],
            ['id' => 23, 'nama_cabang' => 'Ngrampal 3', 'pusat' => 7],
            ['id' => 24, 'nama_cabang' => 'Sambirejo 1', 'pusat' => 7],
            ['id' => 25, 'nama_cabang' => 'Sambirejo 2', 'pusat' => 7],
            ['id' => 26, 'nama_cabang' => 'Sambungmacan 1', 'pusat' => 7],
            ['id' => 27, 'nama_cabang' => 'Sambungmacan 2', 'pusat' => 7],
            ['id' => 28, 'nama_cabang' => 'Sambungmacan 3', 'pusat' => 7],
            ['id' => 29, 'nama_cabang' => 'Sragen 1', 'pusat' => 7],
            ['id' => 30, 'nama_cabang' => 'Sragen 2', 'pusat' => 7],
            ['id' => 31, 'nama_cabang' => 'Tangen 1', 'pusat' => 7],
            ['id' => 32, 'nama_cabang' => 'Tangen 2', 'pusat' => 7],
            ['id' => 9999, 'nama_cabang' => 'Bumm', 'pusat' => null],
        ]);
    }
}
