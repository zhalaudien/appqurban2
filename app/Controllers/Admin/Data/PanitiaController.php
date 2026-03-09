<?php

namespace App\Controllers\Admin\Data;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PanitiaModel;
use App\Models\IdpantiaModel;

class PanitiaController extends BaseController
{
    public function index()
    {
        $userModel = new PanitiaModel();
        $idPanitia = new IdpantiaModel();

        $data['idpanitia'] = $idPanitia->orderBy('seksi', 'ASC')->findAll();

        $model = new \App\Models\PanitiaModel();

        $builder = $model
            ->select('panitia.*, cabang.nama_cabang, seksi.nama_seksi')
            ->join('cabang', 'cabang.id = panitia.cabang_id')
            ->join('seksi', 'seksi.id = panitia.seksi_id')
            ->orderBy('panitia.nama', 'ASC');

        $header = [
            'title' => 'Data Panitia',
            'navbar' => 'data',
            'active' => 'panitia'
        ];

        $data['viewpanitia'] = $builder->findAll();

        echo view("admin/data/panitia/index", $data, $header);
    }
}
