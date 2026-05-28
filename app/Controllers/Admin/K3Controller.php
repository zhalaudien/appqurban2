<?php

namespace App\Controllers\Admin;

use App\Models\QurbanModel;
use CodeIgniter\Controller;
use App\Models\K3Model;
use App\Models\PermintaanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class K3Controller extends Controller
{

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        $header = [
            'title' => 'Data K3',
            'navbar' => 'k3',
            'active' => 'k3',
            'year' => $tahun
        ];


        $k3Model = new K3Model();
        $data['viewk3'] = $k3Model->where('YEAR(date_input)', $tahun)->orderBy('date_input', 'DESC')->findAll();

        // Tanggal hari ini
        $today = date('Y-m-d');

        // Data MASUK hari ini
        $data['ks_today'] = $k3Model->where('DATE(date_input)', $today)->selectSum('ks')->get()->getRow()->ks ?? 0;
        $data['kb_today'] = $k3Model->where('DATE(date_input)', $today)->selectSum('kb')->get()->getRow()->kb ?? 0;
        $data['kks_today'] = $k3Model->where('DATE(date_input)', $today)->selectSum('kks')->get()->getRow()->kks ?? 0;
        $data['kls_today'] = $k3Model->where('DATE(date_input)', $today)->selectSum('kls')->get()->getRow()->kls ?? 0;
        $data['buntut_today'] = $k3Model->where('DATE(date_input)', $today)->selectSum('buntut')->get()->getRow()->buntut ?? 0;
        $data['klsb_today'] = $k3Model->where('DATE(date_input)', $today)->selectSum('klsb')->get()->getRow()->klsb ?? 0;

        // Data Qurban yang Dikirim Hari Ini
        $qurbanModel = new QurbanModel();
        $kirim_today = $qurbanModel
            ->where('DATE(date_input)', $today)
            ->where('status', 'Dikirim')
            ->selectSum('r_ks')
            ->selectSum('r_kb')
            ->selectSum('r_kks')
            ->selectSum('r_kls')
            ->first();

        $data['kirim_ks'] = $kirim_today['r_ks'] ?? 0;
        $data['kirim_kb'] = $kirim_today['r_kb'] ?? 0;
        $data['kirim_kks']  = $kirim_today['r_kks']  ?? 0;
        $data['kirim_kls'] = $kirim_today['r_kls'] ?? 0;

        // Data permintaa yang Dikirim Hari Ini
        $qurbanModel = new PermintaanModel();
        $kirim_permintaan = $qurbanModel
            ->where('DATE(date_input)', $today)
            ->selectSum('ks')
            ->selectSum('kb')
            ->selectSum('kks')
            ->selectSum('kls')
            ->first();

        $data['permintaan_ks'] = $kirim_permintaan['ks'] ?? 0;
        $data['permintaan_kb'] = $kirim_permintaan['kb'] ?? 0;
        $data['permintaan_kks']  = $kirim_permintaan['kks']  ?? 0;
        $data['permintaan_kls'] = $kirim_permintaan['kls'] ?? 0;

        return view("admin/k3", array_merge($data, $header));
    }


    public function create()
    {
        $model = new K3Model;
        $data = array(
            'ks' => $this->request->getPost('ks'),
            'kb' => $this->request->getPost('kb'),
            'kks' => $this->request->getPost('kks'),
            'buntut' => $this->request->getPost('buntut'),
            'kls' => $this->request->getPost('kls'),
            'klsb' => $this->request->getPost('klsb'),
        );
        $model->savek3($data);
        echo '<script>
                alert("Sukses Tambah Data K3");
                window.location="' . base_url('k3') . '"
            </script>';
    }


    public function delete($id = null)
    {
        $model = new K3Model();
        $model->delete($id);

        echo '<script>
                alert("Sukses Hapus Data K3");
                window.location="' . base_url('k3') . '"
            </script>';
    }

    public function export()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        $model = new K3Model();
        $data = $model->where('YEAR(date_input)', $tahun)->orderBy('date_input', 'DESC')->findAll();
        $date = date('Y-m-d');

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Kepala Sapi')
            ->setCellValue('D1', 'Kepala Kambing')
            ->setCellValue('E1', 'Kulit Kambing')
            ->setCellValue('F1', 'Kulit Sapi')
            ->setCellValue('G1', 'Kaki Sapi')
            ->setCellValue('H1', 'Keterangan');

        $column = 2;
        $no = 1;
        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $row['date_input'])
                ->setCellValue('C' . $column, $row['kepala_sapi'])
                ->setCellValue('D' . $column, $row['kepala_kambing'])
                ->setCellValue('E' . $column, $row['kulit_kambing'])
                ->setCellValue('F' . $column, $row['kulit_sapi'])
                ->setCellValue('G' . $column, $row['kaki_sapi'])
                ->setCellValue('H' . $column, $row['keterangan']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data k3 ' . $tahun . ' - ' . $date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
