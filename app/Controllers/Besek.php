<?php

namespace App\Controllers;
use App\Models\BesekModel;
use CodeIgniter\Controller;

class Besek extends Controller
{
    public function index()
    {
        $userModel = new BesekModel();
        $data['viewbesek'] = $userModel->orderBy('date_input', 'DESC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar");
        echo view("besek", $data);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new BesekModel;
        $data = array(
            'ts' => $this->request->getPost('ts'),
            'tk' => $this->request->getPost('tk'),
            'm' => $this->request->getPost('m'),
            'os' => $this->request->getPost('os'),
            'ok' => $this->request->getPost('ok'),
        );
        $model->save($data);
        echo '<script>
                alert("Sukses Tambah Data Besek");
                window.location="'.base_url('besek').'"
            </script>';
    }

    public function edit()
    {
        $model = new BesekModel;
        $id = $this->request->getPost('id');
        $data = array(
            'ts' => $this->request->getPost('ts'),
            'tk' => $this->request->getPost('tk'),
            'm' => $this->request->getPost('m'),
            'os' => $this->request->getPost('os'),
            'ok' => $this->request->getPost('ok'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Besek");
                window.location="'.base_url('besek').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new BesekModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Besek");
                window.location="'.base_url('besek').'"
            </script>';
    }
}