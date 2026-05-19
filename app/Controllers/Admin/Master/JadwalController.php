<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;
use App\Models\SettingModel;
use App\Models\CabangModel;
use App\Models\PequrbanModel;


class JadwalController extends BaseController
{
    protected $JadwalModel;
    protected $SettingModel;
    protected $CabangModel;
    protected $PequrbanModel;


    public function __construct()
    {
        $this->JadwalModel = new JadwalModel();
        $this->SettingModel = new SettingModel();
        $this->CabangModel = new CabangModel();
        $this->PequrbanModel = new PequrbanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        // Mengambil data setting untuk jadwal dinamis (H-1 s/d H4)
        $setting = $this->SettingModel->find(1);

        // Ambil rekap hewan per cabang termasuk jadwal (data sudah di-join di model)
        $rekapResult = $this->PequrbanModel->getRekapPerCabang($tahun);
        $jadwalRaw   = $rekapResult['rekap'] ?? [];

        // Format jumlah sapi menjadi pecahan per 7 (1 sapi = 7 pequrban)
        foreach ($jadwalRaw as &$j) {
            foreach (['sapi_mandiri', 'sapi_bumm'] as $key) {
                $val = (int)($j[$key] ?? 0);
                $j[$key . '_raw'] = $val; // Simpan nilai asli untuk perhitungan total di view
                if ($val > 0) {
                    $whole  = intdiv($val, 7);
                    $remain = $val % 7;

                    if ($remain === 0) {
                        $j[$key] = (string)$whole;
                    } elseif ($whole > 0) {
                        $j[$key] = "$whole $remain/7";
                    } else {
                        $j[$key] = "$remain/7";
                    }
                }
            }
        }
        unset($j); // Penting: Hapus referensi agar tidak merusak loop pengelompokan di bawahnya

        // Kelompokkan berdasarkan jadwal kirim besek
        $grouped = [];
        foreach ($jadwalRaw as $j) {
            // Gunakan trim untuk menghindari spasi yang membuat grup berbeda
            $key = trim($j['kirim_besek'] ?? '') ?: 'Belum Ditentukan';
            $grouped[$key][] = $j;
        }
        ksort($grouped);

        $data = [
            'j_h_1'  => $setting['j_h_1'] ?? '',
            'j_h'    => $setting['j_h'] ?? '',
            'j_h2'   => $setting['j_h2'] ?? '',
            'j_h3'   => $setting['j_h3'] ?? '',
            'j_h4'   => $setting['j_h4'] ?? '',
            'grouped_jadwal' => $grouped,
            'cabang' => $this->CabangModel->orderBy('nama_cabang', 'ASC')->findAll(),
            'navbar' => 'qurban',
            'active' => 'jadwal',
            'year'   => $tahun
        ];

        return view('admin/master/jadwal/index', $data);
    }

    public function store()
    {
        $data = [
            'cabang_id'   => $this->request->getPost('cabang_id'),
            'antrian'     => $this->request->getPost('antrian'),
            'kirim_hewan' => $this->request->getPost('kirim_hewan'),
            'kirim_besek' => $this->request->getPost('kirim_besek'),
            'status'      => 'Sementara',
            'tahun'       => date('Y'),
        ];

        $this->JadwalModel->insert($data);
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'antrian'     => $this->request->getPost('antrian'),
            'kirim_hewan' => $this->request->getPost('kirim_hewan'),
            'kirim_besek' => $this->request->getPost('kirim_besek'),
            'status'      => $this->request->getPost('status'),
        ];

        if ($this->JadwalModel->update($id, $data)) {
            return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui jadwal.');
    }
}
