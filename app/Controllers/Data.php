<?php

namespace App\Controllers;
use App\Models\PanitiaModel;
use App\Models\CabangModel;
use App\Models\MuspikaModel;
use CodeIgniter\Controller;
use App\Models\IdpantiaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Data extends Controller
{
    public function index()
    {
        $userModel = new PanitiaModel();
        $idPanitia = new IdpantiaModel();
        $data['viewpanitia'] = $userModel->orderBy('nama', 'ASC')->findAll();
        $data['idpanitia'] = $idPanitia->orderBy('seksi', 'ASC')->findAll();

        $header = [
            'title' => 'Data Panitia',
            'navbar' => 'data',
            'active' => 'panitia'
        ];
      
        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("datapanitia", $data, $header);
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

    public function indexcabang()
    {
        $userModel = new CabangModel();
        $data['viewcabang'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        $header = [
            'title' => 'Data Cabang',
            'navbar' => 'data',
            'active' => 'cabang'
        ];
        
        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("datacabang", $data, $header);
        echo view("pages/footer");
    }

    public function tambahcabang()
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

    public function editcabang()
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

    public function hapuscabang($id = null)
    {
        $model = new CabangModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Cabang");
                window.location="'.base_url('cabang').'"
            </script>';
    }

    public function exportcabang()
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

    public function muspika()
    {
        $header = [
            'title' => 'Data Muspika',
            'navbar' => 'data',
            'active' => 'muspika'
        ];

        $userModel = new MuspikaModel();
        $data['viewmuspika'] = $userModel->orderBy('nama', 'ASC')->findAll();
        
        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("datamuspika", $data, $header);
        echo view("pages/footer");
    }

    public function tambahmuspika()
    {
        $model = new MuspikaModel;
        $data = array(
            'id'     => $this->request->getPost('id'),
            'nama'   => $this->request->getPost('nama'),
            'dinas'  => $this->request->getPost('dinas'),
            'pj'     => $this->request->getPost('pj'),
        );
        $model->saveMuspika($data);
        echo '<script>
                alert("Sukses Tambah Data Muspika");
                window.location="'.base_url('muspika').'"
            </script>';
    }

    public function editmuspika()
    {
        $model = new MuspikaModel;
        $id = $this->request->getPost('id');
        $data = array(
            'nama'   => $this->request->getPost('nama'),
            'dinas'  => $this->request->getPost('dinas'),
            'pj'     => $this->request->getPost('pj'),
        );
        $model->updateMuspika($data, $id);
        echo '<script>
                alert("Sukses Edit Data Muspika");
                window.location="'.base_url('muspika').'"
            </script>';
    }

    public function hapusmuspika($id = null)
    {
        $model = new MuspikaModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Muspika");
                window.location="'.base_url('muspika').'"
            </script>';
    }

    public function exportmuspika()
    {
        $userModel = new MuspikaModel();
        $muspika = $userModel->orderBy('nama', 'ASC')->findAll();
        $no = 1;
        $date = date('d-m-Y');

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Nama')
                    ->setCellValue('C1', 'Dinas')
                    ->setCellValue('D1', 'PJ');
        
        $column = 2;
        // tulis data mobil ke cell
        foreach($muspika as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data['nama'])
                        ->setCellValue('C' . $column, $data['dinas'])
                        ->setCellValue('D' . $column, $data['pj']);
            $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Muspika '.$date;
    
        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }
}