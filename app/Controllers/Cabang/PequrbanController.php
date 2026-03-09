<?php

namespace App\Controllers\Cabang;

use App\Controllers\BaseController;
use App\Models\PequrbanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PequrbanController extends BaseController
{
    protected PequrbanModel $model;
    protected int $cabangId;
    protected int $tahun;

    public function __construct()
    {
        $this->model    = new PequrbanModel();
        $this->cabangId = session()->get('user')['cabang_id'] ?? 0;
        $this->tahun    = date('Y');
    }

    public function index()
    {
        $cabangId = session()->get('user')['cabang_id'];

        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $model = new PequrbanModel();

        $data = [
            'tahun_selected' => $tahun,
            'pequrban' => $model->getPerCabang($cabangId, $tahun)
        ];

        return view('cabang/pequrban/index', $data);
    }

    public function store()
    {
        if (!$this->cabangId) {
            return redirect()->back()->with('error', 'Session cabang tidak ditemukan');
        }

        $this->model->insert([
            'nama'        => $this->request->getPost('nama'),
            'cabang_id'   => $this->cabangId,
            'jenis_hewan' => $this->request->getPost('jenis_hewan'),
            'tahun'       => $this->tahun,
            'harga'       => $this->request->getPost('harga'),
            'sumber'      => $this->request->getPost('sumber'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function update($id)
    {
        $data = $this->model
            ->where('id', $id)
            ->where('cabang_id', $this->cabangId)
            ->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $this->model->update($id, [
            'nama'        => $this->request->getPost('nama'),
            'jenis_hewan' => $this->request->getPost('jenis_hewan'),
            'harga'       => $this->request->getPost('harga'),
            'sumber'      => $this->request->getPost('sumber'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $data = $this->model
            ->where('id', $id)
            ->where('cabang_id', $this->cabangId)
            ->first();

        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $this->model->delete($id);

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function export()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');
        $idpusat = session()->get('user')['pusat'];

        $data = $this->model
            ->select('pequrban.*, cabang.nama_cabang as nama_cabang')
            ->join('cabang', 'cabang.id = pequrban.cabang_id')
            ->where('cabang.pusat', $idpusat)
            ->where('pequrban.tahun', $tahun)
            ->orderBy('pequrban.updated_at', 'DESC')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul laporan
        $sheet->setCellValue('A1', 'LAPORAN DATA PEQURBAN');
        $sheet->mergeCells('A1:F1');

        $sheet->setCellValue('A2', 'Tahun: ' . $tahun);
        $sheet->mergeCells('A2:F2');

        // Header tabel
        $sheet->setCellValue('A4', 'No');
        $sheet->setCellValue('B4', 'Nama');
        $sheet->setCellValue('C4', 'Jenis Hewan');
        $sheet->setCellValue('D4', 'Sumber');
        $sheet->setCellValue('E4', 'Harga');
        $sheet->setCellValue('F4', 'Diperbarui');

        // Style header
        $sheet->getStyle('A4:F4')->getFont()->setBold(true);
        $sheet->getStyle('A4:F4')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF4F81BD');

        $sheet->getStyle('A4:F4')->getFont()->getColor()->setARGB('FFFFFFFF');

        $rowNum = 5;
        $no = 1;

        foreach ($data as $row) {

            $sheet->setCellValue("A$rowNum", $no++);
            $sheet->setCellValue("B$rowNum", $row['nama']);
            $sheet->setCellValue("C$rowNum", ucfirst($row['jenis_hewan']));
            $sheet->setCellValue("D$rowNum", ucfirst($row['sumber']));
            $sheet->setCellValue("E$rowNum", $row['harga']);
            $sheet->setCellValue("F$rowNum", date('d-m-Y H:i', strtotime($row['updated_at'])));

            $rowNum++;
        }

        // Format harga
        $sheet->getStyle("E5:E$rowNum")
            ->getNumberFormat()
            ->setFormatCode('#,##0');

        // Auto width kolom
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Border tabel
        $sheet->getStyle("A4:F" . ($rowNum - 1))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Freeze header
        $sheet->freezePane('A5');

        // Nama file
        $namaCabang = $data[0]['nama_cabang'] ?? 'semua_cabang';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan_pequrban_' . $tahun . '_' . $namaCabang . '_' . date('Y-m-d H-i-s') . '.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    public function template()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $sheet->setCellValue('A1', 'TEMPLATE IMPORT DATA PEQURBAN');
        $sheet->mergeCells('A1:D1');

        // Petunjuk
        $sheet->setCellValue('A2', 'Petunjuk:');
        $sheet->setCellValue('A3', '1. Isi nama pequrban');
        $sheet->setCellValue('A4', '2. Jenis hewan: sapi atau kambing');
        $sheet->setCellValue('A5', '3. Sumber: mandiri atau bumm');
        $sheet->setCellValue('A6', '4. Harga diisi angka tanpa titik');

        // Header tabel
        $sheet->setCellValue('A8', 'Nama');
        $sheet->setCellValue('B8', 'Jenis Hewan');
        $sheet->setCellValue('C8', 'Sumber');
        $sheet->setCellValue('D8', 'Harga');

        // Contoh data
        $sheet->setCellValue('A9', 'Ahmad Fauzi');
        $sheet->setCellValue('B9', 'kambing');
        $sheet->setCellValue('C9', 'mandiri');
        $sheet->setCellValue('D9', 2500000);

        $sheet->setCellValue('A10', 'Budi Santoso');
        $sheet->setCellValue('B10', 'sapi');
        $sheet->setCellValue('C10', 'bumm');
        $sheet->setCellValue('D10', 3000000);

        // Style header
        $sheet->getStyle('A8:D8')->getFont()->setBold(true);
        $sheet->getStyle('A8:D8')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF4F81BD');

        $sheet->getStyle('A8:D8')->getFont()->getColor()->setARGB('FFFFFFFF');

        // Format harga
        $sheet->getStyle('D9:D1000')
            ->getNumberFormat()
            ->setFormatCode('#,##0');

        // Dropdown Jenis Hewan
        $validation = $sheet->getCell('B9')->getDataValidation();
        $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
        $validation->setAllowBlank(true);
        $validation->setShowDropDown(true);
        $validation->setFormula1('"sapi,kambing"');

        for ($i = 9; $i <= 500; $i++) {
            $sheet->getCell("B$i")->setDataValidation(clone $validation);
        }

        // Dropdown Sumber
        $validation2 = $sheet->getCell('C9')->getDataValidation();
        $validation2->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $validation2->setFormula1('"mandiri,bumm"');

        for ($i = 9; $i <= 500; $i++) {
            $sheet->getCell("C$i")->setDataValidation(clone $validation2);
        }

        // Auto width
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="template_import_pequrban.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');

        if (!$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid');
        }

        $spreadsheet = IOFactory::load($file->getTempName());
        $rows = $spreadsheet->getActiveSheet()->toArray();

        $model = new PequrbanModel();

        $user = session()->get('user');
        $cabangId = $user['cabang_id'];
        $tahun = date('Y');

        $berhasil = 0;
        $duplikat = 0;
        $kosong = 0;
        $invalid = 0;

        foreach ($rows as $i => $row) {

            // skip judul + petunjuk + header
            if ($i < 8) continue;

            $nama       = trim($row[0] ?? '');
            $jenisHewan = strtolower(trim($row[1] ?? ''));
            $sumber     = strtolower(trim($row[2] ?? ''));
            $harga      = trim($row[3] ?? '');

            if ($nama == '') {
                $kosong++;
                continue;
            }

            // validasi jenis hewan
            if (!in_array($jenisHewan, ['sapi', 'kambing'])) {
                $invalid++;
                continue;
            }

            // validasi sumber
            if (!in_array($sumber, ['mandiri', 'bumm'])) {
                $invalid++;
                continue;
            }

            // cek duplikat
            $cek = $model->where('nama', $nama)
                ->where('cabang_id', $cabangId)
                ->where('tahun', $tahun)
                ->first();

            if ($cek) {
                $duplikat++;
                continue;
            }

            $model->insert([
                'nama' => $nama,
                'jenis_hewan' => $jenisHewan,
                'sumber' => $sumber,
                'harga' => (int)$harga,
                'cabang_id' => $cabangId,
                'tahun' => $tahun,
            ]);

            $berhasil++;
        }

        return redirect()->back()->with(
            'success',
            "Import selesai. Berhasil: $berhasil | Duplikat: $duplikat | Kosong: $kosong | Invalid: $invalid"
        );
    }
}
