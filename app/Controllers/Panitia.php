<?php

namespace App\Controllers;
use App\Models\PanitiaModel;
use CodeIgniter\Controller;
use App\Models\IdpantiaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Panitia extends Controller
{
    public function index()
    {
        $userModel = new PanitiaModel();
        $idPanitia = new IdpantiaModel();
        $data['viewpanitia'] = $userModel->orderBy('nama', 'ASC')->findAll();
        $data['idpanitia'] = $idPanitia->orderBy('seksi', 'ASC')->findAll();
      
        echo view("pages/header");
        echo view("pages/navbar");
        echo view("datapanitia", $data);
        echo view("pages/footer");

    }

    public function tambah()
    {
        $model = new PanitiaModel;
        $data = array(
            'id'     => $this->request->getPost('id'),
            'nama'   => $this->request->getPost('nama'),
            'cabang' => $this->request->getPost('cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'seksi'  => $this->request->getPost('seksi'),
            'ket'    => $this->request->getPost('ket')
        );
        $model->savePanitia($data);
        echo '<script>
                alert("Sukses Tambah Data Panitia");
                window.location="'.base_url('panitia').'"
            </script>';
    }


    public function edit()
    {
        $model = new PanitiaModel;
        $id = $this->request->getPost('id');
        $data = array(
            'nama'   => $this->request->getPost('nama'),
            'cabang' => $this->request->getPost('cabang'),
            'no_hp'  => $this->request->getPost('no_hp'),
            'seksi'  => $this->request->getPost('seksi'),
            'ket'    => $this->request->getPost('ket')
        );
        $model->updatePanitia($data, $id);
        echo '<script>
                alert("Sukses Edit Data Panitia");
                window.location="'.base_url('panitia').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new PanitiaModel;
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Panitia");
                window.location="'.base_url('panitia').'"
            </script>';
    }

    public function export()
    {
        $userModel = new PanitiaModel();
        $panitia = $userModel->orderBy('nama', 'ASC')->findAll();
        $no = 1;
        $date = date('Y-m-d H:i:s');

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Cabang')
                    ->setCellValue('D1', 'No HP')
                    ->setCellValue('E1', 'Seksi')
                    ->setCellValue('F1', 'Ket');
        
        $column = 2;
        // tulis data mobil ke cell
        foreach($panitia as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data['nama'])
                        ->setCellValue('C' . $column, $data['cabang'])
                        ->setCellValue('D' . $column, $data['no_hp'])
                        ->setCellValue('E' . $column, $data['seksi'])
                        ->setCellValue('F' . $column, $data['ket']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Panitia '.$date;
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');

    }
}