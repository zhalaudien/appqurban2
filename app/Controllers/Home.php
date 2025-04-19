<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $header = [
            'title' => 'Home',
            'navbar' => 'home',
            'active' => 'home'
        ];

        echo view("homepage/header", $header);
        echo view("homepage/index");
        echo view("homepage/footer");
    }

    public function jadwal()
    {
        $header = [
            'title' => 'Jadwal Pengiriman',
            'navbar' => 'jadwal',
            'active' => 'jadwal'
        ];
        echo view("homepage/header", $header);
        echo view("homepage/jadwal");
        echo view("homepage/footer");
    }

    public function datasapi()
    {
        $header = [
            'title' => 'Data Sapi',
            'navbar' => 'datasapi',
            'active' => 'datasapi'
        ];
        echo view("homepage/header", $header);
        echo view("homepage/datasapi");
        echo view("homepage/footer");
    }

    public function dataqurban()
    {
        $header = [
            'title' => 'Data Qurban',
            'navbar' => 'dataqurban',
            'active' => 'dataqurban'
        ];
        
        echo view("homepage/header", $header);
        echo view("homepage/dataqurban");
        echo view("homepage/footer");
    }

}