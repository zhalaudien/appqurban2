<?php

namespace App\Controllers;

use App\Models\KandangModel;
use App\Models\PenerimaanModel;
use App\Models\QurbanModel;
use App\Models\RealisasiModel;
use CodeIgniter\Controller;
use App\Models\K3Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kandang extends Controller
{
    public function index()
    {
        $header = [
            'title' => 'Data Kandang',
            'navbar' => 'kandang',
            'active' => 'kandang'
        ];

        // Ambil total hewan masuk
        $penerimaanModel = new PenerimaanModel();
        $data['total_sapi'] = $penerimaanModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_kambing'] = $penerimaanModel->selectSum('kambing')->get()->getRow()->kambing;

        // Ambil data hewan disembelih
        $kandangModel = new KandangModel();
        $data['viewkandang'] = $kandangModel->orderBy('date_input', 'DESC')->findAll();
        $data['disembelih_sapi'] = $kandangModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['disembelih_kambing'] = $kandangModel->selectSum('kambing')->get()->getRow()->kambing;

        // Hewan disembelih hari ini
        $today = date('Y-m-d');
        $data['disembelih_sapi_today'] = $kandangModel
            ->where('DATE(date_input)', $today)
            ->selectSum('sapi')
            ->first()['sapi'] ?? 0;

        $data['disembelih_kambing_today'] = $kandangModel
            ->where('DATE(date_input)', $today)
            ->selectSum('kambing')
            ->first()['kambing'] ?? 0;

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("kandang", array_merge($data, $header)); // kirim $data dan $header ke view
        echo view("pages/footer");
    }


    public function tambah()
    {
        $model = new KandangModel;
        $data = array(
            'sapi' => $this->request->getPost('sapi'),
            'kambing' => $this->request->getPost('kambing'),
        );
        $model->save($data);
        echo '<script>
                alert("Sukses Tambah Data Kandang");
                window.location="' . base_url('kandang') . '"
            </script>';
    }

    public function edit()
    {
        $model = new KandangModel;
        $id = $this->request->getPost('id');
        $data = array(
            'sapi' => $this->request->getPost('sapi'),
            'kambing' => $this->request->getPost('kambing'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Kandang");
                window.location="' . base_url('kandang') . '"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new KandangModel();
        $data['kandang'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Kandang");
                window.location="' . base_url('kandang') . '"
            </script>';
    }

    public function export()
    {
        $model = new KandangModel();
        $data = $model->orderBy('date_input', 'DESC')->findAll();
        $date = date('Y-m-d');

        $spreadsheet = new Spreadsheet();
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Sapi')
            ->setCellValue('D1', 'Kambing');

        $column = 2;
        $no = 1;
        foreach ($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $row['date_input'])
                ->setCellValue('C' . $column, $row['sapi'])
                ->setCellValue('D' . $column, $row['kambing']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data kandang ' . $date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function viewk3()
    {
        $header = [
            'title' => 'Data K3',
            'navbar' => 'k3',
            'active' => 'k3'
        ];


        $k3Model = new K3Model();
        $data['viewk3'] = $k3Model->orderBy('date_input', 'DESC')->findAll();

        // Tanggal hari ini
        $today = date('Y-m-d');

        // Data MASUK hari ini
        $data['ks_today'] = $k3Model->where('keterangan', 'Masuk')->where('DATE(date_input)', $today)->selectSum('ks')->get()->getRow()->ks ?? 0;
        $data['kb_today'] = $k3Model->where('keterangan', 'Masuk')->where('DATE(date_input)', $today)->selectSum('kb')->get()->getRow()->kb ?? 0;
        $data['kks_today'] = $k3Model->where('keterangan', 'Masuk')->where('DATE(date_input)', $today)->selectSum('kks')->get()->getRow()->kks ?? 0;
        $data['kls_today'] = $k3Model->where('keterangan', 'Masuk')->where('DATE(date_input)', $today)->selectSum('kls')->get()->getRow()->kls ?? 0;
        $data['klsb_today'] = $k3Model->where('keterangan', 'Masuk')->where('DATE(date_input)', $today)->selectSum('klsb')->get()->getRow()->klsb ?? 0;

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

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("k3", $data);
        echo view("pages/footer");
    }


    public function tambahk3()
    {
        $model = new K3Model;
        $data = array(
            'ks' => $this->request->getPost('ks'),
            'kb' => $this->request->getPost('kb'),
            'kks' => $this->request->getPost('kks'),
            'kls' => $this->request->getPost('kls'),
            'klsb' => $this->request->getPost('klsb'),
        );
        $model->savek3($data);
        echo '<script>
                alert("Sukses Tambah Data K3");
                window.location="' . base_url('k3') . '"
            </script>';
    }


    public function hapusk3($id = null)
    {
        $model = new K3Model();
        $data['k3'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data K3");
                window.location="' . base_url('k3') . '"
            </script>';
    }

    public function exportk3()
    {
        $model = new K3Model();
        $data = $model->orderBy('date_input', 'DESC')->findAll();
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
        $fileName = 'Data k3 ' . $date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
