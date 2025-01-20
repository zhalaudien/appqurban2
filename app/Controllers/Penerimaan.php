<?php

namespace App\Controllers;
use App\Models\PenerimaanModel;
use App\Models\SapiModel;
use App\Models\CabangModel;
use App\Models\QurbanModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\TemplateProcessor;

class Penerimaan extends Controller
{
    public function index()
    {
        $header = [
            'title' => 'Penerimaan Hewan',
            'navbar' => 'penerimaan',
            'active' => 'penerimaan'
        ];
        $userModel = new PenerimaanModel();
        $data['viewpenerimaan'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['total_sapi_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_sapi_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_kambing_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('kambing')->get()->getRow()->kambing;
        $data['total_kambing_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('kambing')->get()->getRow()->kambing;
        $data['uang_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('pembayaran')->get()->getRow()->pembayaran;
        $data['uang_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('pembayaran')->get()->getRow()->pembayaran;
        $data['shadaqoh'] = $userModel->selectSum('shadaqoh')->get()->getRow()->shadaqoh;

        $cabangModel = new CabangModel();
        $data['viewcabang'] = $cabangModel->orderBy('cabang', 'ASC')->findAll();

        $qurbanModel = new QurbanModel();
        $data['sapi_bumm'] = $qurbanModel->selectSum('sapi_bumm')->get()->getRow()->sapi_bumm;
        $data['sapib_bumm'] = $qurbanModel->selectSum('sapib_bumm')->get()->getRow()->sapib_bumm;
        $data['kambing_bumm'] = $qurbanModel->selectSum('kambing_bumm')->get()->getRow()->kambing_bumm;
        $data['sapi_mandiri'] = $qurbanModel->selectSum('sapi_mandiri')->get()->getRow()->sapi_mandiri;
        $data['kambing_mandiri'] = $qurbanModel->selectSum('kambing_mandiri')->get()->getRow()->kambing_mandiri;

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("penerimaan", $data, $header);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new PenerimaanModel;
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'pengirim' => $this->request->getPost('pengirim'),
            'sapi' => $this->request->getPost('sapi'),
            'kambing' => $this->request->getPost('kambing'),
            'shadaqoh' => $this->request->getPost('shadaqoh'),
            'pembayaran' => $this->request->getPost('pembayaran'),
        );
        $model->save($data);
        echo '<script>
                alert("Sukses Tambah Data Penerimaan");
                window.location="'.base_url('penerimaan').'"
            </script>';
    }

    public function edit()
    {
        $model = new PenerimaanModel;
        $id = $this->request->getPost('id');
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'pengirim' => $this->request->getPost('pengirim'),
            'sapi' => $this->request->getPost('sapi'),
            'kambing' => $this->request->getPost('kambing'),
            'shadaqoh' => $this->request->getPost('shadaqoh'),
            'pembayaran' => $this->request->getPost('pembayaran'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Penerimaan");
                window.location="'.base_url('penerimaan').'"
            </script>';
    }

    public function hapus($id = null)
    {
        $model = new PenerimaanModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Penerimaan");
                window.location="'.base_url('penerimaan').'"
            </script>';
    }

    public function export()
    {
        $userModel = new PenerimaanModel();
        $penerimaan = $userModel->orderBy('date_input', 'DESC')->findAll();
        $no = 1;
        $date = date('d-m-Y H:i:s');

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Cabang')
                    ->setCellValue('C1', 'Pengirim')
                    ->setCellValue('D1', 'Sapi')
                    ->setCellValue('E1', 'Kambing')
                    ->setCellValue('F1', 'Shadaqoh')
                    ->setCellValue('G1', 'Pembayaran')
                    ->setCellValue('H1', 'Tanggal Input');
        
        $column = 2;
        // tulis data penerimaan ke cell
        foreach($penerimaan as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data['cabang'])
                        ->setCellValue('C' . $column, $data['pengirim'])
                        ->setCellValue('D' . $column, $data['sapi'])
                        ->setCellValue('E' . $column, $data['kambing'])
                        ->setCellValue('F' . $column, $data['shadaqoh'])
                        ->setCellValue('G' . $column, $data['pembayaran'])
                        ->setCellValue('H' . $column, $data['date_input']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data penerimaan '.$date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function print($id)
    {
        // Ambil data berdasarkan ID cabang
        $userModel = new PenerimaanModel();
        $cabang = $userModel->find($id); // Asumsi Anda menggunakan ID untuk menemukan data

        if (!$cabang) {
            return 'Cabang tidak ditemukan';
        }

        $data = [
            'id' => $cabang['id'],  // Misalnya nama cabang
            'cabang' => $cabang['cabang'],
            'pengirim' => $cabang['pengirim'],
            'sapi' => $cabang['sapi'],
            'kambing' => $cabang['kambing'],
            'shadaqoh' => 'Rp. ' . number_format($cabang['shadaqoh'], 0, ',', '.'),
            'pembayaran' => 'Rp. ' . number_format($cabang['pembayaran'], 0, ',', '.'),
        ];

        // Lokasi template
        $templatePath = FCPATH . 'templates/nota.docx';

        // Cek apakah template ada
        if (!file_exists($templatePath)) {
            return 'Template file tidak ditemukan.';
        }

        // Memuat template Word
        try {
            $templateProcessor = new TemplateProcessor($templatePath);
        } catch (\Exception $e) {
            log_message('error', 'Error saat memuat template: ' . $e->getMessage());
            return 'Terjadi kesalahan saat memuat template.';
        }

        // Ganti placeholder dengan data
        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }
        
        $formatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE, 'Asia/Jakarta');
        $date = $formatter->format(new \DateTime()); // Format tanggal Indonesia
        $templateProcessor->setValue('date', $date);

        // Nama file Word yang akan diunduh
        $date = date('Y-m-d_H-i-s');
        $fileName = 'Nota_' . $data['cabang'] . '_' . $date . '.docx';

        // Output file Word
        ob_start();
        $templateProcessor->saveAs("php://output");
        $content = ob_get_clean();

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        echo $content;
        exit;
    }

    public function datasapi()
    {
        $header = [
            'title' => 'Data Sapi',
            'navbar' => 'penerimaan',
            'active' => 'datasapi'
        ];

        $userModel = new SapiModel();
        $data['viewsapi'] = $userModel->orderBy('date_input', 'DESC')->findAll();

        $userModel = new CabangModel();
        $data['viewcabang'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("datasapi", $data, $header);
        echo view("pages/footer");
    }

    public function tambahdatasapi()
    {
        $model = new SapiModel;
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'harga' => $this->request->getPost('harga'),
            'berat' => $this->request->getPost('berat'),
            'nomor' => $this->request->getPost('nomor'),
        );
        $model->save($data);
        echo '<script>
                alert("Sukses Tambah Data Sapi");
                window.location="'.base_url('datasapi').'"
            </script>';
    }

    public function editdatasapi()
    {
        $model = new SapiModel;
        $id = $this->request->getPost('id');
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'harga' => $this->request->getPost('harga'),
            'berat' => $this->request->getPost('berat'),
            'nomor' => $this->request->getPost('nomor'),
        );
        $model->update($id, $data);
        echo '<script>
                alert("Sukses Edit Data Sapi");
                window.location="'.base_url('datasapi').'"
            </script>';
    }

    public function hapusdatasapi($id = null)
    {
        $model = new SapiModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Sapi");
                window.location="'.base_url('datasapi').'"
            </script>';
    }

    public function exportdatasapi()
    {
        $userModel = new SapiModel();
        $sapi = $userModel->orderBy('date_input', 'DESC')->findAll();
        $no = 1;
        $date = date('d-m-Y H:i:s');

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Cabang')
                    ->setCellValue('C1', 'Berat')
                    ->setCellValue('D1', 'Nomor Sapi')
                    ->setCellValue('E1', 'Harga')
                    ->setCellValue('F1', 'Tanggal Input');
        
        $column = 2;
        // tulis data sapi ke cell
        foreach($sapi as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $column, $no++)
                        ->setCellValue('B' . $column, $data['cabang'])
                        ->setCellValue('C' . $column, $data['berat'])
                        ->setCellValue('D' . $column, $data['nomor'])
                        ->setCellValue('E' . $column, $data['harga'])
                        ->setCellValue('F' . $column, $data['date_input']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data sapi '.$date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName.'.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}