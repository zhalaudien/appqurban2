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
        $type = $this->request->getGet('type') ?? 'all';
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

        $spreadsheet = new Spreadsheet();

        if ($type === 'all') {
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Semua Panitia');
            $this->generateSheetData($sheet, 'LAPORAN SEMUA DATA PANITIA', $data, 'all');
        } else {
            $groupKey = ($type === 'cabang') ? 'nama_cabang' : 'nama_seksi';
            $grouped = [];
            foreach ($data as $row) {
                $grouped[$row[$groupKey]][] = $row;
            }

            $sheetIndex = 0;
            foreach ($grouped as $name => $rows) {
                if ($sheetIndex > 0) $spreadsheet->createSheet();
                $spreadsheet->setActiveSheetIndex($sheetIndex);
                $sheet = $spreadsheet->getActiveSheet();

                $safeName = substr(preg_replace('/[\\\\\/\\*\\?\\:\\[\\]]/', '', $name), 0, 31);
                $sheet->setTitle($safeName ?: 'Sheet ' . ($sheetIndex + 1));

                $title = 'LAPORAN DATA PANITIA - ' . strtoupper($type) . ' ' . strtoupper($name);
                $this->generateSheetData($sheet, $title, $rows, $type);
                $sheetIndex++;
            }
        }

        // Set sheet pertama sebagai yang aktif saat file dibuka
        $spreadsheet->setActiveSheetIndex(0);

        $filename = 'data_panitia_' . $type . '_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    private function generateSheetData($sheet, $title, $data, $type)
    {
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

        if ($type === 'all') {
            $headers = ['No', 'Nama', 'Cabang', 'No HP', 'Seksi', 'Jabatan'];
            $maxCol = 'F';
        } elseif ($type === 'cabang') {
            $headers = ['No', 'Nama', 'No HP', 'Seksi', 'Jabatan'];
            $maxCol = 'E';
        } else { // seksi
            $headers = ['No', 'Nama', 'Cabang', 'No HP', 'Jabatan'];
            $maxCol = 'E';
        }

        $sheet->setCellValue('A1', $title);
        $sheet->mergeCells("A1:{$maxCol}1");
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(12);

        foreach ($headers as $index => $h) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);
            $sheet->setCellValue($colLetter . '3', $h);
        }

        $headerRange = "A3:{$maxCol}3";
        $sheet->getStyle($headerRange)->getFont()->setBold(true);
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF4F81BD');
        $sheet->getStyle($headerRange)->getFont()->getColor()->setARGB('FFFFFFFF');

        $rowNum = 4;
        $no = 1;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNum, $no++);
            $sheet->setCellValue('B' . $rowNum, $row['nama']);

            if ($type === 'all') {
                $sheet->setCellValue('C' . $rowNum, $row['nama_cabang']);
                $sheet->setCellValue('D' . $rowNum, $row['no_hp']);
                $sheet->setCellValue('E' . $rowNum, $row['nama_seksi']);
                $sheet->setCellValue('F' . $rowNum, ($row['jabatan'] == 'koordinator' ? 'Koordinator' : 'Anggota'));
            } elseif ($type === 'cabang') {
                $sheet->setCellValue('C' . $rowNum, $row['no_hp']);
                $sheet->setCellValue('D' . $rowNum, $row['nama_seksi']);
                $sheet->setCellValue('E' . $rowNum, ($row['jabatan'] == 'koordinator' ? 'Koordinator' : 'Anggota'));
            } else { // seksi
                $sheet->setCellValue('C' . $rowNum, $row['nama_cabang']);
                $sheet->setCellValue('D' . $rowNum, $row['no_hp']);
                $sheet->setCellValue('E' . $rowNum, ($row['jabatan'] == 'koordinator' ? 'Koordinator' : 'Anggota'));
            }
            $rowNum++;
        }

        $tableRange = "A3:{$maxCol}" . ($rowNum - 1);
        $sheet->getStyle($tableRange)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]]
        ]);

        foreach (range('A', $maxCol) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
