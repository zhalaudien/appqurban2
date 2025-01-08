<?php

namespace App\Controllers;
use App\Models\CabangModel;
use CodeIgniter\Controller;

class Cabang extends Controller
{
    public function index()
    {
        $userModel = new CabangModel();
        $data['viewcabang'] = $userModel->orderBy('cabang', 'ASC')->findAll();
        
        echo view("pages/header");
        echo view("pages/navbar");
        echo view("datacabang", $data);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new CabangModel;
        $data = array(
            'id'     => $this->request->getPost('id'),
            'cabang' => $this->request->getPost('cabang'),
            'ketua_cabang' => $this->request->getPost('ketua_cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'panitia_qurban' => $this->request->getPost('panitia_qurban'),
            'no2_hp'  => $this->request->getPost('no2_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'perwakilan' => $this->request->getPost('perwakilan')
        );
        $model->saveCabang($data);
        echo '<script>
                alert("Sukses Tambah Data Cabang");
                window.location="'.base_url('cabang').'"
            </script>';
    }

    public function edit()
    {
        $model = new CabangModel;
        $id = $this->request->getPost('id');
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'ketua_cabang' => $this->request->getPost('ketua_cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'panitia_qurban' => $this->request->getPost('panitia_qurban'),
            'no2_hp'  => $this->request->getPost('no2_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'perwakilan' => $this->request->getPost('perwakilan')
        );
        $model->updateCabang($data, $id);
        echo '<script>
                alert("Sukses Edit Data Cabang");
                window.location="'.base_url('cabang').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new CabangModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Cabang");
                window.location="'.base_url('cabang').'"
            </script>';
    }
}