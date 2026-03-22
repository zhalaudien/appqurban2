<?php

namespace App\Controllers\Cabang;

use App\Controllers\BaseController;
use App\Models\PequrbanModel;
use App\Models\CabangModel;
use App\Models\AmprahModel;
use App\Models\RealisasiModel;
use App\Models\SettingModel;
use App\Models\JadwalModel;

class DashboardController extends BaseController
{
    protected $pequrban;
    protected $cabang;
    protected $amprah;
    protected $realisasi;
    protected $settingModel;
    protected $perkiraan;
    protected $jadwal;

    public function __construct()
    {
        $this->pequrban     = new PequrbanModel();
        $this->cabang       = new CabangModel();
        $this->amprah       = new AmprahModel();
        $this->realisasi    = new RealisasiModel();
        $this->settingModel = new SettingModel();
        $this->jadwal       = new JadwalModel();
        $this->perkiraan    = $this->realisasi->getDataLengkap();
    }

    public function index()
    {
        $cabangId = session()->get('user')['cabang_id'];

        // ========================
        // PROFIL
        // ========================
        $profilCabang = $this->cabang->find($cabangId);

        // ========================
        // JADWAL PENGIRIMAN
        // ========================
        $jadwal = $this->jadwal
            ->select('jadwal.*, cabang.nama_cabang as tujuan')
            ->join('cabang', 'cabang.id = jadwal.cabang_id', 'left')
            ->where('jadwal.cabang_id', $cabangId)
            ->orderBy('jadwal.antrian', 'ASC')
            ->findAll();


        // ========================
        // TOTAL PEQURBAN
        // ========================
        $totalPequrban = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->countAllResults();

        // ========================
        // HEWAN
        // ========================
        $totalSapi = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('jenis_hewan', 'sapi')
            ->countAllResults();

        $totalKambing = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('jenis_hewan', 'kambing')
            ->countAllResults();

        // ========================
        // SUMBER
        // ========================
        $sapi_bumm = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('sumber', 'bumm')
            ->where('jenis_hewan', 'sapi')
            ->countAllResults();

        $kambing_bumm = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('sumber', 'bumm')
            ->where('jenis_hewan', 'kambing')
            ->countAllResults();

        $sapi_mandiri = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('sumber', 'mandiri')
            ->where('jenis_hewan', 'sapi')
            ->countAllResults();

        $kambing_mandiri = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('sumber', 'mandiri')
            ->where('jenis_hewan', 'kambing')
            ->countAllResults();

        // ========================
        // PERMINTAAN (AMPRAH)
        // ========================
        $permintaan = $this->amprah
            ->select([
                'SUM(TS) as TS',
                'SUM(TK) as TK',
                'SUM(A) as A',
                'SUM(M) as M',
                'SUM(OS) as OS',
                'SUM(OK) as OK',
                'SUM(K_S) as kepala_sapi',
                'SUM(K_KB) as kepala_kambing',
                'SUM(KK_S) as kaki_sapi',
                'SUM(KLS) as kulit_sapi',
            ])
            ->where('cabang_id', $cabangId)
            ->get()
            ->getRowArray();

        // ========================
        // REALISASI
        // ========================
        $realisasi = $this->realisasi
            ->select([
                'SUM(R_TS) as TS',
                'SUM(R_TK) as TK',
                'SUM(R_A) as A',
                'SUM(R_M) as M',
                'SUM(R_OS) as OS',
                'SUM(R_OK) as OK',
                'SUM(R_K_S) as kepala_sapi',
                'SUM(R_K_KB) as kepala_kambing',
                'SUM(R_KK_S) as kaki_sapi',
                'SUM(R_KLS) as kulit_sapi',
            ])
            ->where('cabang_id', $cabangId)
            ->get()
            ->getRowArray();

        $setting = $this->settingModel->first();

        // Default 0 kalau setting kosong
        $bSapi = $setting['b_sapi'] ?? 0;
        $bKb   = $setting['b_kb'] ?? 0;

        $jumlahSapiUtuh = intdiv($totalSapi, 7); // 4
        $sisa = $totalSapi % 7; // 6

        if ($sisa > 0) {
            $jumlahSapiText = $jumlahSapiUtuh . ' ' . $sisa . '/7';
        } else {
            $jumlahSapiText = (string) $jumlahSapiUtuh;
        }

        $jumlahSapi = intdiv($totalSapi, 7); // lebih aman dari float

        $perkiraan = [
            'TS' => $totalSapi,
            'TK' => $totalKambing,
            'A'  => 0,
            'M'  => 0,

            'OS' => $jumlahSapi * $bSapi,
            'OK' => $totalKambing * $bKb,

            'kepala_sapi'    => $jumlahSapi,
            'kepala_kambing' => $totalKambing,

            'kaki_sapi' => $jumlahSapi * 2,
            'kulit_sapi' => $jumlahSapi,
        ];

        // ========================
        // AMANKAN NULL → 0
        // ========================
        $permintaan = array_map(fn($v) => $v ?? 0, $permintaan ?? []);
        $realisasi  = array_map(fn($v) => $v ?? 0, $realisasi ?? []);


        // ========================
        // RETURN
        // ========================
        return view('cabang/dashboard', [
            'title'             => 'Dashboard Cabang',
            'profil'            => $profilCabang,
            'totalPequrban'     => $totalPequrban,
            'totalSapi'         => $totalSapi,
            'totalKambing'      => $totalKambing,
            'sapi_bumm'         => $sapi_bumm,
            'kambing_bumm'      => $kambing_bumm,
            'sapi_mandiri'      => $sapi_mandiri,
            'kambing_mandiri'   => $kambing_mandiri,
            'permintaan'        => $permintaan,
            'realisasi'         => $realisasi,
            'cabangId'          => $cabangId,
            'perkiraan'         => $perkiraan,
            'jadwalPengiriman'  => $jadwal,
            'jumlahsapi'        => $jumlahSapiText
        ]);
    }

    public function update($cabangId)
    {
        $data = [
            'TS' => $this->request->getPost('P_TS'),
            'TK' => $this->request->getPost('P_TK'),
            'A'  => $this->request->getPost('P_A'),
            'M'  => $this->request->getPost('P_M'),
            'OS' => $this->request->getPost('P_OS'),
            'OK' => $this->request->getPost('P_OK'),

            // mapping khusus
            'K_S'  => $this->request->getPost('P_kepala_sapi'),
            'K_KB' => $this->request->getPost('P_kepala_kambing'),
            'KK_S' => $this->request->getPost('P_kaki_sapi'),
            'KLS'  => $this->request->getPost('P_kulit_sapi'),
        ];

        // cek apakah data sudah ada
        $existing = $this->amprah
            ->where('cabang_id', $cabangId)
            ->first();

        if ($existing) {
            // UPDATE
            $this->amprah
                ->where('cabang_id', $cabangId)
                ->set($data)
                ->update();
        } else {
            // INSERT
            $data['cabang_id'] = $cabangId;
            $this->amprah->insert($data);
        }

        return redirect()->back()->with('success', 'Permintaan berhasil diupdate');
    }
}
