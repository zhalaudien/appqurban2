<?php

namespace App\Controllers;
use App\Models\CabangModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cabang extends Controller
{
    public function index()
    {
        $userModel = new CabangModel();
        $data['viewcabang'] = $userModel->orderBy('cabang', 'ASC')->findAll();
        
        echo view("pages/header");
        echo view("pages/navbar");
        echo view("datacabang", $data);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new CabangModel;
        $data = array(
            'id'     => $this->request->getPost('id'),
            'cabang' => $this->request->getPost('cabang'),
            'ketua_cabang' => $this->request->getPost('ketua_cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'panitia_qurban' => $this->request->getPost('panitia_qurban'),
            'no2_hp'  => $this->request->getPost('no2_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'perwakilan' => $this->request->getPost('perwakilan')
        );
        $model->saveCabang($data);
        echo '<script>
                alert("Sukses Tambah Data Cabang");
                window.location="'.base_url('cabang').'"
            </script>';
    }

    public function edit()
    {
        $model = new CabangModel;
        $id = $this->request->getPost('id');
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'ketua_cabang' => $this->request->getPost('ketua_cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'panitia_qurban' => $this->request->getPost('panitia_qurban'),
            'no2_hp'  => $this->request->getPost('no2_hp'),
            'alamat' => $this->request->getPost('alamat'),
            'perwakilan' => $this->request->getPost('perwakilan')
        );
        $model->updateCabang($data, $id);
        echo '<script>
                alert("Sukses Edit Data Cabang");
                window.location="'.base_url('cabang').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new CabangModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Cabang");
                window.location="'.base_url('cabang').'"
            </script>';
    }

    public function export()
    {
        $userModel = new CabangModel();
        $cabang = $userModel->orderBy('cabang', 'ASC')->findAll();
        $no = 1;
        $date = date('d-m-Y');

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama Cabang')
                    ->setCellValue('C1', 'Ketua Cabang')
                    ->setCellValue('D1', 'No HP')
                    ->setCellValue('E1', 'Panitia Qurban')
                    ->setCellValue('F1', 'No HP')
                    ->setCellValue('G1', 'Alamat')
                    ->setCellValue('H1', 'Perwakilan');
        
        $column = 2;
        // tulis data mobil ke cell
        foreach($cabang as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data['cabang']) 
                        ->setCellValue('C' . $column, $data['ketua_cabang'])
                        ->setCellValue('D' . $column, $data['no_hp'])
                        ->setCellValue('E' . $column, $data['panitia_qurban'])
                        ->setCellValue('F' . $column, $data['no2_hp'])
                        ->setCellValue('G' . $column, $data['alamat'])
                        ->setCellValue('H' . $column, $data['perwakilan']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Panitia '.$date;
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }
}