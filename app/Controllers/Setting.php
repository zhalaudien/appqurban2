<?php

namespace App\Controllers;

use App\Models\SettingModel;
use CodeIgniter\Controller;

class Setting extends Controller
{
    public function index()
    {
        $header = [
            'title' => 'Setting',
            'navbar' => 'setting',
            'active' => 'seting'
        ];

        $userModel = new SettingModel();
        $data['viewsetting'] = $userModel->orderBy('id', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("setting", $data, $header);
        echo view("pages/footer");
    }

    public function edit()
    {
        $userModel = new SettingModel();
        $id = $this->request->getPost('id');
        $data = [
            'b_kb' => $this->request->getPost('b_kb'),
            'b_sapi' => $this->request->getPost('b_sapi'),
            'j_h-1' => $this->request->getPost('j_h-1'),
            'j_h' => $this->request->getPost('j_h'),
            'j_h2' => $this->request->getPost('j_h2'),
            'j_h3' => $this->request->getPost('j_h3'),
            'j_h4' => $this->request->getPost('j_h4'),
        ];

        if ($userModel->EditSetting($data, $id)) {
            echo '<script>
                alert("Sukses Update Setting");
                window.location="' . base_url('setting') . '"
            </script>';
        } else {
            return redirect()->to('/setting')->with('error', 'Data gagal diubah');
        }
    }
}
