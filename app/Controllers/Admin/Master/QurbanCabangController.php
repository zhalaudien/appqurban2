<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PequrbanModel;

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


        echo view('admin/master/dataqurbancabang/index', $data, $header);
    }
}
