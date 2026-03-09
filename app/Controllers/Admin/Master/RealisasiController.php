<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\RealisasiModel;
use App\Models\SettingModel;

class RealisasiController extends BaseController
{
    protected $realisasiModel;
    protected $settingModel;

    public function __construct()
    {
        $this->realisasiModel = new RealisasiModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {

        $tahun = $this->request->getGet('year') ?? date('Y');

        $header = [
            'title' => 'Data Realisasi Besek Cabang',
            'navbar' => 'qurban',
            'active' => 'realisasi'
        ];

        $realisasi  = $this->realisasiModel->getRealisasi($tahun);
        $perkiraan  = $this->realisasiModel->getDataLengkap();
        $setting    = $this->settingModel->first();

        /*
    Index perkiraan berdasarkan cabang_id
*/
        $mapPerkiraan = [];
        foreach ($perkiraan as $p) {
            $mapPerkiraan[$p['id']] = $p;
        }

        foreach ($realisasi as &$r) {

            $p = $mapPerkiraan[$r['cabang_id']] ?? null;

            if ($p) {
                $r['P_TS'] = $p['TS'];
                $r['P_TK'] = $p['TK'];
                $r['P_A']  = 0;
                $r['P_M']  = 0;

                $r['P_OS'] = $p['jumlah_sapi'] * $setting['b_sapi'];
                $r['P_OK'] = $p['jumlah_kambing'] * $setting['b_kb'];

                $r['P_K_S']  = $p['jumlah_sapi'];
                $r['P_K_KB'] = $p['jumlah_kambing'];

                $r['P_KK_S'] = $p['jumlah_sapi'] * 2;
                $r['P_KLS']  = $p['jumlah_sapi'];
            }
        }

        $data = [
            'realisasi' => $realisasi
        ];

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view('admin/master/realisasi/index', $data, $header);
        echo view("pages/footer");
    }

    public function update($id)
    {
        $data = [
            'R_TS' => $this->request->getPost('R_TS'),
            'R_TK' => $this->request->getPost('R_TK'),
            'R_A' => $this->request->getPost('R_A'),
            'R_M' => $this->request->getPost('R_M'),
            'R_OS' => $this->request->getPost('R_OS'),
            'R_OK' => $this->request->getPost('R_OK'),
            'R_K_S' => $this->request->getPost('R_K_S'),
            'R_K_KB' => $this->request->getPost('R_K_KB'),
            'R_KK_S' => $this->request->getPost('R_KK_S'),
            'R_KLS' => $this->request->getPost('R_KLS')
        ];

        $update = $this->realisasiModel->update($id, $data);

        if ($update) {
            return redirect()->to('/realisasi')->with('success', 'Data realisasi berhasil diperbarui.');
        } else {
            return redirect()->to('/realisasi')->with('error', 'Gagal memperbarui data realisasi.');
        }
    }
}
