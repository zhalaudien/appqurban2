<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => 1, 'nama_seksi' => 'Among Tamu'],
            ['id' => 2, 'nama_seksi' => 'Balungan'],
            ['id' => 3, 'nama_seksi' => 'Bankom'],
            ['id' => 4, 'nama_seksi' => 'Bedah Waduk'],
            ['id' => 5, 'nama_seksi' => 'Bendahara'],
            ['id' => 6, 'nama_seksi' => 'Catat Besek Daging Keluar'],
            ['id' => 7, 'nama_seksi' => 'K3 Pencatatan Penyembelihan'],
            ['id' => 8, 'nama_seksi' => 'Keamanan Hewan'],
            ['id' => 9, 'nama_seksi' => 'Kebersihan'],
            ['id' => 10, 'nama_seksi' => 'Ketua'],
            ['id' => 11, 'nama_seksi' => 'Konsumsi Dan Jayengan'],
            ['id' => 12, 'nama_seksi' => 'P3K'],
            ['id' => 13, 'nama_seksi' => 'Parkir'],
            ['id' => 14, 'nama_seksi' => 'Pembantu Umum Atau Informasi'],
            ['id' => 15, 'nama_seksi' => 'Pembawa Hewan Yang Sudah Disembelih'],
            ['id' => 16, 'nama_seksi' => 'Pembawa Jeroan'],
            ['id' => 17, 'nama_seksi' => 'Pembersih Jeroan'],
            ['id' => 18, 'nama_seksi' => 'Pembungkus Jeroan'],
            ['id' => 19, 'nama_seksi' => 'Penerimaan Hewan Qurban'],
            ['id' => 10, 'nama_seksi' => 'Pengadaan Pakan'],
            ['id' => 21, 'nama_seksi' => 'Pengairan Listrik Kipas Angin'],
            ['id' => 22, 'nama_seksi' => 'Penimbangan'],
            ['id' => 23, 'nama_seksi' => 'Penyembelihan Dan Pengulitan Kambing'],
            ['id' => 24, 'nama_seksi' => 'Penyembelihan Dan Pengulitan Sapi'],
            ['id' => 25, 'nama_seksi' => 'Persiapan Alas daun Jati'],
            ['id' => 26, 'nama_seksi' => 'Persiapan Besek Daging keluar'],
            ['id' => 27, 'nama_seksi' => 'Persiapan Kajang'],
            ['id' => 28, 'nama_seksi' => 'Persiapan Kandang Gantungan'],
            ['id' => 29, 'nama_seksi' => 'Rafia Plastik Karung'],
            ['id' => 30, 'nama_seksi' => 'Sekretariat'],
            ['id' => 31, 'nama_seksi' => 'Seset Daging'],
            ['id' => 32, 'nama_seksi' => 'Sinoman'],
            ['id' => 33, 'nama_seksi' => 'Telenan Keranjang Alat'],
            ['id' => 34, 'nama_seksi' => 'Transportasi'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('seksi')->insertBatch($data);
    }
}
