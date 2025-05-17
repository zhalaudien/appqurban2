<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\IdpantiaModel;
use App\Models\PanitiaModel;
use App\Models\Presensi;

class Presensi extends Controller
{
    public function index()
    {
        $header = [
            'title' => 'Presensi Panitia',
            'navbar' => 'presensi',
            'active' => 'presensi'
        ];

        $idPanitiaModel = new IdpantiaModel();
        $panitiaModel = new PanitiaModel();

        $data['idpanitia'] = $idPanitiaModel->orderBy('seksi', 'ASC')->findAll();

        $seksi = $this->request->getPost('seksi');
        $data['panitia'] = $seksi
            ? $panitiaModel->where('seksi', $seksi)->orderBy('nama', 'ASC')->findAll()
            : $panitiaModel->orderBy('nama', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("presensi", $data, $header);
        echo view("pages/footer");
    }

    public function simpan()
    {

        $presensiModel = new Presensi();
        $panitiaModel = new PanitiaModel();

        $seksi = $panitiaModel->getPost('seksi');
        $presensiInput = $presensiModel->getPost('presensi'); // array: [id_panitia => 1]

        // Ambil semua panitia di seksi ini
        $panitias = $panitiaModel->where('seksi', $seksi)->findAll();

        foreach ($panitias as $panitia) {
            $id = $panitia['id'];
            $status = isset($presensiInput[$id]) ? 1 : 0;

            $presensiModel->insert([
                'id_panitia'   => $id,
                'seksi'        => $seksi,
                'status_hadir' => $status
            ]);
        }

        return redirect()->to('/presensi')->with('message', 'Presensi berhasil disimpan.');
    }
}
