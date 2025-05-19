<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\IdpantiaModel;
use App\Models\PanitiaModel;
use App\Models\PresensiModel;

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
        $request = $this->request;
        $dataPresensi = $request->getPost('data');

        if (!$dataPresensi || !is_array($dataPresensi)) {
            return redirect()->back()->with('error', 'Tidak ada data presensi yang dikirim.');
        }

        $presensiModel = new PresensiModel();

        foreach ($dataPresensi as $item) {
            $status = isset($item['presensi']) && $item['presensi'] === 'hadir' ? 'hadir' : 'tidak hadir';

            $presensiModel->insert([
                'nama'     => $item['nama'],
                'cabang'   => $item['cabang'],
                'seksi'    => $item['seksi'],
                'presensi' => $item['presensi']
            ]);
        }
        echo '<script>
                alert("Sukses Tambah Data Presensi");
                window.location="' . base_url('presensi') . '"
            </script>';
    }
}
