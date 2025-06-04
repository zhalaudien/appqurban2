<?php

namespace App\Controllers;

use App\Models\SettingModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Setting extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $header = [
            'title' => 'Setting',
            'navbar' => 'setting',
            'active' => 'setting'
        ];

        $userModel = new SettingModel();
        $data['viewsetting'] = $userModel->orderBy('id', 'ASC')->findAll();

        $data['user'] = $this->userModel->findAll();

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
            'j_h_1' => $this->request->getPost('j_h_1'),
            'j_h' => $this->request->getPost('j_h'),
            'j_h2' => $this->request->getPost('j_h2'),
            'j_h3' => $this->request->getPost('j_h3'),
            'j_h4' => $this->request->getPost('j_h4'),
            'biaya' => $this->request->getPost('biaya'),
            'hari' => $this->request->getPost('hari'),
            'jadwal' => $this->request->getPost('jadwal'),
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
    // Menambah user baru
    public function tambahuser()
    {
        $this->userModel->save([
            'username'     => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    // Mengedit user
    public function edituser()
    {
        $id = $this->request->getPost('id');

        $updateData = [
            'id'   => $id,
            'username' => $this->request->getPost('username'),
        ];

        // Hanya update password jika tidak kosong
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $updateData['password'] = $password;
        }

        $this->userModel->save($updateData);

        return redirect()->back()->with('success', 'User berhasil diperbarui.');
    }

    public function hapususer($id = null)
    {
        $model = new UserModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus username");
                window.location="' . base_url('setting') . '"
            </script>';
    }
}
