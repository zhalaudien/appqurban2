<?php

namespace App\Controllers\Admin\Penerimaan;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\QurbanModel;
use App\Models\PenerimaanModel;
use App\Models\CabangModel;
use App\Models\SettingModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\PequrbanModel;

class PenerimaanController extends BaseController
{
    protected $penerimaanModel;
    protected $cabangModel;
    protected $qurbanModel;
    protected $settingModel;
    protected $pequrbanModel;


    public function __construct()
    {
        $this->penerimaanModel = new PenerimaanModel();
        $this->cabangModel     = new CabangModel();
        $this->qurbanModel     = new QurbanModel();
        $this->settingModel    = new SettingModel();
        $this->pequrbanModel   = new PequrbanModel();
    }

    // ----------------------------------------------------------------
    // READ — tampilkan semua data + form tambah
    // ----------------------------------------------------------------
    public function index()
    {
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        // Mengambil target qurban dari PequrbanModel menggunakan getRekapPerCabang
        $rekapData = $this->pequrbanModel->getRekapPerCabang($tahun);
        $rekapPerCabang = $rekapData['rekap'];

        // Inisialisasi total target
        $target = (object)[
            'sapi_bumm'       => 0, // Ini akan menjadi total sapi utuh BUMM
            'sapib_bumm'      => 0, // Ini akan menjadi total peserta sapi BUMM
            'kambing_bumm'    => 0,
            'sapi_mandiri'    => 0,
            'kambing_mandiri' => 0,
        ];

        foreach ($rekapPerCabang as $rekap) {
            $target->sapib_bumm      += $rekap['sapi_bumm']; // Sum of individual BUMM sapi participants
            $target->kambing_bumm    += $rekap['kambing_bumm'];
            $target->sapi_mandiri    += $rekap['sapi_mandiri'];
            $target->kambing_mandiri += $rekap['kambing_mandiri'];
        }

        // Helper untuk format pecahan sapi (n/7)
        $formatSapi = function ($count) {
            $whole = intdiv($count, 7);
            $remain = $count % 7;
            if ($count == 0) return "0";
            if ($remain === 0) return (string)$whole;
            return ($whole > 0 ? $whole . ' ' : '') . $remain . '/7';
        };

        $target->sapi_bumm_raw = $target->sapib_bumm / 7;
        $target->sapi_mandiri_raw = $target->sapi_mandiri / 7;
        $target->sapi_bumm = $formatSapi($target->sapib_bumm);
        $target->sapi_mandiri = $formatSapi($target->sapi_mandiri);


        // Mengambil akumulasi penerimaan untuk ringkasan di view
        $total_sapi_bumm      = $this->penerimaanModel->where('cabang_id', 9999)->where('YEAR(created_at)', $tahun)->selectSum('sapi')->get()->getRow()->sapi ?? 0;
        $total_sapi_cabang    = $this->penerimaanModel->where('cabang_id !=', 9999)->where('YEAR(created_at)', $tahun)->selectSum('sapi')->get()->getRow()->sapi ?? 0;
        $total_kambing_bumm   = $this->penerimaanModel->where('cabang_id', 9999)->where('YEAR(created_at)', $tahun)->selectSum('kambing')->get()->getRow()->kambing ?? 0;
        $total_kambing_cabang = $this->penerimaanModel->where('cabang_id !=', 9999)->where('YEAR(created_at)', $tahun)->selectSum('kambing')->get()->getRow()->kambing ?? 0;

        $uang_bumm   = $this->penerimaanModel->where('cabang_id', 9999)->where('YEAR(created_at)', $tahun)->selectSum('pembayaran')->get()->getRow()->pembayaran ?? 0;
        $uang_cabang = $this->penerimaanModel->where('cabang_id !=', 9999)->where('YEAR(created_at)', $tahun)->selectSum('pembayaran')->get()->getRow()->pembayaran ?? 0;
        $total_shadaqah = $this->penerimaanModel->where('YEAR(created_at)', $tahun)->selectSum('shadaqoh')->get()->getRow()->shadaqoh ?? 0;

        // Menghitung total pembayaran (BUMM + Cabang) khusus untuk hari ini saja
        $today = date('Y-m-d');
        $uang_hari_ini = $this->penerimaanModel->where('DATE(created_at)', $today)->selectSum('pembayaran')->get()->getRow()->pembayaran ?? 0;
        $shadaqoh_hari_ini = $this->penerimaanModel->where('DATE(created_at)', $today)->selectSum('shadaqoh')->get()->getRow()->shadaqoh ?? 0;

        $data = [
            'title'  => 'Penerimaan Hewan',
            'navbar' => 'penerimaan',
            'active' => 'penerimaan',
            'tahun_selected' => $tahun,
            'penerimaan'     => $this->penerimaanModel
                ->select('penerimaan.*, cabang.nama_cabang')
                ->join('cabang', 'cabang.id = penerimaan.cabang_id', 'left')
                ->where('YEAR(penerimaan.created_at)', $tahun)
                ->orderBy('penerimaan.created_at', 'DESC')
                ->findAll(),
            'cabang'         => $this->cabangModel->findAll(),

            // Data Summary untuk Ringkasan Tabel di View
            'sapi_bumm'            => $target->sapi_bumm ?? 0,
            'sapi_bumm_raw'        => $target->sapi_bumm_raw ?? 0,
            'sapib_bumm'           => $target->sapib_bumm ?? 0,
            'kambing_bumm'         => $target->kambing_bumm ?? 0,
            'sapi_mandiri'         => $target->sapi_mandiri ?? 0,
            'sapi_mandiri_raw'     => $target->sapi_mandiri_raw ?? 0,
            'kambing_mandiri'      => $target->kambing_mandiri ?? 0,
            'total_sapi_bumm'      => $total_sapi_bumm,
            'total_sapi_cabang'    => $total_sapi_cabang,
            'total_kambing_bumm'   => $total_kambing_bumm,
            'total_kambing_cabang' => $total_kambing_cabang,
            'uang_bumm'            => $uang_bumm,
            'uang_cabang'          => $uang_cabang,
            'total_shadaqah'       => $total_shadaqah,
            'shadaqoh_hari_ini'    => $shadaqoh_hari_ini,
            'uang_hari_ini'        => $uang_hari_ini,
            'biaya'                => $this->settingModel->select('biaya')->first()['biaya'] ?? 0,
        ];

        return view('admin/penerimaan/index', $data);
    }

    // ----------------------------------------------------------------
    // CREATE — simpan data baru
    // ----------------------------------------------------------------
    public function create()
    {
        try {
            // Bersihkan input pembayaran dan shadaqoh dari karakter non-digit
            $pembayaran_clean = (float) preg_replace('/[^0-9]/', '', $this->request->getPost('pembayaran'));
            $shadaqoh_clean   = (float) preg_replace('/[^0-9]/', '', $this->request->getPost('shadaqoh'));

            $this->penerimaanModel->insert([
                'cabang_id'  => $this->request->getPost('cabang_id'),
                'pengirim'   => $this->request->getPost('pengirim'),
                'sapi'       => (int) $this->request->getPost('sapi'),
                'kambing'    => (int) $this->request->getPost('kambing'),
                'pembayaran' => $pembayaran_clean,
                'shadaqoh'   => $shadaqoh_clean,
                'tahun'      => date('Y'),
                'ket'        => $this->request->getPost('ket'),
            ]);

            return redirect()->to(base_url('penerimaan'))
                ->with('success', 'Data penerimaan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    // ----------------------------------------------------------------
    // UPDATE — simpan perubahan data
    // ----------------------------------------------------------------
    public function update($id)
    {
        $item = $this->penerimaanModel->find($id);

        if (! $item) {
            return redirect()->to('/penerimaan')
                ->with('error', 'Data tidak ditemukan.');
        }

        $this->penerimaanModel->update($id, [
            'cabang_id'  => $this->request->getPost('cabang_id'),
            'pengirim'   => $this->request->getPost('pengirim'),
            'sapi'       => (int) $this->request->getPost('sapi'),
            'kambing'    => (int) $this->request->getPost('kambing'),
            // Bersihkan input pembayaran dan shadaqoh dari karakter non-digit
            'pembayaran' => (float) preg_replace('/[^0-9]/', '', $this->request->getPost('pembayaran')),
            'shadaqoh'   => (float) preg_replace('/[^0-9]/', '', $this->request->getPost('shadaqoh')),
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
            $sheet->setCellValue([$col + 1, 1], $header);
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
            $sheet->setCellValue([1, $r], $i + 1);
            $sheet->setCellValue([2, $r], $row['cabang_id'] == 9999 ? 'BUMM' : $row['nama_cabang']);
            $sheet->setCellValue([3, $r], $row['pengirim']);
            $sheet->setCellValue([4, $r], $row['sapi']);
            $sheet->setCellValue([5, $r], $row['kambing']);
            $sheet->setCellValue([6, $r], $row['pembayaran']);
            $sheet->setCellValue([7, $r], $row['shadaqoh']);
            $sheet->setCellValue([8, $r], $row['ket']);
            $sheet->setCellValue([9, $r], $row['created_at']);
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
