<?php

namespace App\Controllers\Admin\Penerimaan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenerimaanModel;
use App\Models\CabangModel;
use App\Models\SettingModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PenerimaanController extends BaseController
{

    protected $penerimaan;
    protected $cabang;

    public function __construct()
    {
        $this->penerimaan = new PenerimaanModel();
        $this->cabang = new CabangModel();
    }

    public function index()
    {

        $data = [
            'cabang' => $this->cabang->where('pusat', 7)->orderBy('nama_cabang', 'ASC')->findAll(),
            'viewpenerimaan' => $this->penerimaan->orderBy('date_input', 'DESC')->findAll(),
            'navbar' => 'penerimaan',
            'active' => 'penerimaan'
        ];



        echo view('admin/penerimaan/index', $data);
    }
}
