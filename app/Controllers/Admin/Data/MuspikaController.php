<?php

namespace App\Controllers\Admin\Data;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MuspikaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class MuspikaController extends BaseController
{
    public function index()
    {
        $userModel = new MuspikaModel();
        $data = [
            'title'       => 'Data Muspika',
            'navbar'      => 'data',
            'active'      => 'muspika',
            'viewmuspika' => $userModel->orderBy('nama', 'ASC')->findAll()
        ];

        return view("admin/data/muspika/index", $data);
    }

    public function create()
    {
        $model = new MuspikaModel();
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'dinas'  => $this->request->getPost('dinas'),
            'pj'     => $this->request->getPost('pj'),
        ];
        $model->insert($data);

        return redirect()->to(base_url('muspika'))->with('success', 'Data Muspika berhasil ditambahkan');
    }

    public function update($id)
    {
        $model = new MuspikaModel();
        $data = [
            'nama'   => $this->request->getPost('nama'),
            'dinas'  => $this->request->getPost('dinas'),
            'pj'     => $this->request->getPost('pj'),
        ];
        $model->update($id, $data);

        return redirect()->to(base_url('muspika'))->with('success', 'Data Muspika berhasil diperbarui');
    }

    public function delete($id)
    {
        $model = new MuspikaModel();
        $model->delete($id);

        return redirect()->to(base_url('muspika'))->with('success', 'Data Muspika berhasil dihapus');
    }

    public function export()
    {
        $userModel = new MuspikaModel();
        $muspika = $userModel->orderBy('nama', 'ASC')->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Dinas');
        $sheet->setCellValue('D1', 'Koordinator');

        $row = 2;
        foreach ($muspika as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item['nama']);
            $sheet->setCellValue('C' . $row, $item['dinas']);
            $sheet->setCellValue('D' . $row, $item['pj']);
            $row++;
        }

        // Auto-size kolom
        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'Data_Muspika_' . date('Ymd_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
