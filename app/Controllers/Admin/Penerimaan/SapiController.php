<?php

namespace App\Controllers\Admin\Penerimaan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\QurbanModel;
use App\Models\PenerimaanModel;
use App\Models\CabangModel;
use App\Models\SettingModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\SapiModel;
use App\Models\PequrbanModel;

class SapiController extends BaseController
{
    protected $penerimaanModel;
    protected $cabangModel;
    protected $qurbanModel;
    protected $settingModel;
    protected $pequrbanModel;
    protected $sapiModel;


    public function __construct()
    {
        $this->penerimaanModel = new PenerimaanModel();
        $this->cabangModel     = new CabangModel();
        $this->qurbanModel     = new QurbanModel();
        $this->settingModel    = new SettingModel();
        $this->pequrbanModel   = new PequrbanModel();
        $this->sapiModel       = new SapiModel();
    }

    // ----------------------------------------------------------------
    // READ — tampilkan semua data + form tambah
    // ----------------------------------------------------------------
    public function index()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $data = [
            'title'          => 'Data Sapi',
            'navbar'         => 'penerimaan',
            'active'         => 'datasapi',
            'tahun_selected' => $tahun,
            'viewsapi'       => $this->sapiModel->where('YEAR(date_input)', $tahun)->orderBy('date_input', 'DESC')->findAll(),
            'viewcabang'     => $this->cabangModel->findAll(),
        ];

        return view('admin/penerimaan/datasapi', $data);
    }

    // ----------------------------------------------------------------
    // CREATE — simpan data baru
    // ----------------------------------------------------------------
    public function create()
    {
        try {
            $this->sapiModel->insert([
                'cabang' => $this->request->getPost('cabang'),
                'harga'  => $this->request->getPost('harga'),
                'berat'  => $this->request->getPost('berat'),
                'nomor'  => $this->request->getPost('nomor'),
            ]);

            return redirect()->to(base_url('datasapi'))
                ->with('success', 'Data sapi berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // ----------------------------------------------------------------
    // UPDATE — simpan perubahan data
    // ----------------------------------------------------------------
    public function update($id)
    {
        $item = $this->sapiModel->find($id);
        if (!$item) {
            return redirect()->to('/datasapi')->with('error', 'Data tidak ditemukan.');
        }

        $this->sapiModel->update($id, [
            'cabang' => $this->request->getPost('cabang'),
            'harga'  => $this->request->getPost('harga'),
            'berat'  => $this->request->getPost('berat'),
            'nomor'  => $this->request->getPost('nomor'),
        ]);

        return redirect()->to('/datasapi')->with('success', 'Data sapi berhasil diperbarui.');
    }

    // ----------------------------------------------------------------
    // DELETE — hapus data
    // ----------------------------------------------------------------
    public function hapus($id)
    {
        $item = $this->sapiModel->find($id);
        if (!$item) {
            return redirect()->to('/datasapi')->with('error', 'Data tidak ditemukan.');
        }

        $this->sapiModel->delete($id);
        return redirect()->to('/datasapi')->with('success', 'Data sapi berhasil dihapus.');
    }
}
