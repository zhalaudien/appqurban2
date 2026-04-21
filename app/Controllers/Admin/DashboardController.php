<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PanitiaModel;
use App\Models\PequrbanModel;
use App\Models\PenerimaanModel;
use App\Models\KandangModel;
use App\Models\BesekModel;
use App\Models\K3Model;
use App\Models\RealisasiModel;
use App\Models\CabangModel;
use App\Models\MuspikaModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $tahun = date('Y');

        $panitiaModel = new PanitiaModel();
        $pequrbanModel = new PequrbanModel();
        $penerimaanModel = new PenerimaanModel();
        $kandangModel = new KandangModel();
        $besekModel = new BesekModel();
        $k3Model = new K3Model();
        $realisasiModel = new RealisasiModel();
        $cabangModel = new CabangModel();
        $muspikaModel = new MuspikaModel();

        // Deklarasi Variabel

        // 1. Statistik Panitia
        $totalPanitia = $panitiaModel->countAllResults();
        $totalCabang  = $cabangModel->countAllResults();

        // 2. Hewan Qurban (Target dari PequrbanModel)
        $totals = $pequrbanModel->getGrandTotal($tahun);
        $totalPequrban = $totals['total_semua'] ?? 0;
        $targetSapi    = $totals['total_sapi'] ?? 0;
        $targetKambing = $totals['total_kambing'] ?? 0;

        // Breakdown BUMM vs Cabang (Mandiri)
        $sapiBumm      = $pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'sapi', 'sumber' => 'bumm'])->countAllResults();
        $sapiCabang    = $pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'sapi', 'sumber' => 'mandiri'])->countAllResults();
        $kambingBumm   = $pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'kambing', 'sumber' => 'bumm'])->countAllResults();
        $kambingCabang = $pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'kambing', 'sumber' => 'mandiri'])->countAllResults();
        $muspikaCount  = $muspikaModel->countAllResults(); // Asumsi kolom seksi

        // 3. Penerimaan (Hewan yang sudah datang & Dana)
        $terima = $penerimaanModel->selectSum('sapi', 'sapi')->selectSum('kambing', 'kambing')->selectSum('pembayaran', 'uang')->selectSum('shadaqoh', 'shadaqoh')->get()->getRow();
        $terimaSapi = $terima->sapi ?? 0;
        $terimaKambing = $terima->kambing ?? 0;
        $totalUang = ($terima->uang ?? 0) + ($terima->shadaqoh ?? 0);

        // 4. Kandang (Data Hewan Disembelih)
        $sembelih = $kandangModel->selectSum('sapi', 'sapi')->selectSum('kambing', 'kambing')->get()->getRow();
        $sembelihSapi = $sembelih->sapi ?? 0;
        $sembelihKambing = $sembelih->kambing ?? 0;

        // 5. Stok Kandang (Hewan Hidup yang belum disembelih)
        $stokSapi = $terimaSapi - $sembelihSapi;
        $stokKambing = $terimaKambing - $sembelihKambing;

        // 6. Produksi Besek (Total agregat produksi)
        $prod = $besekModel->selectSum('ts', 'ts')->selectSum('tk', 'tk')->selectSum('a', 'a')->selectSum('m', 'm')->selectSum('os', 'os')->selectSum('ok', 'ok')->get()->getRow();

        // Produksi Besek Harian (Hari ini)
        $harian = $besekModel->selectSum('ts', 'ts')->selectSum('tk', 'tk')->selectSum('a', 'a')->selectSum('m', 'm')->selectSum('os', 'os')->selectSum('ok', 'ok')
            ->where('DATE(created_at)', date('Y-m-d'))
            ->get()->getRow();

        // 7. Distribusi Besek (Realisasi pengiriman ke cabang)
        $dist = $realisasiModel->selectSum('R_TS')->selectSum('R_TK')->selectSum('R_A')->selectSum('R_OS')->selectSum('R_OK')->get()->getRow();
        $totalDistribusiBesek = ($dist->R_TS ?? 0) + ($dist->R_TK ?? 0) + ($dist->R_A ?? 0) + ($dist->R_OS ?? 0) + ($dist->R_OK ?? 0);

        // 8. Stok K3 (Kepala, Kaki, Kulit)
        $k3Data = $k3Model->selectSum('ks')->selectSum('kb')->selectSum('kks')->selectSum('kls')->get()->getRow();
        $k3 = [
            'ks' => $k3Data->ks ?? 0,
            'kb' => $k3Data->kb ?? 0,
            'kks' => $k3Data->kks ?? 0,
            'kls' => $k3Data->kls ?? 0,
        ];

        // Helper Logika Pecahan Sapi (n/7)
        $formatSapi = function ($count) {
            $whole = intdiv($count, 7);
            $remain = $count % 7;
            if ($count == 0) return "0";
            if ($remain === 0) return (string)$whole;
            return ($whole > 0 ? $whole . ' ' : '') . $remain . '/7';
        };

        return view('admin/dashboard', [
            'totalPanitia'    => $totalPanitia,
            'totalPequrban'   => $totalPequrban,
            'totalCabang'     => $totalCabang,
            'muspikaCount'    => $muspikaCount,

            'targetSapi'      => $formatSapi($targetSapi),
            'targetKambing'   => $targetKambing,
            'sapiBumm'        => $formatSapi($sapiBumm),
            'sapiCabang'      => $formatSapi($sapiCabang),
            'kambingBumm'     => $kambingBumm,
            'kambingCabang'   => $kambingCabang,

            'terimaSapi'      => $terimaSapi,
            'terimaKambing'   => $terimaKambing,
            'terimaSapiFmt'   => $formatSapi($terimaSapi),

            'totalUang'       => $totalUang,

            'sembelihSapi'    => $sembelihSapi,
            'sembelihKambing' => $sembelihKambing,
            'sembelihSapiFmt' => $formatSapi($sembelihSapi),

            'stokSapi'        => $formatSapi($stokSapi),
            'stokKambing'     => $stokKambing,
            'prod'            => $prod,
            'harian'          => $harian,
            'k3'              => $k3
        ]);
    }
}
