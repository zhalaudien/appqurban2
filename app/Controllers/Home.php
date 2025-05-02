<?php

namespace App\Controllers;

use App\Models\QurbanModel;
use CodeIgniter\Controller;
use App\Models\SapiModel;

class Home extends Controller
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
            'navbar' => 'jadwal2',
            'active' => 'jadwal2'
        ];

        $userModel = new QurbanModel();
        $data['jadwal'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        $keywords = ['H1', 'H2', 'H3', 'H4'];
        foreach ($keywords as $keyword) {
            $data[strtolower($keyword)] = $userModel->like('kirim_besek', $keyword)
                ->orderBy('kirim_hewan', 'ASC')
                ->findAll();
        }

        $qurbanModel = new QurbanModel();

        // Daftar kategori dan tipe
        $categories = [
            'sapi_bumm' => 'sapi_bumm',
            'sapib_bumm' => 'sapib_bumm',
            'kambing_bumm' => 'kambing_bumm',
            'sapi_mandiri' => 'sapi_mandiri',
            'kambing_mandiri' => 'kambing_mandiri',
        ];

        // Daftar hari
        $days = ['h1', 'h2', 'h3', 'h4'];

        // Loop untuk memproses data
        foreach ($categories as $key => $column) {
            foreach ($days as $day) {
                $data[$key . '_' . $day] = $qurbanModel->selectSum($column)
                    ->like('kirim_besek', $day)
                    ->get()
                    ->getRow()
                    ->$column;
            }
        }

        echo view("homepage/header", $header);
        echo view("homepage/jadwal", $data);
        echo view("homepage/footer");
    }

    public function datasapi()
    {
        $header = [
            'title' => 'Data Sapi',
            'navbar' => 'datasapi2',
            'active' => 'datasapi2'
        ];

        $userModel = new SapiModel();
        $data['viewsapi'] = $userModel->orderBy('date_input', 'DESC')->findAll();

        echo view("homepage/header", $header);
        echo view("homepage/datasapi", $data);
        echo view("homepage/footer");
    }

    public function dataqurban()
    {
        $header = [
            'title' => 'Data Qurban',
            'navbar' => 'dataqurban',
            'active' => 'dataqurban'
        ];

        $userModel = new QurbanModel();
        $data['qurban'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("homepage/header", $header);
        echo view("homepage/dataqurban", $data);
        echo view("homepage/footer");
    }

    public function realisasi()
    {
        $header = [
            'title' => 'Realisasi Besek',
            'navbar' => 'realisasi',
            'active' => 'realisasi'
        ];

        $userModel = new QurbanModel();
        $data['jadwal'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        $keywords = ['H1', 'H2', 'H3', 'H4'];
        foreach ($keywords as $keyword) {
            $data[strtolower($keyword)] = $userModel->like('kirim_besek', $keyword)
                ->orderBy('antrian', 'ASC')
                ->findAll();
        }

        echo view("homepage/header", $header);
        echo view("homepage/realisasi", $data);
        echo view("homepage/footer");
    }
}
