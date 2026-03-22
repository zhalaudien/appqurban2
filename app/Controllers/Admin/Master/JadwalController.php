<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;

class JadwalController extends BaseController
{
    protected $JadwalModel;

    public function __construct()
    {
        $this->JadwalModel = new JadwalModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        $data = [
            'jadwal' => $this->JadwalModel->getJadwal(),
            'navbar' => 'qurban',
            'active' => 'jadwal'
        ];

        echo view('admin/master/jadwal/index', $data);
    }
}
