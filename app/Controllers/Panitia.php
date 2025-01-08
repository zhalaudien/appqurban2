<?php

namespace App\Controllers;
use App\Models\PanitiaModel;
use CodeIgniter\Controller;

class Panitia extends Controller
{
    public function index()
    {
        $userModel = new PanitiaModel();
        $data['viewpanitia'] = $userModel->orderBy('nama', 'ASC')->findAll();
      
        echo view("pages/header");
        echo view("pages/navbar");
        echo view("datapanitia", $data);
        echo view("pages/footer");
    }
}