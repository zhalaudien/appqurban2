<?php

namespace App\Controllers\Admin\Penerimaan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PequrbanModel;
use App\Models\PenerimaanModel;
use App\Models\JadwalModel;

class PengirimanController extends BaseController
{
    protected $pequrbanModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->pequrbanModel = new PequrbanModel();
        $this->jadwalModel = new JadwalModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        // Ambil Data Target (Mandiri) dari PequrbanModel
        $rekapResult = $this->pequrbanModel->getRekapPerCabang($tahun);
        $rekap = $rekapResult['rekap'];

        // Ambil data jadwal dari JadwalModel untuk memastikan pemetaan kirim_besek akurat sesuai jadwal model
        $jadwalData = $this->jadwalModel->findAll();
        $mapJadwal = [];
        foreach ($jadwalData as $j) {
            $mapJadwal[$j['cabang_id']] = $j['kirim_besek'];
        }

        // Ambil Data Realisasi (Masuk) dari PenerimaanModel
        $penerimaanModel = new PenerimaanModel();
        $terima = $penerimaanModel->select('cabang_id, SUM(sapi) as s_masuk, SUM(kambing) as k_masuk')
            ->where('YEAR(created_at)', $tahun)
            ->groupBy('cabang_id')
            ->findAll();

        // Map data masuk untuk pencarian cepat berdasarkan ID Cabang
        $mapTerima = [];
        foreach ($terima as $t) {
            $mapTerima[$t['cabang_id']] = $t;
        }

        // Gabungkan data target dengan realisasi untuk dibandingkan
        foreach ($rekap as &$r) {
            $id = $r['id'];
            // Set kirim_besek berdasarkan pemetaan dari JadwalModel
            $r['kirim_besek'] = $mapJadwal[$id] ?? '';

            $r['sapi_masuk']    = (int)($mapTerima[$id]['s_masuk'] ?? 0);
            $r['kambing_masuk'] = (int)($mapTerima[$id]['k_masuk'] ?? 0);

            // Hitung selisih/kekurangan (Sapi dikonversi ke satuan ekor: jumlah orang/7)
            $r['sapi_kurang']    = ((int)$r['sapi_mandiri'] / 7) - $r['sapi_masuk'];
            $r['kambing_kurang'] = (int)$r['kambing_mandiri'] - $r['kambing_masuk'];
        }
        unset($r); // Hapus referensi untuk menghindari bug pada loop berikutnya

        // Kelompokkan data rekap berdasarkan jadwal pengiriman besek
        $groupedRekap = [];
        foreach ($rekap as $r) {
            // Lewati data BUMM Sragen karena kita hanya fokus pada perbandingan hewan Mandiri cabang
            if ($r['nama_cabang'] == 'BUMM Sragen') continue;

            $key = trim($r['kirim_besek'] ?? '') ?: 'Belum Terjadwal';
            $groupedRekap[$key][] = $r;
        }

        // Urutkan grup secara natural (H1, H2, H3, dll) dan "Belum Terjadwal" di akhir
        uksort($groupedRekap, function ($a, $b) {
            if ($a === 'Belum Terjadwal') return 1;
            if ($b === 'Belum Terjadwal') return -1;
            return strnatcmp($a, $b);
        });

        $data = [
            'title'  => 'Pengiriman Hewan',
            'year'   => $tahun,
            'rekap'  => $groupedRekap,
            'prices' => $rekapResult['prices'],
            'navbar' => 'pengiriman',
            'active' => 'pengiriman'
        ];

        echo view('admin/penerimaan/pengiriman', $data);
    }
}
