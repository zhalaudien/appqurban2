<?php

namespace App\Controllers;

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

        $header = [
            'title' => 'Data Amprah Besek Cabang',
            'navbar' => 'qurban',
            'active' => 'amprah'
        ];

        $data = [
            'amprah' => $this->amprahModel->getAmprah(),
        ];

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view('admin/master/amprah/index', $data, $header);
        echo view("pages/footer");
    }
}
