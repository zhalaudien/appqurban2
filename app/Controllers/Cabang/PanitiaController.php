<?php

namespace App\Controllers\Cabang;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PanitiaModel;
use App\Models\SeksiModel;

class PanitiaController extends BaseController
{
    protected int $cabangId;
    protected PanitiaModel $model;

    // Gunakan initController sebagai pengganti __construct di CI4
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Panggil initController dari parent (BaseController)
        parent::initController($request, $response, $logger);

        // Inisialisasi model dan session di sini
        $this->model = new PanitiaModel();
        $this->cabangId = session()->get('user')['cabang_id'] ?? 0;
    }

    public function index()
    {
        // Sekarang kamu bisa langsung menggunakan $this->cabangId di sini agar konsisten
        $cabang = $this->cabangId;

        $panitia = $this->model->getPanitiaByCabang($cabang);

        $seksiModel = new SeksiModel();
        $seksi = $seksiModel->getAll();

        return view('cabang/panitia/index', compact('cabang', 'panitia', 'seksi'));
    }

    public function store()
    {
        if (!$this->cabangId) {
            return redirect()->back()->with('error', 'Session cabang tidak ditemukan');
        }

        $this->model->insert([
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'cabang_id' => $this->cabangId,
            'seksi_id' => $this->request->getPost('seksi_id'),
            'jabatan' => $this->request->getPost('jabatan')
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $data = $this->model
            ->where('id', $id)
            ->where('cabang_id', $this->cabangId)
            ->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $this->model->update($id, [
            'nama' => $this->request->getPost('nama'),
            'no_hp' => $this->request->getPost('no_hp'),
            'seksi_id' => $this->request->getPost('seksi_id'),
            'jabatan' => $this->request->getPost('jabatan')
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {

        $data = $this->model
            ->where('id', $id)
            ->where('cabang_id', $this->cabangId)
            ->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $this->model->delete($id);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function export() {}
}
