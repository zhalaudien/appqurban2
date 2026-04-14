<?php

namespace App\Controllers\Admin\Setting;

use App\Controllers\BaseController;
use App\Models\SeksiModel;

class SeksiController extends BaseController
{
    protected $seksiModel;

    public function __construct()
    {
        $this->seksiModel = new SeksiModel();
    }

    public function index()
    {
        $data['seksi'] = $this->seksiModel->orderBy('nama_seksi', 'ASC')->findAll();

        $header = [
            'title' => 'Data Seksi',
            'navbar' => 'Setting',
            'active' => 'seksi'
        ];

        return view('admin/setting/seksi', $data, $header);
    }

    public function create()
    {
        $data = [
            'nama_seksi' => $this->request->getPost('nama_seksi')
        ];

        if (!$this->seksiModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->seksiModel->errors());
        }

        return redirect()->back()->with('success', 'Seksi berhasil ditambahkan');
    }

    public function update($id)
    {
        $data = [
            'id' => $id,
            'nama_seksi' => $this->request->getPost('nama_seksi')
        ];

        if (!$this->seksiModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->seksiModel->errors());
        }

        return redirect()->back()->with('success', 'Seksi berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->seksiModel->delete($id);
        return redirect()->back()->with('success', 'Seksi berhasil dihapus');
    }
}
