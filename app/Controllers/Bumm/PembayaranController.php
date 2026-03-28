<?php

namespace App\Controllers\Bumm;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CabangModel;
use App\Models\PembayaranModel;


class PembayaranController extends BaseController
{
    protected CabangModel $cabang;
    protected PembayaranModel $pembayaran;

    public function __construct()
    {
        $this->cabang = new CabangModel();
        $this->pembayaran = new PembayaranModel();
    }

    public function index()
    {
        $data = [
            'cabang' => $this->cabang->where('pusat', 7)->orderBy('nama_cabang', 'ASC')->findAll(),
            'viewbembayaran' => $this->pembayaran->orderBy('updated_at', 'DESC')->findAll(),
            'navbar' => 'pembayaran',
            'active' => 'pembayaran'
        ];



        echo view('bumm/pembayaran', $data);
    }
}
