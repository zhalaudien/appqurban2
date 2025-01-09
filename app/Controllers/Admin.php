<?php

namespace App\Controllers;
use App\Models\PanitiaModel;
use App\Models\CabangModel;
use App\Models\QurbanModel;
use CodeIgniter\Controller;

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
        $userModel = new QurbanModel();
        $data['sapib_bumm'] = $userModel->selectSum('sapib_bumm')->get()->getRow()->sapib_bumm;
        $userModel = new QurbanModel();
        $data['kambing_bumm'] = $userModel->selectSum('kambing_bumm')->get()->getRow()->kambing_bumm;
        $userModel = new QurbanModel();
        $data['sapi_mandiri'] = $userModel->selectSum('sapi_mandiri')->get()->getRow()->sapi_mandiri;
        $userModel = new QurbanModel();
        $data['kambing_mandiri'] = $userModel->selectSum('kambing_mandiri')->get()->getRow()->kambing_mandiri;

        $header = [
            'title' => 'Dashboard',
            'navbar' => 'dashboard',
            'active' => 'dashboard'
        ];

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("index", $data, $header);
        echo view("pages/footer");
    }
}