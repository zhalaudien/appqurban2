<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SeksiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_seksi' => 'Among Tamu'],
            ['nama_seksi' => 'Balungan'],
            ['nama_seksi' => 'Bankom'],
            ['nama_seksi' => 'Bedah Waduk'],
            ['nama_seksi' => 'Bendahara'],
            ['nama_seksi' => 'Catat Besek Daging Keluar'],
            ['nama_seksi' => 'K3 Pencatatan Penyembelihan'],
            ['nama_seksi' => 'Keamanan Hewan'],
            ['nama_seksi' => 'Kebersihan'],
            ['nama_seksi' => 'Ketua'],
            ['nama_seksi' => 'Konsumsi Dan Jayengan'],
            ['nama_seksi' => 'P3K'],
            ['nama_seksi' => 'Parkir'],
            ['nama_seksi' => 'Pembantu Umum Atau Informasi'],
            ['nama_seksi' => 'Pembawa Hewan Yang Sudah Disembelih'],
            ['nama_seksi' => 'Pembawa Jeroan'],
            ['nama_seksi' => 'Pembersih Jeroan'],
            ['nama_seksi' => 'Pembungkus Jeroan'],
            ['nama_seksi' => 'Penerimaan Hewan Qurban'],
            ['nama_seksi' => 'Pengadaan Pakan'],
            ['nama_seksi' => 'Pengairan Listrik Kipas Angin'],
            ['nama_seksi' => 'Penimbangan'],
            ['nama_seksi' => 'Penyembelihan Dan Pengulitan Kambing'],
            ['nama_seksi' => 'Penyembelihan Dan Pengulitan Sapi'],
            ['nama_seksi' => 'Persiapan Alas daun Jati'],
            ['nama_seksi' => 'Persiapan Besek Daging keluar'],
            ['nama_seksi' => 'Persiapan Kajang'],
            ['nama_seksi' => 'Persiapan Kandang Gantungan'],
            ['nama_seksi' => 'Rafia Plastik Karung'],
            ['nama_seksi' => 'Sekretariat'],
            ['nama_seksi' => 'Seset Daging'],
            ['nama_seksi' => 'Sinoman'],
            ['nama_seksi' => 'Telenan Keranjang Alat'],
            ['nama_seksi' => 'Transportasi'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('seksi')->insertBatch($data);
    }
}
