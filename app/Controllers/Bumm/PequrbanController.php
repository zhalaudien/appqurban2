<?php

namespace App\Controllers\Bumm;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PequrbanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class PequrbanController extends BaseController
{
    protected $pequrbanModel;

    public function __construct()
    {
        $this->pequrbanModel = new PequrbanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');
        $result = $this->pequrbanModel->getRekapPerCabang($tahun);

        $data = [
            'year'   => $tahun,
            'rekap'  => $result['rekap'],
            'prices' => $result['prices'],
        ];


        return view('bumm/pequrban', $data);
    }

    public function export()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');
        $result = $this->pequrbanModel->getRekapPerCabang($tahun);
        $rekap = $result['rekap'];
        $prices = $result['prices'];

        $kambingBumm = array_filter($prices, fn($p) => $p['jenis_hewan'] === 'kambing');
        $sapiBumm    = array_filter($prices, fn($p) => $p['jenis_hewan'] === 'sapi');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header Row 1
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'CABANG');
        $sheet->setCellValue('C1', 'SAPI MANDIRI');
        $sheet->setCellValue('D1', 'KAMBING MANDIRI');

        $colIndex = 5;
        // Kambing BUMM Header
        $startKambing = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
        $sheet->setCellValue($startKambing . '1', 'KAMBING BUMM');
        $spanKambing = max(1, count($kambingBumm));
        $endKambing = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + $spanKambing - 1);
        $sheet->mergeCells($startKambing . '1:' . $endKambing . '1');

        // Sapi BUMM Header
        $colIndex += $spanKambing;
        $startSapi = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex);
        $sheet->setCellValue($startSapi . '1', 'SAPI BUMM');
        $spanSapi = max(1, count($sapiBumm));
        $endSapi = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + $spanSapi - 1);
        $sheet->mergeCells($startSapi . '1:' . $endSapi . '1');

        // Static Headers
        $colIndex += $spanSapi;
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex) . '1', 'TOTAL UANG');
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1) . '1', 'PEMBAYARAN');
        $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 2) . '1', 'KEKURANGAN');

        // Rowspan merges
        foreach (['A', 'B', 'C', 'D'] as $col) $sheet->mergeCells($col . '1:' . $col . '2');
        for ($i = 0; $i < 3; $i++) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + $i);
            $sheet->mergeCells($colLetter . '1:' . $colLetter . '2');
        }

        // Header Row 2 (Prices)
        $colIndex = 5;
        foreach ($kambingBumm as $p) {
            $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++) . '2', $p['harga']);
        }
        if (empty($kambingBumm)) $colIndex++;

        foreach ($sapiBumm as $p) {
            $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex++) . '2', $p['harga']);
        }
        if (empty($sapiBumm)) $colIndex++;

        // Data Body
        $row = 3;
        $no = 1;
        foreach ($rekap as $c) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $c['nama_cabang']);
            $sheet->setCellValue('C' . $row, $c['sapi_mandiri']);
            $sheet->setCellValue('D' . $row, $c['kambing_mandiri']);

            $dataCol = 5;
            foreach ($kambingBumm as $p) {
                $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($dataCol++) . $row, $c['bumm_kambing_' . $p['harga']] ?? 0);
            }
            if (empty($kambingBumm)) $dataCol++;

            foreach ($sapiBumm as $p) {
                $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($dataCol++) . $row, $c['bumm_sapi_' . $p['harga']] ?? 0);
            }
            if (empty($sapiBumm)) $dataCol++;

            $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($dataCol) . $row, $c['total_uang']);
            $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($dataCol + 1) . $row, '-');
            $sheet->setCellValue(\PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($dataCol + 2) . $row, '-');
            $row++;
        }

        // Styling
        $sheet->getStyle('A1:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($dataCol + 2) . '2')->getFont()->setBold(true);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap_Hewan_Qurban_' . $tahun . '_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit;
    }
}
