<?php

namespace App\Controllers;

use App\Models\PenerimaanModel;
use App\Models\PanitiaModel;
use App\Models\CabangModel;
use App\Models\QurbanModel;
use CodeIgniter\Controller;
use App\Models\KandangModel;
use App\Models\BesekModel;
use App\Models\K3Model;

class Admin extends Controller
{
    public function index()

    {
        $userModel = new PanitiaModel();
        $data['jumlahpanitia'] = $userModel->get()->getNumRows();

        $userModel = new CabangModel();
        $data['jumlahcabang'] = $userModel->get()->getNumRows();

        $userModel = new QurbanModel();
        $data['sapi_bumm'] = $userModel->selectSum('sapi_bumm')->get()->getRow()->sapi_bumm;
        $data['sapib_bumm'] = $userModel->selectSum('sapib_bumm')->get()->getRow()->sapib_bumm;
        $data['kambing_bumm'] = $userModel->selectSum('kambing_bumm')->get()->getRow()->kambing_bumm;
        $data['sapi_mandiri'] = $userModel->selectSum('sapi_mandiri')->get()->getRow()->sapi_mandiri;
        $data['kambing_mandiri'] = $userModel->selectSum('kambing_mandiri')->get()->getRow()->kambing_mandiri;
        $data['t_ts'] = $userModel->selectSum('r_ts')->get()->getRow()->r_ts;
        $data['t_tk'] = $userModel->selectSum('r_tk')->get()->getRow()->r_tk;
        $data['t_a'] = $userModel->selectSum('r_a')->get()->getRow()->r_a;
        $data['t_os'] = $userModel->selectSum('r_os')->get()->getRow()->r_os;
        $data['t_ok'] = $userModel->selectSum('r_ok')->get()->getRow()->r_ok;
        $data['t_ks'] = $userModel->selectSum('r_ks')->get()->getRow()->r_ks;
        $data['t_kb'] = $userModel->selectSum('r_kb')->get()->getRow()->r_kb;
        $data['t_kks'] = $userModel->selectSum('r_kks')->get()->getRow()->r_kks;
        $data['t_kls'] = $userModel->selectSum('r_kls')->get()->getRow()->r_kls;

        $userModel = new PenerimaanModel();
        $data['viewpenerimaan'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['total_sapi_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_sapi_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_kambing_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('kambing')->get()->getRow()->kambing;
        $data['total_kambing_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('kambing')->get()->getRow()->kambing;
        $data['uang_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('pembayaran')->get()->getRow()->pembayaran;
        $data['uang_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('pembayaran')->get()->getRow()->pembayaran;
        $data['shadaqoh'] = $userModel->selectSum('shadaqoh')->get()->getRow()->shadaqoh;
        $data['total_sapi'] = $userModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_kambing'] = $userModel->selectSum('kambing')->get()->getRow()->kambing;

        $userModel = new KandangModel();
        $data['viewkandang'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['disembelih_sapi'] = $userModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['disembelih_kambing'] = $userModel->selectSum('kambing')->get()->getRow()->kambing;

        $userModel = new BesekModel();
        $data['viewbesek'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['ts'] = $userModel->selectSum('ts')->get()->getRow()->ts;
        $data['tk'] = $userModel->selectSum('tk')->get()->getRow()->tk;
        $data['a'] = $userModel->selectSum('a')->get()->getRow()->a;
        $data['os'] = $userModel->selectSum('os')->get()->getRow()->os;
        $data['ok'] = $userModel->selectSum('ok')->get()->getRow()->ok;


        $userModel = new K3Model();
        $data['ks'] = $userModel->selectSum('ks')->get()->getRow()->ks;
        $data['kb'] = $userModel->selectSum('kb')->get()->getRow()->kb;
        $data['kks'] = $userModel->selectSum('kks')->get()->getRow()->kks;
        $data['kls'] = $userModel->selectSum('kls')->get()->getRow()->kls;

        $header = [
            'title' => 'Dashboard',
            'navbar' => 'dashboard',
            'active' => 'dashboard'
        ];

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("dashboard", $data, $header);
        echo view("pages/footer");
    }
}
