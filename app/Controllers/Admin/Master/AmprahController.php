<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AmprahModel;
use App\Models\JadwalModel; // Tambahkan ini

class AmprahController extends BaseController
{
    protected $amprahModel;
    protected $jadwalModel; // Deklarasikan JadwalModel

    public function __construct()
    {
        $this->amprahModel = new AmprahModel();
        $this->jadwalModel = new JadwalModel(); // Inisialisasi JadwalModel
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        // 1. Ambil data amprah untuk tahun yang dipilih, termasuk nama_cabang
        // Asumsi AmprahModel->getAmprah($tahun) mengembalikan record amprah dengan cabang_id dan nama_cabang
        $amprahRaw = $this->amprahModel->getAmprah($tahun);

        // 2. Ambil data jadwal untuk tahun yang dipilih untuk memetakan kirim_besek
        $jadwal = $this->jadwalModel->findAll();
        $mapJadwal = [];
        foreach ($jadwal as $j) {
            $mapJadwal[$j['cabang_id']] = $j['kirim_besek'];
        }

        // 3. Tambahkan kirim_besek ke setiap record amprah dan kelompokkan
        $grouped = [];
        foreach ($amprahRaw as &$a) {
            // Pastikan 'cabang_id' ada di $a
            if (isset($a['cabang_id'])) {
                $a['kirim_besek'] = trim($mapJadwal[$a['cabang_id']] ?? '') ?: 'Belum Terjadwal';
            } else {
                // Tangani kasus di mana cabang_id mungkin hilang
                $a['kirim_besek'] = 'Belum Terjadwal';
            }
            $key = $a['kirim_besek'];
            $grouped[$key][] = $a;
        }
        unset($a); // Hapus referensi untuk menghindari perilaku tak terduga

        // 4. Urutkan data yang dikelompokkan berdasarkan jadwal (H1, H2, dll., dan "Belum Terjadwal" terakhir)
        uksort($grouped, function ($a, $b) {
            if ($a === 'Belum Terjadwal') return 1;
            if ($b === 'Belum Terjadwal') return -1;
            return strnatcmp($a, $b);
        });

        $data = [
            'grouped_amprah' => $grouped,
            'year'           => $tahun,
            'navbar' => 'qurban',
            'active' => 'amprah'
        ];

        echo view('admin/master/amprah/index', $data);
    }

    // Anda mungkin perlu menambahkan metode update dan export di sini
    // Contoh metode update (sesuaikan dengan kebutuhan Anda)
    public function update($id)
    {
        $data = [
            'TS' => $this->request->getPost('TS'),
            'TK' => $this->request->getPost('TK'),
            'A' => $this->request->getPost('A'),
            'M' => $this->request->getPost('M'),
            'OS' => $this->request->getPost('OS'),
            'OK' => $this->request->getPost('OK'),
            'K_S' => $this->request->getPost('K_S'),
            'K_KB' => $this->request->getPost('K_KB'),
            'KK_S' => $this->request->getPost('KK_S'),
            'KLS' => $this->request->getPost('KLS'),
            'info' => $this->request->getPost('info'), // Jika ada kolom info
        ];

        $update = $this->amprahModel->update($id, $data);

        if ($update) {
            return redirect()->to('/amprah')->with('success', 'Data amprah berhasil diperbarui.');
        } else {
            return redirect()->to('/amprah')->with('error', 'Gagal memperbarui data amprah.');
        }
    }
}
