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

        $userModel = new PenerimaanModel();
        $data['total_sapi'] = $userModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_kambing'] = $userModel->selectSum('kambing')->get()->getRow()->kambing;

        $userModel = new KandangModel();
        $data['viewkandang'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['disembelih_sapi'] = $userModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['disembelih_kambing'] = $userModel->selectSum('kambing')->get()->getRow()->kambing;

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("kandang", $data, $header);
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
                window.location="'.base_url('kandang').'"
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
                window.location="'.base_url('kandang').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new KandangModel();
        $data['kandang'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Kandang");
                window.location="'.base_url('kandang').'"
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
        $fileName = 'Data kandang '.$date;
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
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

        $userModel = new RealisasiModel();
        $data['t_ks'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('ks')->get()->getRow()->ks;
        $data['t_kb'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('kb')->get()->getRow()->kb;
        $data['t_kks'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('kks')->get()->getRow()->kks;
        $data['t_kls'] = $userModel->where('info_kirim', 'Dikirim')->selectSum('kls')->get()->getRow()->kls;

        $userModel = new K3Model();
        $data['viewk3'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['ks'] = $userModel->selectSum('ks')->get()->getRow()->ks;
        $data['kb'] = $userModel->selectSum('kb')->get()->getRow()->kb;
        $data['kks'] = $userModel->selectSum('kks')->get()->getRow()->kks;
        $data['kls'] = $userModel->selectSum('kls')->get()->getRow()->kls;


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
                window.location="'.base_url('k3').'"
            </script>';
    }

    public function editk3()
    {
        $model = new K3Model;
        $id = $this->request->getPost('id');
        $data = array(
            'kepala_sapi' => $this->request->getPost('kepala_sapi'),
            'kepala_kambing' => $this->request->getPost('kepala_kambing'),
            'kulit_kambing' => $this->request->getPost('kulit_kambing'),
            'kulit_sapi' => $this->request->getPost('kulit_sapi'),
            'kaki_sapi' => $this->request->getPost('kaki_sapi'),
        );
        $model->updatek3($id, $data);
        echo '<script>
                alert("Sukses Edit Data K3");
                window.location="'.base_url('k3').'"
            </script>';
    }

    public function hapusk3($id = null)
    {
        $model = new K3Model();
        $data['k3'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data K3");
                window.location="'.base_url('k3').'"
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
            ->setCellValue('G1', 'Kaki Sapi');

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
                ->setCellValue('G' . $column, $row['kaki_sapi']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data k3 '.$date;
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }
}