<?php

namespace App\Controllers\Cabang;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PequrbanModel;
use App\Models\CabangModel;

class DashboardController extends BaseController
{
    protected $pequrban;
    protected $cabang;

    public function __construct()
    {
        $this->pequrban = new PequrbanModel();
        $this->cabang   = new CabangModel();
    }

    public function index()
    {
        $cabangId = session()->get('user')['cabang_id'];

        // Profil cabang
        $profilCabang = $this->cabang->find($cabangId);

        // Total pequrban
        $totalPequrban = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->countAllResults();

        // Hewan per jenis
        $totalSapi = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('jenis_hewan', 'sapi')
            ->countAllResults();

        $totalKambing = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('jenis_hewan', 'kambing')
            ->countAllResults();

        // Berdasarkan sumber
        $mandiri = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('sumber', 'mandiri')
            ->countAllResults();

        $bumm = $this->pequrban
            ->where('cabang_id', $cabangId)
            ->where('sumber', 'bumm')
            ->countAllResults();

        return view('cabang/dashboard', [
            'title'         => 'Dashboard Cabang',
            'profil'        => $profilCabang,
            'totalPequrban' => $totalPequrban,
            'totalSapi'     => $totalSapi,
            'totalKambing'  => $totalKambing,
            'mandiri'       => $mandiri,
            'bumm'          => $bumm
        ]);
    }
}
