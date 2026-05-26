<?php

namespace App\Controllers\Admin\Penerimaan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PequrbanModel;
use App\Models\PenerimaanModel;

class pengirimanController extends BaseController
{
    protected $pequrbanModel;

    public function __construct()
    {
        $this->pequrbanModel = new PequrbanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        // Ambil Data Target (Mandiri) dari PequrbanModel
        $rekapResult = $this->pequrbanModel->getRekapPerCabang($tahun);
        $rekap = $rekapResult['rekap'];

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
            $r['sapi_masuk']    = (int)($mapTerima[$id]['s_masuk'] ?? 0);
            $r['kambing_masuk'] = (int)($mapTerima[$id]['k_masuk'] ?? 0);

            // Hitung selisih/kekurangan (Sapi dikonversi ke satuan ekor: jumlah orang/7)
            $r['sapi_kurang']    = ((int)$r['sapi_mandiri'] / 7) - $r['sapi_masuk'];
            $r['kambing_kurang'] = (int)$r['kambing_mandiri'] - $r['kambing_masuk'];
        }

        $data = [
            'title'  => 'Pengiriman Hewan',
            'year'   => $tahun,
            'rekap'  => $rekap,
            'prices' => $rekapResult['prices'],
            'navbar' => 'pengiriman',
            'active' => 'pengiriman',
        ];

        echo view('admin/penerimaan/pengiriman', $data);
    }
}
