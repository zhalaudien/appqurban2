<?php

namespace App\Controllers;
use App\Models\CabangModel;
use CodeIgniter\Controller;

class Cabang extends Controller
{
    public function index()
    {
        $userModel = new CabangModel();
        $data['viewcabang'] = $userModel->orderBy('cabang', 'ASC')->findAll();
        
        echo view("pages/header");
        echo view("pages/navbar");
        echo view("datacabang", $data);
        echo view("pages/footer");
    }
}