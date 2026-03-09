<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AmprahModel;

class AmprahController extends BaseController
{
    protected $amprahModel;

    public function __construct()
    {
        $this->amprahModel = new AmprahModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        $data = [
            'amprah' => $this->amprahModel->getAmprah(),
            'navbar' => 'qurban',
            'active' => 'amprah'
        ];

        echo view('admin/master/amprah/index', $data);
    }
}
