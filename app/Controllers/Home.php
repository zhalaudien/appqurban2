<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view("homepage/header");
        echo view("homepage/index");
        echo view("homepage/footer");
    }
}