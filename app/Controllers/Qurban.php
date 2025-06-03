<?php

namespace App\Controllers;

use App\Models\QurbanModel;
use App\Models\SettingModel;
use App\Models\CabangModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Brick\Math\BigRational;
use Brick\Math\BigInteger;

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

        $userModel = new CabangModel();
        $data['viewcabang'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("qurbancabang", $data, $header);
        echo view("pages/footer");
    }

    public function tambah()
    {
        $model = new QurbanModel;

        $cabang = $this->request->getPost('cabang');

        // Cek apakah nama cabang sudah ada
        $existing = $model->where('cabang', $cabang)->first();

        if ($existing) {
            // Jika sudah ada, tampilkan pesan error
            echo '<script>
                alert("Gagal: Nama cabang sudah ada!");
                window.location="' . base_url('qurban') . '"
              </script>';
            return;
        }

        // Jika belum ada, simpan data
        $data = array(
            'cabang' => $cabang,
            'sapi_bumm' => $this->request->getPost('sapi_bumm'),
            'sapib_bumm' => $this->request->getPost('sapib_bumm'),
            'kambing_bumm' => $this->request->getPost('kambing_bumm'),
            'sapi_mandiri' => $this->request->getPost('sapi_mandiri'),
            'kambing_mandiri' => $this->request->getPost('kambing_mandiri'),
        );

        $model->saveQurban($data);
        echo '<script>
            alert("Sukses Tambah Data Qurban");
            window.location="' . base_url('qurban') . '"
          </script>';
    }

    public function edit()
    {
        $model = new QurbanModel;
        $id = $this->request->getPost('id');
        $data = array(
            'sapi_bumm' => $this->request->getPost('sapi_bumm'),
            'sapib_bumm' => $this->request->getPost('sapib_bumm'),
            'kambing_bumm' => $this->request->getPost('kambing_bumm'),
            'sapi_mandiri' => $this->request->getPost('sapi_mandiri'),
            'kambing_mandiri' => $this->request->getPost('kambing_mandiri'),
        );
        $model->updateQurban($data, $id);
        echo '<script>
                alert("Sukses Edit Data Qurban");
                window.location="' . base_url('qurban') . '"
            </script>';
    }

    public function hapus($id)
    {
        $model = new QurbanModel;
        $data['user'] = $model->where('id', $id)->delete($id);
        echo '<script>
                alert("Sukses Hapus Data Qurban");
                window.location="' . base_url('qurban') . '"
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
            ->setCellValue('H1', 'P_TS')
            ->setCellValue('I1', 'P_TK')
            ->setCellValue('J1', 'P_A')
            ->setCellValue('K1', 'P_OK')
            ->setCellValue('L1', 'P_OS')
            ->setCellValue('M1', 'P_KS')
            ->setCellValue('N1', 'P_KB')
            ->setCellValue('O1', 'P_KKS')
            ->setCellValue('P1', 'P_KLS')
            ->setCellValue('Q1', 'TS')
            ->setCellValue('R1', 'TK')
            ->setCellValue('S1', 'A')
            ->setCellValue('T1', 'OK')
            ->setCellValue('U1', 'OS')
            ->setCellValue('V1', 'KS')
            ->setCellValue('W1', 'KB')
            ->setCellValue('X1', 'KKS')
            ->setCellValue('Y1', 'KLS')
            ->setCellValue('Z1', 'ANTRIAN')
            ->setCellValue('AA1', 'KIRIM HEWAN')
            ->setCellValue('AB1', 'KIRIM BESEK')
            ->setCellValue('AC1', 'Tanggal Input');

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
                ->setCellValue('H' . $column, $data['p_ts'])
                ->setCellValue('I' . $column, $data['p_tk'])
                ->setCellValue('J' . $column, $data['p_a'])
                ->setCellValue('K' . $column, $data['p_ok'])
                ->setCellValue('L' . $column, $data['p_os'])
                ->setCellValue('M' . $column, $data['p_ks'])
                ->setCellValue('N' . $column, $data['p_kb'])
                ->setCellValue('O' . $column, $data['p_kks'])
                ->setCellValue('P' . $column, $data['p_kls'])
                ->setCellValue('Q' . $column, $data['r_ts'])
                ->setCellValue('R' . $column, $data['r_tk'])
                ->setCellValue('S' . $column, $data['r_a'])
                ->setCellValue('T' . $column, $data['r_ok'])
                ->setCellValue('Y' . $column, $data['r_os'])
                ->setCellValue('V' . $column, $data['r_ks'])
                ->setCellValue('W' . $column, $data['r_kb'])
                ->setCellValue('X' . $column, $data['r_kks'])
                ->setCellValue('Y' . $column, $data['r_kls'])
                ->setCellValue('Z' . $column, $data['antrian'])
                ->setCellValue('AA' . $column, $data['kirim_hewan'])
                ->setCellValue('AB' . $column, $data['kirim_besek'])
                ->setCellValue('AC' . $column, $data['date_input']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data master qurban ' . $date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
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

        $userModel = new QurbanModel();
        $data['amprah'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("amprahbesek", $data, $header);
        echo view("pages/footer");
    }


    public function editamprah()
    {
        $model = new QurbanModel();
        $id = $this->request->getPost('id');
        $data = [
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
        ];

        if (!$id || !is_array($data)) {
            throw new \InvalidArgumentException('Data format is invalid or ID is missing.');
        }

        $model->updateQurban($data, $id);
        echo '<script>
                alert("Sukses Edit Data Amprah");
                window.location="' . base_url('/amprah') . '"
            </script>';
    }


    // Realaisasi kontroler
    public function realisasi()
    {
        $header = [
            'title' => 'Data Realisasi Cabang',
            'navbar' => 'qurban',
            'active' => 'realisasi'
        ];

        $userModel = new QurbanModel();
        $data['dataqurban'] = $userModel->orderBy('cabang', 'ASC')->findAll();

        $userModel = new SettingModel();
        $data['b_kb'] = $userModel->selectSum('b_kb')->get()->getRow()->b_kb;
        $data['b_sapi'] = $userModel->selectSum('b_sapi')->get()->getRow()->b_sapi;

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("realisasibesek", $data, $header,);
        echo view("pages/footer");
    }

    public function editrealisasi()
    {
        $userModel = new QurbanModel();
        $id = $this->request->getPost('id');
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
            'realisasi' => $this->request->getPost('realisasi'),
        ];
        if (!$id || !is_array($data)) {
            throw new \InvalidArgumentException('Data format is invalid or ID is missing.');
        }
        $userModel->updateQurban($data, $id);
        echo '<script>
                alert("Sukses Edit Data Realaisasi");
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

        // Ambil pengaturan
        $userModel = new SettingModel();
        $id = 1;
        $row = $userModel->where('id', $id)->get()->getRow();
        $data['j_h_1'] = $row->j_h_1;
        $data['j_h'] = $row->j_h;
        $data['j_h2'] = $row->j_h2;
        $data['j_h3'] = $row->j_h3;
        $data['j_h4'] = $row->j_h4;

        // Ambil seluruh jadwal
        $qurbanModel = new QurbanModel();
        $data['jadwal'] = $qurbanModel->orderBy('cabang', 'ASC')->findAll();

        // Ambil list berdasarkan hari
        $keywords = ['H1', 'H2', 'H3', 'H4'];
        foreach ($keywords as $keyword) {
            $data[strtolower($keyword)] = $qurbanModel->like('kirim_besek', $keyword)
                ->orderBy('kirim_hewan', 'ASC')
                ->findAll();
        }

        // Inisialisasi kategori yang akan dihitung jumlahnya
        $categories = [
            'sapi_bumm',
            'sapib_bumm',
            'kambing_bumm',
            'sapi_mandiri',
            'kambing_mandiri'
        ];

        $days = ['h1', 'h2', 'h3', 'h4'];

        foreach ($categories as $column) {
            foreach ($days as $day) {
                $data[$column . '_' . $day] = $qurbanModel->selectSum($column)
                    ->like('kirim_besek', $day)
                    ->get()
                    ->getRow()
                    ->$column ?? 0;
            }
        }

        // ====== Tambahan: Total Sapi (BUMM + Bagi 7) per Hari ======
        foreach ($days as $day) {
            $sapi_bumm = $data['sapi_bumm_' . $day] ?? 0;
            $sapib_bumm = $data['sapib_bumm_' . $day] ?? 0;

            // Gunakan Brick\Math
            $rSapiBumm = BigRational::of($sapi_bumm);
            $rSapibBumm = BigRational::of($sapib_bumm)->dividedBy(7);
            $total = $rSapiBumm->plus($rSapibBumm); // total rasional, misal: 20/7

            // Ubah ke bentuk campuran
            $num = $total->getNumerator()->toInt();     // misal 20
            $den = $total->getDenominator()->toInt();   // misal 7
            $whole = intdiv($num, $den);                // misal 2
            $remain = $num % $den;                      // misal 6

            // Format output
            if ($remain === 0) {
                $formatted = "$whole";
            } elseif ($whole > 0) {
                $formatted = "$whole $remain/$den";
            } else {
                $formatted = "$remain/$den";
            }

            $data['sapi_total_' . $day] = $formatted; // untuk ditampilkan di view
        }

        // Tampilkan view
        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view("jadwalpengiriman", $data, $header);
        echo view("pages/footer");
    }


    public function editjadwal()
    {
        $model = new QurbanModel();
        $id = $this->request->getPost('id');
        $data = [
            'antrian' => $this->request->getPost('antrian'),
            'kirim_hewan' => $this->request->getPost('kirim_hewan'),
            'kirim_besek' => $this->request->getPost('kirim_besek'),
        ];

        if (!$id || !is_array($data)) {
            throw new \InvalidArgumentException('Data format is invalid or ID is missing.');
        }

        $model->updateQurban($data, $id);
        echo '<script>
                alert("Sukses Edit Data Jadwal");
                window.location="' . base_url('/jadwal') . '"
            </script>';
    }
}
