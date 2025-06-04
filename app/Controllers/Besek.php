<?php

namespace App\Controllers;

use App\Models\BesekModel;
use CodeIgniter\Controller;
use App\Models\QurbanModel;
use App\Models\PermintaanModel;
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

        // Load semua data besek
        $besekModel = new BesekModel();
        $data['viewbesek'] = $besekModel->orderBy('date_input', 'DESC')->findAll();

        $today = date('Y-m-d');

        // Data Qurban yang Dikirim Hari Ini
        $qurbanModel = new QurbanModel();
        $kirim_today = $qurbanModel
            ->where('DATE(date_input)', $today)
            ->where('status', 'Dikirim')
            ->selectSum('r_ts')
            ->selectSum('r_tk')
            ->selectSum('r_a')
            ->selectSum('r_os')
            ->selectSum('r_ok')
            ->first();

        $data['kirim_ts'] = $kirim_today['r_ts'] ?? 0;
        $data['kirim_tk'] = $kirim_today['r_tk'] ?? 0;
        $data['kirim_a']  = $kirim_today['r_a']  ?? 0;
        $data['kirim_os'] = $kirim_today['r_os'] ?? 0;
        $data['kirim_ok'] = $kirim_today['r_ok'] ?? 0;

        // Data permintaa yang Dikirim Hari Ini
        $qurbanModel = new PermintaanModel();
        $kirim_permintaan = $qurbanModel
            ->where('DATE(date_input)', $today)
            ->selectSum('ts')
            ->selectSum('tk')
            ->selectSum('a')
            ->selectSum('os')
            ->selectSum('ok')
            ->first();

        $data['permintaan_ts'] = $kirim_permintaan['ts'] ?? 0;
        $data['permintaan_tk'] = $kirim_permintaan['tk'] ?? 0;
        $data['permintaan_a']  = $kirim_permintaan['a']  ?? 0;
        $data['permintaan_os'] = $kirim_permintaan['os'] ?? 0;
        $data['permintaan_ok'] = $kirim_permintaan['ok'] ?? 0;

        // Data Besek Hari Ini
        $besek_today = $besekModel
            ->where('DATE(date_input)', $today)
            ->selectSum('ts')
            ->selectSum('tk')
            ->selectSum('a')
            ->selectSum('os')
            ->selectSum('ok')
            ->first();

        $data['today_ts']  = $besek_today['ts'] ?? 0;
        $data['today_tk']  = $besek_today['tk'] ?? 0;
        $data['today_a']   = $besek_today['a'] ?? 0;
        $data['today_os']  = $besek_today['os'] ?? 0;
        $data['today_ok']  = $besek_today['ok'] ?? 0;

        // Data Total Produksi besek
        $total = $besekModel
            ->selectSum('ts')
            ->selectSum('tk')
            ->selectSum('a')
            ->selectSum('os')
            ->selectSum('ok')
            ->first();

        $data['total_ts']  = $total['ts'] ?? 0;
        $data['total_tk']  = $total['tk'] ?? 0;
        $data['total_a']   = $total['a'] ?? 0;
        $data['total_os']  = $total['os'] ?? 0;
        $data['total_ok']  = $total['ok'] ?? 0;

        $data['total_besek'] = $data['total_ts'] + $data['total_tk'] + $data['total_os'] + $data['total_ok'] + $data['total_a'];

        // Load views
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
