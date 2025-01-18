<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KulitModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\TemplateProcessor;

class Kulit extends Controller
{
        public function index()
    {
        $header = [
            'title' => 'Surat Kirim Kulit',
            'navbar' => 'surat',
            'active' => 'kirimkulit'
        ];

        $userModel = new KulitModel();
        $data['kirimkulit'] = $userModel->orderBy('date_input', 'DESC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("kirimkulit", $data, $header,);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new KulitModel();
        $data = array(
            'jumlah' => $this->request->getPost('jumlah'),
        );
        $model->savekulit($data);
        echo '<script>
                alert("Sukses Tambah Data Realaisasi");
                window.location="'.base_url('/kirimkulit').'"
            </script>';
    }

    public function hapus($id)
    {
        $model = new KulitModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Kulit");
                window.location="'.base_url('/kirimkulit').'"
            </script>';
    }

    public function printsurat($id)
    {
        // Ambil data berdasarkan ID cabang
        $userModel = new KulitModel();
        $cabang = $userModel->find($id); // Asumsi Anda menggunakan ID untuk menemukan data

        if (!$cabang) {
            return 'Data Tidak ditemukan';
        }

        $data = [
            'kulit' => $cabang['jumlah'],  // Misalnya nama cabang
        ];

        // Lokasi template
        $templatePath = FCPATH . 'templates/surat-kulit.docx';

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
        $fileName = 'Surat_Jalan_Kulit_'. $date . '.docx';

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
}