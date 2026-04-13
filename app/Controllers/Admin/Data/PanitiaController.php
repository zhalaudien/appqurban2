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
        $userModel = new PanitiaModel();
        $idPanitia = new SeksiModel();
        $cabangModel = new CabangModel();

        $data['idpanitia'] = $idPanitia->orderBy('nama_seksi', 'ASC')->findAll();
        $data['viewcabang'] = $cabangModel->orderBy('nama_cabang', 'ASC')->findAll();

        $model = new \App\Models\PanitiaModel();

        $builder = $model
            ->select('panitia.*, cabang.nama_cabang, seksi.nama_seksi')
            ->join('cabang', 'cabang.id = panitia.cabang_id')
            ->join('seksi', 'seksi.id = panitia.seksi_id')
            ->orderBy('panitia.nama', 'ASC');

        $header = [
            'title' => 'Data Panitia',
            'navbar' => 'data',
            'active' => 'panitia'
        ];

        $data['viewpanitia'] = $builder->findAll();

        echo view("admin/data/panitia/index", $data, $header);
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

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul laporan
        $sheet->setCellValue('A1', 'LAPORAN DATA PANITIA QURBAN');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // Header tabel
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama');
        $sheet->setCellValue('C3', 'Cabang');
        $sheet->setCellValue('D3', 'No HP');
        $sheet->setCellValue('E3', 'Seksi');
        $sheet->setCellValue('F3', 'Jabatan');

        // Style header (Warna latar biru dan teks putih tebal)
        $sheet->getStyle('A3:F3')->getFont()->setBold(true);
        $sheet->getStyle('A3:F3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF4F81BD');
        $sheet->getStyle('A3:F3')->getFont()->getColor()->setARGB('FFFFFFFF');

        $rowNum = 4;
        $no = 1;

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNum, $no++);
            $sheet->setCellValue('B' . $rowNum, $row['nama']);
            $sheet->setCellValue('C' . $rowNum, $row['nama_cabang']);
            $sheet->setCellValue('D' . $rowNum, $row['no_hp']);
            $sheet->setCellValue('E' . $rowNum, $row['nama_seksi']);
            $sheet->setCellValue('F' . $rowNum, ($row['jabatan'] == 'koordinator' ? 'Koordinator' : 'Anggota'));
            $rowNum++;
        }

        // Auto width untuk semua kolom agar rapi
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $filename = 'data_panitia_' . date('Y-m-d_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
