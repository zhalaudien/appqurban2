<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PequrbanModel;
use App\Models\CabangModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PequrbanController extends BaseController
{
    protected PequrbanModel $model;
    protected int $cabangId;

    public function __construct()
    {
        $this->model    = new PequrbanModel();
    }

    public function index()
    {
        $tahun = $this->request->getGet('year') ?? date('Y');
        $idpusat = session()->get('user')['pusat'];

        $data = [
            'title'    => 'Data Pequrban',
            'pequrban' => $this->model
                ->select('pequrban.*, cabang.nama_cabang as nama_cabang')
                ->join('cabang', 'cabang.id = pequrban.cabang_id')
                ->where('cabang.pusat', $idpusat)
                ->where('pequrban.tahun', $tahun)
                ->orderBy('pequrban.updated_at', 'DESC')
                ->findAll()
        ];

        $header = [
            'title' => 'Data Pequrban',
            'navbar' => 'qurban',
            'active' => 'pequrban'
        ];

        echo view("pages/header");
        echo view("pages/navbar", $header);
        echo view('admin/master/datapequrban/index', $data);
        echo view("pages/footer");
    }

    public function create()
    {
        return view('cabang/pequrban/create', [
            'title' => 'Tambah Pequrban'
        ]);
    }

    public function store()
    {
        $this->model->insert([
            'nama'        => $this->request->getPost('nama'),
            'jenis_hewan' => $this->request->getPost('jenis_hewan'),
            'sumber'      => $this->request->getPost('sumber'),
            'harga'       => $this->request->getPost('harga'),
            'cabang_id'   => $this->cabangId, // 🔒 AUTO
        ]);

        return redirect()->to('/cabang/pequrban')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = $this->model
            ->where('id', $id)
            ->where('cabang_id', $this->cabangId)
            ->first();

        if (! $data) {
            return redirect()->back();
        }

        return view('cabang/pequrban/edit', [
            'title' => 'Edit Pequrban',
            'row'   => $data
        ]);
    }

    public function update($id)
    {
        $this->model
            ->where('id', $id)
            ->where('cabang_id', $this->cabangId)
            ->set([
                'nama'        => $this->request->getPost('nama'),
                'jenis_hewan' => $this->request->getPost('jenis_hewan'),
                'sumber'      => $this->request->getPost('sumber'),
                'harga'       => $this->request->getPost('harga'),
            ])->update();

        return redirect()->to('/cabang/pequrban')->with('success', 'Data berhasil diupdate');
    }

    public function delete($id)
    {
        $this->model
            ->where('id', $id)
            ->where('cabang_id', $this->cabangId)
            ->delete();

        return redirect()->to('/cabang/pequrban')->with('success', 'Data berhasil dihapus');
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

        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Jenis Hewan');
        $sheet->setCellValue('D1', 'Sumber');
        $sheet->setCellValue('E1', 'Harga');
        $sheet->setCellValue('F1', 'Cabang');
        $sheet->setCellValue('G1', 'Diperbarui Pada');

        // Isi data ke spreadsheet
        $rowNum = 2;
        foreach ($data as $row) {
            $sheet->setCellValue("A$rowNum", $row['id']);
            $sheet->setCellValue("B$rowNum", $row['nama']);
            $sheet->setCellValue("C$rowNum", ucfirst($row['jenis_hewan']));
            $sheet->setCellValue("D$rowNum", ucfirst($row['sumber']));
            $sheet->setCellValue("E$rowNum", number_format($row['harga'], 0, ',', '.'));
            $sheet->setCellValue("F$rowNum", $row['nama_cabang']);
            $sheet->setCellValue("G$rowNum", date('d-m-Y H:i', strtotime($row['updated_at'])));
            $rowNum++;
        }

        // Set header untuk download file Excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="data_pequrban_' . date('Y-m-d') . '.xlsx"');

        // Tulis file Excel ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
