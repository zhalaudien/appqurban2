<?php

namespace App\Controllers\Admin\Penerimaan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenerimaanModel;
use App\Models\CabangModel;
use App\Models\SettingModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PenerimaanController extends BaseController
{
    protected $penerimaanModel;
    protected $cabangModel;

    public function __construct()
    {
        $this->penerimaanModel = new PenerimaanModel();
        $this->cabangModel     = new CabangModel();
    }

    // ----------------------------------------------------------------
    // READ — tampilkan semua data + form tambah
    // ----------------------------------------------------------------
    public function index()
    {
        $data = [
            'title'      => 'Penerimaan Hewan',
            'penerimaan' => $this->penerimaanModel->orderBy('created_at', 'DESC')->findAll(),
            'cabang'     => $this->cabangModel->findAll(),
        ];

        return view('admin/penerimaan/index', $data);
    }

    // ----------------------------------------------------------------
    // CREATE — simpan data baru
    // ----------------------------------------------------------------
    public function create()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/penerimaan');
        }

        $rules = [
            'cabang'     => 'required',
            'pengirim'   => 'required|min_length[3]|max_length[100]',
            'sapi'       => 'required|integer|greater_than_equal_to[0]',
            'kambing'    => 'required|integer|greater_than_equal_to[0]',
            'pembayaran' => 'required|integer|greater_than_equal_to[0]',
            'shadaqoh'   => 'required|integer|greater_than_equal_to[0]',
            'ket'        => 'permit_empty|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->penerimaanModel->insert([
            'cabang_id'  => $this->request->getPost('cabang'),
            'pengirim'   => $this->request->getPost('pengirim'),
            'sapi'       => $this->request->getPost('sapi'),
            'kambing'    => $this->request->getPost('kambing'),
            'pembayaran' => $this->request->getPost('pembayaran'),   // nilai bersih (hidden)
            'shadaqoh'   => $this->request->getPost('shadaqoh'),     // nilai bersih (hidden)
            'ket'        => $this->request->getPost('ket'),
        ]);

        return redirect()->to('/penerimaan')
            ->with('success', 'Data berhasil disimpan.');
    }

    // ----------------------------------------------------------------
    // EDIT — tampilkan form edit (biasanya modal / halaman terpisah)
    // ----------------------------------------------------------------
    public function edit($id)
    {
        $item = $this->penerimaanModel->find($id);

        if (! $item) {
            return redirect()->to('/penerimaan')
                ->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title'   => 'Edit Penerimaan',
            'item'    => $item,
            'cabang'  => $this->cabangModel->findAll(),
        ];

        return view('penerimaan/edit', $data);
    }

    // ----------------------------------------------------------------
    // UPDATE — simpan perubahan data
    // ----------------------------------------------------------------
    public function update($id)
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/penerimaan');
        }

        $item = $this->penerimaanModel->find($id);

        if (! $item) {
            return redirect()->to('/penerimaan')
                ->with('error', 'Data tidak ditemukan.');
        }

        $rules = [
            'cabang'     => 'required',
            'pengirim'   => 'required|min_length[3]|max_length[100]',
            'sapi'       => 'required|integer|greater_than_equal_to[0]',
            'kambing'    => 'required|integer|greater_than_equal_to[0]',
            'pembayaran' => 'required|integer|greater_than_equal_to[0]',
            'shadaqoh'   => 'required|integer|greater_than_equal_to[0]',
            'ket'        => 'permit_empty|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->penerimaanModel->update($id, [
            'cabang_id'  => $this->request->getPost('cabang'),
            'pengirim'   => $this->request->getPost('pengirim'),
            'sapi'       => $this->request->getPost('sapi'),
            'kambing'    => $this->request->getPost('kambing'),
            'pembayaran' => $this->request->getPost('pembayaran'),
            'shadaqoh'   => $this->request->getPost('shadaqoh'),
            'ket'        => $this->request->getPost('ket'),
        ]);

        return redirect()->to('/penerimaan')
            ->with('success', 'Data berhasil diperbarui.');
    }

    // ----------------------------------------------------------------
    // DELETE — hapus data
    // ----------------------------------------------------------------
    public function hapus($id)
    {
        $item = $this->penerimaanModel->find($id);

        if (! $item) {
            return redirect()->to('/penerimaan')
                ->with('error', 'Data tidak ditemukan.');
        }

        $this->penerimaanModel->delete($id);

        return redirect()->to('/penerimaan')
            ->with('success', 'Data berhasil dihapus.');
    }

    // ----------------------------------------------------------------
    // EXPORT — ekspor ke Excel menggunakan PhpSpreadsheet
    // ----------------------------------------------------------------
    public function export()
    {
        $data = $this->penerimaanModel
            ->select('penerimaan.*, cabang.nama_cabang')
            ->join('cabang', 'cabang.id = penerimaan.cabang_id', 'left')
            ->orderBy('penerimaan.created_at', 'ASC')
            ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // ── Header ──────────────────────────────────────────────────
        $headers = [
            'No',
            'Cabang',
            'Pengirim',
            'Jumlah Sapi',
            'Jumlah Kambing',
            'Pembayaran (Rp)',
            'Shadaqoh (Rp)',
            'Keterangan',
            'Tanggal Input'
        ];

        foreach ($headers as $col => $header) {
            $sheet->setCellValueByColumnAndRow($col + 1, 1, $header);
        }

        // Style header
        $headerStyle = [
            'font'      => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill'      => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '0DCAF0']
            ],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
        ];
        $sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

        // ── Baris data ───────────────────────────────────────────────
        foreach ($data as $i => $row) {
            $r = $i + 2;
            $sheet->setCellValueByColumnAndRow(1, $r, $i + 1);
            $sheet->setCellValueByColumnAndRow(2, $r, $row['cabang_id'] == 9999 ? 'BUMM' : $row['nama_cabang']);
            $sheet->setCellValueByColumnAndRow(3, $r, $row['pengirim']);
            $sheet->setCellValueByColumnAndRow(4, $r, $row['sapi']);
            $sheet->setCellValueByColumnAndRow(5, $r, $row['kambing']);
            $sheet->setCellValueByColumnAndRow(6, $r, $row['pembayaran']);
            $sheet->setCellValueByColumnAndRow(7, $r, $row['shadaqoh']);
            $sheet->setCellValueByColumnAndRow(8, $r, $row['ket']);
            $sheet->setCellValueByColumnAndRow(9, $r, $row['created_at']);
        }

        // Auto-size kolom
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Format angka rupiah pada kolom F & G
        $rupiah = '#,##0';
        $lastRow = count($data) + 1;
        $sheet->getStyle("F2:G{$lastRow}")->getNumberFormat()->setFormatCode($rupiah);

        // ── Output ───────────────────────────────────────────────────
        $filename = 'penerimaan_hewan_' . date('Ymd_His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$filename}\"");
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
