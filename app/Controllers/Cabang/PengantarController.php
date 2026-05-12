<?php

namespace App\Controllers\Cabang;

use App\Controllers\BaseController;
use App\Models\CabangModel;
use App\Models\PequrbanModel;
use App\Models\AmprahModel;
use App\Models\SettingCabangModel;
use App\Models\SettingModel;

class PengantarController extends BaseController
{
    public function index($cabangId)
    {
        // Proteksi: Admin Cabang (Role 6) hanya bisa cetak milik cabangnya sendiri
        $user = session()->get('user');
        if ($user['role_id'] == 6 && $user['cabang_id'] != $cabangId) {
            return redirect()->to('cabang/dashboard')->with('error', 'Akses ditolak.');
        }

        $cabangModel = new CabangModel();
        $pequrbanModel = new PequrbanModel();
        $amprahModel = new AmprahModel();
        $settingCabangModel = new SettingCabangModel();
        $settingPusatModel = new SettingModel();

        $cabang = $cabangModel->find($cabangId);
        $settingCabang = $settingCabangModel->where('cabang_id', $cabangId)->first();
        $settingPusat = $settingPusatModel->first();

        $tahun = date('Y');

        // Ambil data pequrban dan mapping field agar sesuai dengan view
        $pequrbanRaw = $pequrbanModel->getPerCabang($cabangId, $tahun);
        $pequrban = array_map(function ($item) {
            $item['biaya'] = $item['harga'] ?? 0;
            $item['asal_hewan'] = ucfirst($item['sumber'] ?? '-');
            return $item;
        }, $pequrbanRaw);

        // Urutkan berdasarkan asal hewan secara ASC (Bumm, Mandiri)
        usort($pequrban, function ($a, $b) {
            return strcmp($a['asal_hewan'], $b['asal_hewan']);
        });

        // Hitung rekap hewan secara manual untuk keakuratan surat
        $rekapCount = [
            'sapi_bumm' => $pequrbanModel->where(['cabang_id' => $cabangId, 'tahun' => $tahun, 'jenis_hewan' => 'sapi', 'sumber' => 'bumm'])->countAllResults(),
            'sapi_mandiri' => $pequrbanModel->where(['cabang_id' => $cabangId, 'tahun' => $tahun, 'jenis_hewan' => 'sapi', 'sumber' => 'mandiri'])->countAllResults(),
            'kambing_bumm' => $pequrbanModel->where(['cabang_id' => $cabangId, 'tahun' => $tahun, 'jenis_hewan' => 'kambing', 'sumber' => 'bumm'])->countAllResults(),
            'kambing_mandiri' => $pequrbanModel->where(['cabang_id' => $cabangId, 'tahun' => $tahun, 'jenis_hewan' => 'kambing', 'sumber' => 'mandiri'])->countAllResults(),
        ];

        // Ambil data permintaan logistik (Amprah)
        $amprah = $amprahModel->where('cabang_id', $cabangId)->first();

        $data = [
            'cabang' => $cabang,
            'tahun_masehi' => $tahun,
            'tahun_hijriyah' => '1447 H',
            'rekap' => [
                'kambing_sendiri' => $rekapCount['kambing_mandiri'],
                'kambing_bumm' => $rekapCount['kambing_bumm'],
                'sapi_sendiri' => $rekapCount['sapi_mandiri'],
                'sapi_bumm' => $rekapCount['sapi_bumm'],
                'shadaqoh' => $amprah['A'] ?? 0,
                'ts' => ($amprah['TS'] ?? 0),
                'tk' => $amprah['TK'] ?? 0,
                'a' => $amprah['A'] ?? 0,
                'm' => $amprah['M'] ?? 0,
                'os' => ($amprah['OS'] ?? 0),
                'ok' => $amprah['OK'] ?? 0,
                'ks' => $amprah['K_S'] ?? 0,
                'kk' => $amprah['K_KB'] ?? 0,
                'kks' => $amprah['KK_S'] ?? 0,
                'kls' => $amprah['KLS'] ?? 0,
                'lain' => $amprah['M'] ?? 0,
            ],
            'penyetor' => [
                'nama' => $settingCabang['panitia_nama'] ?? '-',
                'telepon' => $settingCabang['panitia_hp'] ?? '-',
                'atas_nama' => $settingCabang['ketua'] ?? '-',
                'telepon2' => $settingCabang['ketua_hp'] ?? '-',
            ],

            'pequrban' => $pequrban,
        ];

        return view('cabang/surat/pengantar', $data);
    }
}
