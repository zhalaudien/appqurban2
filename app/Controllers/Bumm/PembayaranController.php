<?php

namespace App\Controllers\Bumm;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CabangModel;
use App\Models\PembayaranModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class PembayaranController extends BaseController
{
    protected CabangModel $cabang;
    protected PembayaranModel $pembayaran;

    public function __construct()
    {
        $this->cabang = new CabangModel();
        $this->pembayaran = new PembayaranModel();
    }

    public function index()
    {
        $data = [
            'cabang' => $this->cabang->where('pusat', 7)->orderBy('nama_cabang', 'ASC')->findAll(), // Untuk dropdown di form
            'viewbembayaran' => $this->pembayaran
                ->select('pembayaran_bumm.*, cabang.nama_cabang as cabang_nama') // Ambil nama_cabang dari tabel cabang
                ->join('cabang', 'cabang.id = pembayaran_bumm.cabang_id', 'left')
                ->orderBy('pembayaran_bumm.updated_at', 'DESC')
                ->findAll(),
            'navbar' => 'pembayaran',
            'active' => 'pembayaran'
        ];

        return view('bumm/pembayaran', $data);
    }

    public function store()
    {
        $rules = [
            'cabang_id' => 'required|numeric',
            'nama' => 'required|max_length[255]',
            'pembayaran' => 'required|numeric',
            'keterangan' => 'required|max_length[255]',
            'catatan' => 'permit_empty|max_length[255]',
            'created_at' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'cabang_id' => $this->request->getPost('cabang_id'),
            'nama' => $this->request->getPost('nama'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'keterangan' => $this->request->getPost('keterangan'),
            'catatan' => $this->request->getPost('catatan'),
            'tahun' => date('Y'), // Asumsi tahun saat ini
            'created_at' => $this->request->getPost('created_at') . ' ' . date('H:i:s'), // Gabungkan tanggal dari form dengan waktu saat ini
        ];

        if ($this->pembayaran->insert($data)) {
            return redirect()->to(base_url('bumm/pembayaran'))->with('success', 'Data pembayaran berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pembayaran.');
        }
    }

    public function update($id)
    {
        $rules = [
            'cabang_id' => 'required|numeric',
            'nama' => 'required|max_length[255]',
            'pembayaran' => 'required|numeric',
            'keterangan' => 'required|max_length[255]',
            'catatan' => 'permit_empty|max_length[255]',
            'created_at' => 'required|valid_date',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'cabang_id' => $this->request->getPost('cabang_id'),
            'nama' => $this->request->getPost('nama'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'keterangan' => $this->request->getPost('keterangan'),
            'catatan' => $this->request->getPost('catatan'),
            'created_at' => $this->request->getPost('created_at') . ' ' . date('H:i:s'), // Gabungkan tanggal dari form dengan waktu saat ini
        ];

        if ($this->pembayaran->update($id, $data)) {
            return redirect()->to(base_url('bumm/pembayaran'))->with('success', 'Data pembayaran berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data pembayaran.');
        }
    }

    public function delete($id)
    {
        if ($this->pembayaran->delete($id)) {
            return redirect()->to(base_url('bumm/pembayaran'))->with('success', 'Data pembayaran berhasil dihapus.');
        } else {
            return redirect()->to(base_url('bumm/pembayaran'))->with('error', 'Gagal menghapus data pembayaran.');
        }
    }

    public function export()
    {
        $payments = $this->pembayaran
            ->select('pembayaran_bumm.*, cabang.nama_cabang as cabang_nama')
            ->join('cabang', 'cabang.id = pembayaran_bumm.cabang_id', 'left')
            ->orderBy('pembayaran_bumm.created_at', 'DESC')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Cabang');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Pembayaran');
        $sheet->setCellValue('E1', 'Metode');
        $sheet->setCellValue('F1', 'Catatan');
        $sheet->setCellValue('G1', 'Tanggal');

        $row = 2;
        foreach ($payments as $index => $payment) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $payment['cabang_nama']);
            $sheet->setCellValue('C' . $row, $payment['nama']);
            $sheet->setCellValue('D' . $row, $payment['pembayaran']);
            $sheet->setCellValue('E' . $row, $payment['keterangan']);
            $sheet->setCellValue('F' . $row, $payment['catatan']);
            $sheet->setCellValue('G' . $row, $payment['created_at']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data_Pembayaran_BUMM_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();
    }
}
