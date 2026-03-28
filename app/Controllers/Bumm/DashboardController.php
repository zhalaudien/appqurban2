<?php

namespace App\Controllers\Bumm;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PequrbanModel;
use App\Models\PembayaranModel;


class DashboardController extends BaseController
{
    protected PequrbanModel $model;

    public function __construct()
    {
        $this->model    = new PequrbanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');
        $rekap = $this->model->getRekapBumm($tahun);

        $data = [
            'year'         => $tahun,
            'totalSapi'    => array_sum(array_column($rekap, 'sapi_bumm')),
            'totalKambing' => array_sum(array_column($rekap, 'kambing_bumm')),
            'totalUang'    => array_sum(array_column($rekap, 'uang_bumm')),
            'rekap'        => $rekap
        ];

        return view('bumm/dashboard', $data);
    }
}
