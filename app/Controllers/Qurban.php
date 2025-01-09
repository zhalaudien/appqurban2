<?php

namespace App\Controllers;
use App\Models\QurbanModel;
use App\Models\AmparahModel;
use App\Models\JadwalModel;
use App\Models\RealisasiModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Qurban extends Controller
{
    public function index()
    {
        $header = [
            'title' => 'Data Qurban Cabang',
            'navbar' => 'qurban',
            'active' => 'qurban'
        ];

        $userModel = new QurbanModel();
        $data['qurban'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("qurbancabang", $data, $header);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new QurbanModel;
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'sapi_bumm' => $this->request->getPost('sapi_bumm'),
            'sapib_bumm' => $this->request->getPost('sapib_bumm'),
            'kambing_bumm' => $this->request->getPost('kambing_bumm'),
            'sapi_mandiri' => $this->request->getPost('sapi_mandiri'),
            'kambing_mandiri' => $this->request->getPost('kambing_mandiri'),
        );
        $model->savesaveQurban($data);
        echo '<script>
                alert("Sukses Tambah Data Qurban");
                window.location="'.base_url('qurban').'"
            </script>';
    }

    public function edit()
    {
        $model = new QurbanModel;
        $id = $this->request->getPost('id');
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'sapi_bumm' => $this->request->getPost('sapi_bumm'),
            'sapib_bumm' => $this->request->getPost('sapib_bumm'),
            'kambing_bumm' => $this->request->getPost('kambing_bumm'),
            'sapi_mandiri' => $this->request->getPost('sapi_mandiri'),
            'kambing_mandiri' => $this->request->getPost('kambing_mandiri'),
        );
        $model->updateQurban($id, $data);
        echo '<script>
                alert("Sukses Edit Data Qurban");
                window.location="'.base_url('qurban').'"
            </script>';
    }

    public function hapus($id)
    {
        $model = new QurbanModel;
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Qurban");
                window.location="'.base_url('qurban').'"
            </script>';
    }

    public function export()
    {
        $model = new QurbanModel();
        $penerimaan = $model->orderBy('cabang', 'ASC')->findAll();
        $no = 1;
        $date = date('d-m-Y H:i:s');

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Cabang')
                    ->setCellValue('C1', 'Sapi BUMM')
                    ->setCellValue('D1', 'Sapi BUMM orang')
                    ->setCellValue('E1', 'Kambing BUMM')
                    ->setCellValue('F1', 'Sapi Mandiri')
                    ->setCellValue('G1', 'kambing Mandiri')
                    ->setCellValue('H1', 'Tanggal Input');
        
        $column = 2;
        // tulis data penerimaan ke cell
        foreach($penerimaan as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data['cabang'])
                        ->setCellValue('C' . $column, $data['sapi_bumm'])
                        ->setCellValue('D' . $column, $data['sapib_bumm'])
                        ->setCellValue('E' . $column, $data['kambing_bumm'])
                        ->setCellValue('F' . $column, $data['sapi_mandiri'])
                        ->setCellValue('G' . $column, $data['kambing_mandiri'])
                        ->setCellValue('H' . $column, $data['date_input']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data qurban '.$date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    // Amprah kontroler
    public function amprah()
    {
        $header = [
            'title' => 'Data Amprah Cabang',
            'navbar' => 'qurban',
            'active' => 'amprah'
        ];
        $userModel = new AmparahModel();
        $data['amprah'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("amprahbesek", $data, $header);
        echo view("pages/footer");
    }

    public function tambahamprah()
    {
        $model = new AmparahModel();
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'p_ts' => $this->request->getPost('p_ts'),
            'p_tk' => $this->request->getPost('p_tk'),
            'p_a' => $this->request->getPost('p_a'),
            'p_ok' => $this->request->getPost('p_ok'),
            'p_os' => $this->request->getPost('p_os'),
            'p_ks' => $this->request->getPost('p_ks'),
            'p_kb' => $this->request->getPost('p_kb'),
            'p_kks' => $this->request->getPost('p_kks'),
            'p_kls' => $this->request->getPost('p_kls'),
            'p_info' => $this->request->getPost('info'),
        );
        $model->saveamprah($data);
        echo '<script>
                alert("Sukses Tambah Data Amprah");
                window.location="'.base_url('/amprah').'"
            </script>';
    }

    public function editamprah()
    {
        $model = new AmparahModel();
        $id = $this->request->getPost('id');
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'p_ts' => $this->request->getPost('p_ts'),
            'p_tk' => $this->request->getPost('p_tk'),
            'p_a' => $this->request->getPost('p_a'),
            'p_ok' => $this->request->getPost('p_ok'),
            'p_os' => $this->request->getPost('p_os'),
            'p_ks' => $this->request->getPost('p_ks'),
            'p_kb' => $this->request->getPost('p_kb'),
            'p_kks' => $this->request->getPost('p_kks'),
            'p_kls' => $this->request->getPost('p_kls'),
            'info' => $this->request->getPost('info'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Amprah");
                window.location="'.base_url('/amprah').'"
            </script>';
    }

    public function hapusamprah($id)
    {
        $model = new AmparahModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Amprah");
                window.location="'.base_url('/amprah').'"
            </script>';
    }

    public function exportamprah()
    {
        $model = new AmparahModel();
        $penerimaan = $model->orderBy('cabang', 'ASC')->findAll();
        $no = 1;
        $date = date('d-m-Y H:i:s');

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Cabang')
                    ->setCellValue('C1', 'TS')
                    ->setCellValue('D1', 'TK')
                    ->setCellValue('E1', 'A')
                    ->setCellValue('F1', 'OK')
                    ->setCellValue('G1', 'OS')
                    ->setCellValue('H1', 'KS')
                    ->setCellValue('I1', 'KB')
                    ->setCellValue('J1', 'KKS')
                    ->setCellValue('K1', 'KLS')
                    ->setCellValue('L1', 'Tanggal Input');
        
        $column = 2;
        // tulis data penerimaan ke cell
        foreach($penerimaan as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data['cabang'])
                        ->setCellValue('C' . $column, $data['ts'])
                        ->setCellValue('D' . $column, $data['tk'])
                        ->setCellValue('E' . $column, $data['a'])
                        ->setCellValue('F' . $column, $data['ok'])
                        ->setCellValue('G' . $column, $data['os'])
                        ->setCellValue('H' . $column, $data['ks'])
                        ->setCellValue('I' . $column, $data['kb'])
                        ->setCellValue('J' . $column, $data['kks'])
                        ->setCellValue('K' . $column, $data['kls'])
                        ->setCellValue('L' . $column, $data['date_input']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data amprah '.$date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    // Realaisasi kontroler
    public function realisasi()
    {
        $header = [
            'title' => 'Data Realisasi Cabang',
            'navbar' => 'qurban',
            'active' => 'realisasi'
        ];

        $userModel = new RealisasiModel();
        $data['realisasi'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("realisasibesek", $data, $header);
        echo view("pages/footer");
    }

    public function tambahrealaisasi()
    {
        $model = new RealisasiModel();
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'ts' => $this->request->getPost('ts'),
            'tk' => $this->request->getPost('tk'),
            'a' => $this->request->getPost('a'),
            'ok' => $this->request->getPost('ok'),
            'os' => $this->request->getPost('os'),
            'ks' => $this->request->getPost('ks'),
            'kb' => $this->request->getPost('kb'),
            'kks' => $this->request->getPost('kks'),
            'kls' => $this->request->getPost('kls'),
            'realisasi' => $this->request->getPost('realisasi'),
        );
        $model->save($data);
        echo '<script>
                alert("Sukses Tambah Data Realaisasi");
                window.location="'.base_url('/realisasi').'"
            </script>';
    }

    public function editrealisasi()
    {
        $model = new RealisasiModel();
        $id = $this->request->getPost('id');
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'ts' => $this->request->getPost('ts'),
            'tk' => $this->request->getPost('tk'),
            'a' => $this->request->getPost('a'),
            'ok' => $this->request->getPost('ok'),
            'os' => $this->request->getPost('os'),
            'ks' => $this->request->getPost('ks'),
            'kb' => $this->request->getPost('kb'),
            'kks' => $this->request->getPost('kks'),
            'kls' => $this->request->getPost('kls'),
            'realisasi' => $this->request->getPost('realisasi'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Realaisasi");
                window.location="'.base_url('/realisasi').'"
            </script>';
    }

    public function hapusrealaisasi($id)
    {
        $model = new RealisasiModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Realaisasi");
                window.location="'.base_url('/realisasi').'"
            </script>';
    }

    // Jadwal kontroler
    public function jadwal()
    {
        $header = [
            'title' => 'Jadwal Pengiriman Cabang',
            'navbar' => 'qurban',
            'active' => 'jadwal'
        ];
        
        $userModel = new JadwalModel();
        $jadwal = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar");
        echo view("jadwalpengiriman", $jadwal, $header);
        echo view("pages/footer");
    }
}