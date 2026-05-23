<?php

namespace App\Controllers\Admin\Master;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JadwalModel;
use App\Models\SettingModel;
use App\Models\CabangModel;
use App\Models\PequrbanModel;


class JadwalController extends BaseController
{
    protected $JadwalModel;
    protected $SettingModel;
    protected $CabangModel;
    protected $PequrbanModel;


    public function __construct()
    {
        $this->JadwalModel = new JadwalModel();
        $this->SettingModel = new SettingModel();
        $this->CabangModel = new CabangModel();
        $this->PequrbanModel = new PequrbanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');

        // Mengambil data setting untuk jadwal dinamis (H-1 s/d H4)
        $setting = $this->SettingModel->find(1);

        // Ambil rekap hewan per cabang termasuk jadwal (data sudah di-join di model)
        $rekapResult = $this->PequrbanModel->getRekapPerCabang($tahun);
        $jadwalRaw   = $rekapResult['rekap'] ?? [];

        // Format jumlah sapi menjadi pecahan per 7 (1 sapi = 7 pequrban)
        foreach ($jadwalRaw as &$j) {
            foreach (['sapi_mandiri', 'sapi_bumm'] as $key) {
                $val = (int)($j[$key] ?? 0);
                $j[$key . '_raw'] = $val; // Simpan nilai asli untuk perhitungan total di view
                if ($val > 0) {
                    $whole  = intdiv($val, 7);
                    $remain = $val % 7;

                    if ($remain === 0) {
                        $j[$key] = (string)$whole;
                    } elseif ($whole > 0) {
                        $j[$key] = "$whole $remain/7";
                    } else {
                        $j[$key] = "$remain/7";
                    }
                }
            }
        }
        unset($j); // Penting: Hapus referensi agar tidak merusak loop pengelompokan di bawahnya

        // Kelompokkan berdasarkan jadwal kirim besek
        $grouped = [];
        foreach ($jadwalRaw as $j) {
            // Gunakan trim untuk menghindari spasi yang membuat grup berbeda
            $key = trim($j['kirim_besek'] ?? '') ?: 'Belum Ditentukan';
            $grouped[$key][] = $j;
        }
        ksort($grouped);

        $data = [
            'j_h_1'  => $setting['j_h_1'] ?? '',
            'j_h'    => $setting['j_h'] ?? '',
            'j_h2'   => $setting['j_h2'] ?? '',
            'j_h3'   => $setting['j_h3'] ?? '',
            'j_h4'   => $setting['j_h4'] ?? '',
            'grouped_jadwal' => $grouped,
            'cabang' => $this->CabangModel->orderBy('nama_cabang', 'ASC')->findAll(),
            'navbar' => 'qurban',
            'active' => 'jadwal',
            'year'   => $tahun
        ];

        return view('admin/master/jadwal/index', $data);
    }

    public function store()
    {
        $data = [
            'cabang_id'   => $this->request->getPost('cabang_id'),
            'antrian'     => $this->request->getPost('antrian'),
            'kirim_hewan' => $this->request->getPost('kirim_hewan'),
            'kirim_besek' => $this->request->getPost('kirim_besek'),
            'status'      => 'Sementara',
            'tahun'       => date('Y'),
        ];

        $this->JadwalModel->insert($data);
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'antrian'     => $this->request->getPost('antrian'),
            'kirim_hewan' => $this->request->getPost('kirim_hewan'),
            'kirim_besek' => $this->request->getPost('kirim_besek'),
            'status'      => $this->request->getPost('status'),
        ];

        if ($this->JadwalModel->update($id, $data)) {
            return redirect()->back()->with('success', 'Jadwal berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui jadwal.');
    }

    public function export()
    {
        // 1. Ambil data gabungan dari Jadwal dan Pequrban (Rekap)
        $model = new \App\Models\JadwalModel();
        $data = $model->select('jadwal.*, cabang.nama_cabang')
            ->join('cabang', 'cabang.id = jadwal.cabang_id')
            ->orderBy('jadwal.kirim_besek', 'ASC')
            ->orderBy('jadwal.antrian', 'ASC')
            ->findAll();

        // 2. Ambil rekap penderita qurban untuk angka sapi/kambing
        $pequrbanModel = new \App\Models\PequrbanModel();
        $rekap = $pequrbanModel->getRekapPerCabang(date('Y'))['rekap'];

        // 3. Gabungkan data (Mapping)
        foreach ($data as &$j) {
            $found = $rekap[$j['cabang_id']] ?? null;
            $j['sapi_mandiri'] = $found['sapi_mandiri'] ?? 0;
            $j['kambing_mandiri'] = $found['kambing_mandiri'] ?? 0;
            $j['sapi_bumm'] = $found['sapi_bumm'] ?? 0;
            $j['kambing_bumm'] = $found['kambing_bumm'] ?? 0;
        }

        // 4. Kelompokkan berdasarkan hari (Kirim Besek)
        $grouped = [];
        foreach ($data as $row) {
            $hari = $row['kirim_besek'] ?: 'Belum Terjadwal';
            $grouped[$hari][] = $row;
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheetIndex = 0;

        foreach ($grouped as $hari => $rows) {
            if ($sheetIndex > 0) $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex($sheetIndex);
            $sheet = $spreadsheet->getActiveSheet();

            // Nama Sheet (Hapus karakter ilegal Excel)
            $sheet->setTitle(substr(preg_replace('/[\\\\\/\\*\\?\\:\\[\\]]/', '', $hari), 0, 31));

            // Judul & Header
            $sheet->setCellValue('A1', 'JADWAL PENGIRIMAN - ' . strtoupper($hari));
            $sheet->mergeCells('A1:I1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

            $headers = ['No', 'Cabang', 'Sapi Cabang', 'Kambing Cabang', 'Sapi Bumm', 'Kambing Bumm', 'Antrian', 'Kirim Hewan', 'Kirim Besek'];
            foreach ($headers as $k => $v) {
                $col = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($k + 1);
                $sheet->setCellValue($col . '3', $v);
            }

            // Style Header
            $sheet->getStyle('A3:I3')->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
            $sheet->getStyle('A3:I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF4F81BD');

            // Isi Data
            $rowNum = 4;
            foreach ($rows as $i => $r) {
                $sheet->setCellValue('A' . $rowNum, $i + 1);
                $sheet->setCellValue('B' . $rowNum, $r['nama_cabang']);
                $sheet->setCellValue('C' . $rowNum, $r['sapi_mandiri']);
                $sheet->setCellValue('D' . $rowNum, $r['kambing_mandiri']);
                $sheet->setCellValue('E' . $rowNum, $r['sapi_bumm']);
                $sheet->setCellValue('F' . $rowNum, $r['kambing_bumm']);
                $sheet->setCellValue('G' . $rowNum, '#' . $r['antrian']);
                $sheet->setCellValue('H' . $rowNum, $r['kirim_hewan']);
                $sheet->setCellValue('I' . $rowNum, $r['kirim_besek']);
                $rowNum++;
            }

            // Auto Size & Border
            foreach (range('A', 'I') as $col) $sheet->getColumnDimension($col)->setAutoSize(true);
            $sheet->getStyle('A3:I' . ($rowNum - 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheetIndex++;
        }

        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Jadwal_Cabang_' . date('Ymd_His') . '.xlsx"');
        (new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet))->save('php://output');
        exit;
    }
}
