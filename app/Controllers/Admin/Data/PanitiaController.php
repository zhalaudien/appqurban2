<?php

namespace App\Controllers\Admin\Data;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PanitiaModel;
use App\Models\SeksiModel;
use App\Models\CabangModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PanitiaController extends BaseController
{
    public function index()
    {
        $panitiaModel = new PanitiaModel();
        $seksiModel   = new SeksiModel();
        $cabangModel  = new CabangModel();

        $data = [
            'title'       => 'Data Panitia',
            'navbar'      => 'data',
            'active'      => 'panitia',
            'idpanitia'   => $seksiModel->orderBy('nama_seksi', 'ASC')->findAll(),
            'viewcabang'  => $cabangModel->orderBy('nama_cabang', 'ASC')->findAll(),
            'viewpanitia' => $panitiaModel->select('panitia.*, cabang.nama_cabang, seksi.nama_seksi')
                ->join('cabang', 'cabang.id = panitia.cabang_id')
                ->join('seksi', 'seksi.id = panitia.seksi_id')
                ->orderBy('panitia.nama', 'ASC')
                ->findAll()
        ];

        return view("admin/data/panitia/index", $data);
    }

    public function create()
    {
        $model = new PanitiaModel();

        $data = [
            'nama'      => $this->request->getPost('nama'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'cabang_id' => $this->request->getPost('cabang_id'),
            'seksi_id'  => $this->request->getPost('seksi_id'),
            'jabatan'   => $this->request->getPost('jabatan'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $model->insert($data);

        return redirect()->back()->with('success', 'Data panitia berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new PanitiaModel();

        $data = [
            'nama'      => $this->request->getPost('nama'),
            'no_hp'     => $this->request->getPost('no_hp'),
            'cabang_id' => $this->request->getPost('cabang_id'),
            'seksi_id'  => $this->request->getPost('seksi_id'),
            'jabatan'   => $this->request->getPost('jabatan'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $model->update($id, $data);

        return redirect()->back()->with('success', 'Data panitia berhasil diperbarui');
    }

    public function delete($id)
    {
        $model = new PanitiaModel();
        $model->delete($id);

        return redirect()->back()->with('success', 'Data panitia berhasil dihapus');
    }

    public function export()
    {
        $model = new PanitiaModel();

        $data = $model
            ->select('panitia.*, cabang.nama_cabang, seksi.nama_seksi')
            ->join('cabang', 'cabang.id = panitia.cabang_id')
            ->join('seksi', 'seksi.id = panitia.seksi_id')
            ->orderBy('panitia.nama', 'ASC')
            ->findAll();

        if (empty($data)) {
            return redirect()->back()->with('error', 'Tidak ada data untuk diekspor.');
        }

        // Kelompokkan data berdasarkan nama seksi
        $grouped = [];
        foreach ($data as $row) {
            $grouped[$row['nama_seksi']][] = $row;
        }

        $spreadsheet = new Spreadsheet();

        $sheetIndex = 0;
        foreach ($grouped as $seksiName => $rows) {
            // Buat sheet baru jika bukan index pertama
            if ($sheetIndex > 0) {
                $spreadsheet->createSheet();
            }

            $spreadsheet->setActiveSheetIndex($sheetIndex);
            $sheet = $spreadsheet->getActiveSheet();

            // Nama sheet (maks 31 karakter dan hapus karakter ilegal Excel)
            $safeName = substr(preg_replace('/[\\\\\/\\*\\?\\:\\[\\]]/', '', $seksiName), 0, 31);
            $sheet->setTitle($safeName ?: 'Seksi ' . ($sheetIndex + 1));

            // Set Page Setup: A4 & Landscape
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
            $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

            // Judul laporan di tiap tab
            $sheet->setCellValue('A1', 'LAPORAN DATA PANITIA - ' . strtoupper($seksiName));
            $sheet->mergeCells('A1:F1');
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);

            // Header tabel
            $sheet->setCellValue('A3', 'No');
            $sheet->setCellValue('B3', 'Nama');
            $sheet->setCellValue('C3', 'Cabang');
            $sheet->setCellValue('D3', 'No HP');
            $sheet->setCellValue('E3', 'Jabatan');

            // Style header (Warna latar biru dan teks putih tebal)
            $sheet->getStyle('A3:E3')->getFont()->setBold(true);
            $sheet->getStyle('A3:E3')->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('FF4F81BD');
            $sheet->getStyle('A3:E3')->getFont()->getColor()->setARGB('FFFFFFFF');

            $rowNum = 4;
            $no = 1;
            foreach ($rows as $row) {
                $sheet->setCellValue('A' . $rowNum, $no++);
                $sheet->setCellValue('B' . $rowNum, $row['nama']);
                $sheet->setCellValue('C' . $rowNum, $row['nama_cabang']);
                $sheet->setCellValue('D' . $rowNum, $row['no_hp']);
                $sheet->setCellValue('E' . $rowNum, ($row['jabatan'] == 'koordinator' ? 'Koordinator' : 'Anggota'));
                $rowNum++;
            }

            // Tambahkan border pada seluruh tabel (Header sampai baris terakhir data)
            $sheet->getStyle('A3:E' . ($rowNum - 1))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);

            // Auto width untuk semua kolom agar rapi
            foreach (range('A', 'E') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            $sheetIndex++;
        }

        // Set sheet pertama sebagai yang aktif saat file dibuka
        $spreadsheet->setActiveSheetIndex(0);

        $filename = 'data_panitia_per_seksi_' . date('Y-m-d_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
