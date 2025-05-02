<?php

namespace App\Controllers;

use App\Models\BesekModel;
use CodeIgniter\Controller;
use App\Models\QurbanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\RealisasiModel;

class Besek extends Controller
{
    public function index()

    {
        $header = [
            'title' => 'Data Besek',
            'navbar' => 'besek',
            'active' => 'besek'
        ];

        $userModel = new BesekModel();
        $data['viewbesek'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['ts'] = $userModel->selectSum('ts')->get()->getRow()->ts;
        $data['tk'] = $userModel->selectSum('tk')->get()->getRow()->tk;
        $data['a'] = $userModel->selectSum('a')->get()->getRow()->a;
        $data['os'] = $userModel->selectSum('os')->get()->getRow()->os;
        $data['ok'] = $userModel->selectSum('ok')->get()->getRow()->ok;

        $userModel = new QurbanModel();
        $data['t_ts'] = $userModel->where('status', 'Dikirim')->selectSum('r_ts')->get()->getRow()->r_ts;
        $data['t_tk'] = $userModel->where('status', 'Dikirim')->selectSum('r_tk')->get()->getRow()->r_tk;
        $data['t_a'] = $userModel->where('status', 'Dikirim')->selectSum('r_a')->get()->getRow()->r_a;
        $data['t_os'] = $userModel->where('status', 'Dikirim')->selectSum('r_os')->get()->getRow()->r_os;
        $data['t_ok'] = $userModel->where('status', 'Dikirim')->selectSum('r_ok')->get()->getRow()->r_ok;

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("besek", $data, $header);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new BesekModel;
        $data = array(
            'ts' => $this->request->getPost('ts'),
            'tk' => $this->request->getPost('tk'),
            'a' => $this->request->getPost('a'),
            'os' => $this->request->getPost('os'),
            'ok' => $this->request->getPost('ok'),
        );
        $model->save($data);
        echo '<script>
                alert("Sukses Tambah Data Besek");
                window.location="' . base_url('besek') . '"
            </script>';
    }

    public function edit()
    {
        $model = new BesekModel;
        $id = $this->request->getPost('id');
        $data = array(
            'ts' => $this->request->getPost('ts'),
            'tk' => $this->request->getPost('tk'),
            'a' => $this->request->getPost('a'),
            'os' => $this->request->getPost('os'),
            'ok' => $this->request->getPost('ok'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Besek");
                window.location="' . base_url('besek') . '"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new BesekModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Besek");
                window.location="' . base_url('besek') . '"
            </script>';
    }

    public function export()
    {
        $model = new BesekModel();
        $data = $model->findAll();
        $date = date('Y-m-d');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'TS');
        $sheet->setCellValue('C1', 'TK');
        $sheet->setCellValue('D1', 'M');
        $sheet->setCellValue('E1', 'OS');
        $sheet->setCellValue('F1', 'OK');
        $sheet->setCellValue('G1', 'Date Input');

        // Populate the data
        $row = 2;
        $no = 1;

        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $item['ts']);
            $sheet->setCellValue('C' . $row, $item['tk']);
            $sheet->setCellValue('D' . $row, $item['a']);
            $sheet->setCellValue('E' . $row, $item['os']);
            $sheet->setCellValue('F' . $row, $item['ok']);
            $sheet->setCellValue('G' . $row, $item['date_input']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Besek ' . $date;

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
