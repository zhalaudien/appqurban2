<?php

namespace App\Controllers;
use App\Models\PanitiaModel;
use CodeIgniter\Controller;
use App\Models\IdpantiaModel;

class Panitia extends Controller
{
    public function index()
    {
        $userModel = new PanitiaModel();
        $idPanitia = new IdpantiaModel();
        $data['viewpanitia'] = $userModel->orderBy('nama', 'ASC')->findAll();
        $data['idpanitia'] = $idPanitia->orderBy('seksi', 'ASC')->findAll();
      
        echo view("pages/header");
        echo view("pages/navbar");
        echo view("datapanitia", $data);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new PanitiaModel;
        $data = array(
            'id'     => $this->request->getPost('id'),
            'nama'   => $this->request->getPost('nama'),
            'cabang' => $this->request->getPost('cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'seksi'  => $this->request->getPost('seksi'),
            'ket'    => $this->request->getPost('ket')
        );
        $model->savePanitia($data);
        echo '<script>
                alert("Sukses Tambah Data Panitia");
                window.location="'.base_url('panitia').'"
            </script>';
    }


    public function edit()
    {
        $model = new PanitiaModel;
        $id = $this->request->getPost('id');
        $data = array(
            'nama'   => $this->request->getPost('nama'),
            'cabang' => $this->request->getPost('cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'seksi'  => $this->request->getPost('seksi'),
            'ket'    => $this->request->getPost('ket')
        );
        $model->updatePanitia($data, $id);
        echo '<script>
                alert("Sukses Edit Data Panitia");
                window.location="'.base_url('panitia').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new PanitiaModel;
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Panitia");
                window.location="'.base_url('panitia').'"
            </script>';
    }
}