<?php

namespace App\Controllers\Admin\Setting;

use App\Controllers\BaseController;
use App\Models\CabangModel;

class CabangController extends BaseController
{
    protected $CabangModel;

    public function __construct()
    {
        $this->CabangModel = new CabangModel();
    }

    public function index()
    {
        $data['cabang'] = $this->CabangModel->orderBy('id', 'ASC')->findAll();

        $header = [
            'title' => 'Data Cabang',
            'navbar' => 'Setting',
            'active' => 'cabang'
        ];

        return view('admin/setting/cabang', $data, $header);
    }

    public function create()
    {
        $data = [
            'id' => $this->request->getPost('id'),
            'nama_cabang' => $this->request->getPost('nama_cabang'),
            'pusat' => $this->request->getPost('pusat'),
        ];

        if (!$this->CabangModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->CabangModel->errors());
        }

        return redirect()->back()->with('success', 'Seksi berhasil ditambahkan');
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'nama_seksi' => $this->request->getPost('nama_seksi'),
            'pusat' => $this->request->getPost('pusat')
        ];

        if (!$this->CabangModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->CabangModel->errors());
        }

        return redirect()->back()->with('success', 'Seksi berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->CabangModel->delete($id);
        return redirect()->back()->with('success', 'Seksi berhasil dihapus');
    }
}
