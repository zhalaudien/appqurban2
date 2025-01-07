<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view("pages/header");
        echo view("pages/navbar");
        echo view("index");
        echo view("pages/footer");
    }
}