<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PequrbanModel;
use App\Models\CabangModel;

class QurbanCabangController extends BaseController
{
    protected $pequrbanModel;

    public function __construct()
    {
        $this->pequrbanModel = new PequrbanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        $header = [
            'title' => 'Data Hewan Qurban per Cabang',
            'navbar' => 'qurban',
            'active' => 'qurbancabang'
        ];

        $data = [
            'year'  => $tahun,
            'rekap' => $this->pequrbanModel->getRekapPerCabang($tahun),
        ];

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view('admin/master/dataqurbancabang/index', $data, $header);
        echo view("pages/footer");
    }
}
