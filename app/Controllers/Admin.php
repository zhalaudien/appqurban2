<?php

namespace App\Controllers;
use App\Models\PenerimaanModel;
use App\Models\PanitiaModel;
use App\Models\CabangModel;
use App\Models\QurbanModel;
use CodeIgniter\Controller;
use App\Models\KandangModel;
use App\Models\BesekModel;
use App\Models\RealisasiModel;
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

        $userModel = new RealisasiModel();
        $data['t_ts'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('ts')->get()->getRow()->ts;
        $data['t_tk'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('tk')->get()->getRow()->tk;
        $data['t_a'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('a')->get()->getRow()->a;
        $data['t_os'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('os')->get()->getRow()->os;
        $data['t_ok'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('ok')->get()->getRow()->ok;
        $data['t_ks'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('ks')->get()->getRow()->ks;
        $data['t_kb'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('kb')->get()->getRow()->kb;
        $data['t_kks'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('kks')->get()->getRow()->kks;
        $data['t_kls'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('kls')->get()->getRow()->kls;

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