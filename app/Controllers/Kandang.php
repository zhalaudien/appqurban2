<?php

namespace App\Controllers;
use App\Models\KandangModel;
use CodeIgniter\Controller;

class Kandang extends Controller
{
    public function index()
    {
        $userModel = new KandangModel();
        $data['viewkandang'] = $userModel->orderBy('date_input', 'DESC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar");
        echo view("kandang", $data);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new KandangModel;
        $data = array(
            'sapi' => $this->request->getPost('sapi'),
            'kambing' => $this->request->getPost('kambing'),
        );
        $model->save($data);
        echo '<script>
                alert("Sukses Tambah Data Kandang");
                window.location="'.base_url('kandang').'"
            </script>';
    }

    public function edit()
    {
        $model = new KandangModel;
        $id = $this->request->getPost('id');
        $data = array(
            'sapi' => $this->request->getPost('sapi'),
            'kambing' => $this->request->getPost('kambing'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Kandang");
                window.location="'.base_url('kandang').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new KandangModel();
        $data['kandang'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Kandang");
                window.location="'.base_url('kandang').'"
            </script>';
    }
}