<?php

namespace App\Controllers\Admin\Setting;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\CabangModel;
use App\Models\RoleModel;

class UserController extends BaseController
{
    protected $UserModel;
    protected $CabangModel;
    protected $RoleModel;


    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CabangModel = new CabangModel();
        $this->RoleModel = new RoleModel();
    }

    public function index()
    {
        $data['user'] = $this->UserModel->getUser();
        $data['cabang'] = $this->CabangModel->orderBy('nama_cabang', 'ASC')->findAll();
        $data['role'] = $this->RoleModel->orderBy('role_name', 'ASC')->findAll();

        $header = [
            'title' => 'Data User',
            'navbar' => 'Setting',
            'active' => 'user'
        ];

        return view('admin/setting/user', $data, $header);
    }

    public function create()
    {
        $data = [
            'username'  => $this->request->getPost('username'),
            'nama'      => $this->request->getPost('nama'),
            'password'  => $this->request->getPost('password'),
            'role_id'   => $this->request->getPost('role_id'),
            'cabang_id' => $this->request->getPost('cabang_id'),
            'pusat' => $this->request->getPost('pusat'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        if (!$this->UserModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->UserModel->errors());
        }

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    public function update($id)
    {
        $data = [
            'username'  => $this->request->getPost('username'),
            'nama'      => $this->request->getPost('nama'),
            'role_id'   => $this->request->getPost('role_id'),
            'cabang_id' => $this->request->getPost('cabang_id'),
            'pusat'     => $this->request->getPost('pusat'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = $password;
        }

        if (!$this->UserModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->UserModel->errors());
        }

        return redirect()->back()->with('success', 'User berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->UserModel->delete($id);
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
}
