<?php

namespace App\Controllers\Admin\Surat;

use App\Models\QurbanModel;
use App\Models\RealisasiModel;
use App\Models\PermintaanModel; // Added PermintaanModel
use App\Models\CabangModel;

use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\TemplateProcessor;

class SuratController extends Controller
{
    // Realaisasi kontroler
    public function index()
    {
        $header = [
            'title' => 'Surat Kirim Besek',
            'navbar' => 'surat',
            'active' => 'kirimbesek'
        ];

        $userModel = new RealisasiModel();
        $data['realisasi'] = $userModel->select('realisasi.*, cabang.nama_cabang as cabang')
            ->join('cabang', 'cabang.id = realisasi.cabang_id', 'left')
            ->orderBy('cabang.nama_cabang', 'ASC')
            ->findAll();

        echo view("admin/surat/kirimbesek", $data, $header,);
    }

    public function tambah()
    {
        $model = new PermintaanModel(); // Corrected model
        $data = array(
            'cabang_id' => $this->request->getPost('cabang'),
            'ts' => $this->request->getPost('ts'),
            'tk' => $this->request->getPost('tk'),
            'a' => $this->request->getPost('a'),
            'ok' => $this->request->getPost('ok'),
            'os' => $this->request->getPost('os'),
            'ks' => $this->request->getPost('ks'),
            'kb' => $this->request->getPost('kb'),
            'kks' => $this->request->getPost('kks'),
            'kls' => $this->request->getPost('kls'),
        );
        $model->save($data); // Assuming save method in PermintaanModel
        echo '<script>
                alert("Sukses Tambah Data Permintaan"); // Changed message
                window.location="' . base_url('/kirimbesek') . '"
            </script>';
    }

    public function edit()
    {
        $userModel = new RealisasiModel(); // Changed from QurbanModel to RealisasiModel
        $id = $this->request->getPost('id');
        if (!$id) {
            echo '<script>
                    alert("ID tidak ditemukan.");
                    window.location="' . base_url('/kirimbesek') . '"
                </script>';
            return;
        }
        $data = [
            'r_ts' => $this->request->getPost('r_ts'),
            'r_tk' => $this->request->getPost('r_tk'),
            'r_a' => $this->request->getPost('r_a'),
            'r_ok' => $this->request->getPost('r_ok'),
            'r_os' => $this->request->getPost('r_os'),
            'r_ks' => $this->request->getPost('r_ks'),
            'r_kb' => $this->request->getPost('r_kb'),
            'r_kks' => $this->request->getPost('r_kks'),
            'r_kls' => $this->request->getPost('r_kls'),
            'status' => $this->request->getPost('status'),
            'date_input' => $this->request->getPost('date_input'),
        ];

        $userModel->updateQurban($data, $id);
        echo '<script>
                alert("Sukses Edit Data Realaisasi");
                window.location="' . base_url('/kirimbesek') . '"
            </script>';
    }

    public function hapusrealaisasi($id)
    {
        $model = new QurbanModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Realaisasi");
                window.location="' . base_url('/realisasi') . '"
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

        $userModel = new QurbanModel();
        $data['jadwal'] = $userModel->select('jadwalpengiriman.*, dataqurban.*')
            ->join('dataqurban', 'jadwalpengiriman.cabang = dataqurban.cabang', 'left')
            ->orderBy('dataqurban.cabang', 'ASC')
            ->findAll();

        $keywords = ['H1', 'H2', 'H3'];
        foreach ($keywords as $keyword) {
            $data[strtolower($keyword)] = $userModel->select('jadwalpengiriman.*, dataqurban.*')
                ->join('dataqurban', 'jadwalpengiriman.cabang = dataqurban.cabang', 'left')
                ->like('jadwalpengiriman.kirim_besek', $keyword)
                ->orderBy('jadwalpengiriman.kirim_hewan', 'ASC')
                ->findAll();
        }

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("jadwalpengiriman", $data, $header);
        echo view("pages/footer");
    }

    public function tambahjadwal()
    {
        $model = new QurbanModel();
        $data = array(
            'cabang' => $this->request->getPost('cabang'),
            'antrian' => $this->request->getPost('antrian'),
            'kirim_hewan' => $this->request->getPost('kirim_hewan'),
            'kirim_besek' => $this->request->getPost('kirim_besek'),
        );
        $model->savejadwal($data);
        echo '<script>
                alert("Sukses Tambah Data Jadwal");
                window.location="' . base_url('/jadwal') . '"
            </script>';
    }

    public function editjadwal()
    {
        $model = new QurbanModel();
        $id = $this->request->getPost('id');
        $data = [
            'cabang' => $this->request->getPost('cabang'),
            'antrian' => $this->request->getPost('antrian'),
            'kirim_hewan' => $this->request->getPost('kirim_hewan'),
            'kirim_besek' => $this->request->getPost('kirim_besek'),
        ];

        if (!$id || !is_array($data)) {
            throw new \InvalidArgumentException('Data format is invalid or ID is missing.');
        }

        $model->updatejadwal($data, $id);
        echo '<script>
                alert("Sukses Edit Data Jadwal");
                window.location="' . base_url('/jadwal') . '"
            </script>';
    }

    public function hapusjadwal($id)
    {
        $model = new QurbanModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Jadwal");
                window.location="' . base_url('/jadwal') . '"
            </script>';
    }

    public function exportjadwal()
    {
        $userModel = new QurbanModel();
        $penerimaan = $userModel->select('jadwalpengiriman.*, dataqurban.*')
            ->join('dataqurban', 'jadwalpengiriman.cabang = dataqurban.cabang', 'left')
            ->orderBy('dataqurban.cabang', 'ASC')
            ->findAll();
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
            ->setCellValue('F1', 'Sapi Cabang')
            ->setCellValue('G1', 'kambing Cabang')
            ->setCellValue('H1', 'Kirim Hewan')
            ->setCellValue('I1', 'Kirim Besek');

        $column = 2;
        // tulis data penerimaan ke cell
        foreach ($penerimaan as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no++)
                ->setCellValue('B' . $column, $data['cabang'])
                ->setCellValue('C' . $column, $data['sapi_bumm'])
                ->setCellValue('D' . $column, $data['sapib_bumm'])
                ->setCellValue('E' . $column, $data['kambing_bumm'])
                ->setCellValue('F' . $column, $data['sapi_mandiri'])
                ->setCellValue('G' . $column, $data['kambing_mandiri'])
                ->setCellValue('H' . $column, $data['kirim_hewan'])
                ->setCellValue('I' . $column, $data['kirim_besek']);

            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data jadwal ' . $date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function print($id)
    {
        $userModel = new RealisasiModel();
        $row = $userModel->select('realisasi.*, cabang.nama_cabang as nama_cabang')
            ->join('cabang', 'cabang.id = realisasi.cabang_id', 'left')
            ->find($id);

        if (!$row) {
            return "Data tidak ditemukan.";
        }

        $formatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE, 'Asia/Jakarta');
        $date = $formatter->format(new \DateTime());

        $data = [
            'cabang' => $row['nama_cabang'],
            'ts'     => $row['R_TS'],
            'tk'     => $row['R_TK'],
            'm'      => $row['R_M'],
            'a'      => $row['R_A'],  // Menggunakan R_M untuk baris label 'M' di template
            'os'     => $row['R_OS'],
            'ok'     => $row['R_OK'],
            'ks'     => $row['R_K_S'],
            'kks'    => $row['R_KK_S'],
            'kls'    => $row['R_KLS'],
            'kb'     => $row['R_K_KB'],
            'date'   => $date
        ];

        echo view("admin/surat/templatebesek", $data);
    }

    public function pdf($id)
    {
        $userModel = new RealisasiModel();
        $row = $userModel->select('realisasi.*, cabang.nama_cabang as nama_cabang')
            ->join('cabang', 'cabang.id = realisasi.cabang_id', 'left')
            ->find($id);

        if (!$row) {
            return "Data tidak ditemukan.";
        }

        $formatter = new \IntlDateFormatter('id_ID', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE, 'Asia/Jakarta');
        $date = $formatter->format(new \DateTime());

        $data = [
            'cabang' => $row['nama_cabang'],
            'ts'     => $row['R_TS'],
            'tk'     => $row['R_TK'],
            'a'      => $row['R_M'],
            'os'     => $row['R_OS'],
            'ok'     => $row['R_OK'],
            'ks'     => $row['R_K_S'],
            'kks'    => $row['R_KK_S'],
            'kls'    => $row['R_KLS'],
            'kb'     => $row['R_K_KB'],
            'date'   => $date
        ];

        $html = view("admin/surat/templatebesek", $data);

        $dompdf = new \Dompdf\Dompdf(['isRemoteEnabled' => true]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('F4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Surat_Jalan_" . $row['nama_cabang'] . ".pdf", ["Attachment" => 1]);
    }

    public function permintaan($id)
    {
        // Ambil data berdasarkan ID cabang
        $userModel = new PermintaanModel();
        $cabang = $userModel->find($id); // Asumsi Anda menggunakan ID untuk menemukan data

        if (!$cabang) {
            return 'Cabang tidak ditemukan';
        }

        $data = [
            'cabang' => $cabang['cabang'],  // Misalnya nama cabang
            'ts' => $cabang['ts'],
            'tk' => $cabang['tk'],
            'a' => $cabang['a'],
            'ok' => $cabang['ok'],
            'os' => $cabang['os'],
            'ks' => $cabang['ks'],
            'kb' => $cabang['kb'],
            'kks' => $cabang['kks'],
            'kls' => $cabang['kls'],
        ];

        // Lokasi template
        $templatePath = FCPATH . 'templates/surat-jalan.docx';

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
        $fileName = 'Surat_Jalan_' . $data['cabang'] . '_' . $date . '.docx';

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

    public function hapuspermintaan($id)
    {
        $model = new PermintaanModel();
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Permintaan");
                window.location="' . base_url('/kirimbesek') . '"
            </script>';
    }
}
