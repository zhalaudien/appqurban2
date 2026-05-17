<?php

namespace App\Controllers\Admin\Setting;

use App\Models\SettingModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class SettingController extends Controller
{
    protected $userModel;
    protected $settingModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $header = [
            'title' => 'Setting',
            'navbar' => 'setting',
            'active' => 'setting'
        ];

        $data['viewsetting'] = $this->settingModel->orderBy('id', 'ASC')->findAll();

        $data['user'] = $this->userModel->findAll();

        return view('admin/setting/setting', $data, $header);
    }

    public function edit()
    {
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
            'access_password' => $this->request->getPost('access_password'),
        ];

        if ($this->settingModel->update($id, $data)) {
            return redirect()->to('/setting')->with('success', 'Pengaturan berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui pengaturan');
        }
    }
}
