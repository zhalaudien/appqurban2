<?php

namespace App\Controllers\Admin\Data;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PresensiModel;
use App\Models\PanitiaModel;
use App\Models\SeksiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PresensiController extends BaseController
{
    public function index()
    {
        $seksiModel = new SeksiModel();
        $panitiaModel = new PanitiaModel();
        $presensiModel = new PresensiModel();

        $seksiId = $this->request->getVar('seksi_id');
        $today = date('Y-m-d');

        $data = [
            'title'       => 'Presensi Panitia',
            'navbar'      => 'data',
            'active'      => 'presensi',
            'seksi_list'  => $seksiModel->orderBy('nama_seksi', 'ASC')->findAll(),
            'seksi_id'    => $seksiId,
            // Menghitung statistik kehadiran harian per seksi
            'summary'     => $presensiModel->select('seksi, COUNT(*) as total')
                ->where('date_input', $today)
                ->where('presensi', 'hadir')
                ->groupBy('seksi')
                ->findAll(),
            'total_today' => $presensiModel->where('date_input', $today)
                ->where('presensi', 'hadir')
                ->countAllResults(),
        ];

        // Jika seksi dipilih, ambil daftar panitia di seksi tersebut
        if ($seksiId) {
            $data['panitia_list'] = $panitiaModel->select('panitia.*, seksi.nama_seksi, cabang.nama_cabang')
                ->join('seksi', 'seksi.id = panitia.seksi_id')
                ->join('cabang', 'cabang.id = panitia.cabang_id')
                ->where('seksi_id', $seksiId)
                ->orderBy('nama', 'ASC')
                ->findAll();
        }

        return view("admin/data/presensi/index", $data);
    }

    public function create()
    {
        $presensiModel = new PresensiModel();
        $attendees = $this->request->getPost('attendance');
        $today = date('Y-m-d');

        if (!$attendees) {
            return redirect()->back()->with('error', 'Pilih setidaknya satu panitia.');
        }

        foreach ($attendees as $val) {
            if (isset($val['status']) && $val['status'] == 'hadir') {
                // Cek agar tidak terjadi double input di hari yang sama
                $exists = $presensiModel->where(['nama' => $val['nama'], 'date_input' => $today])->first();

                if (!$exists) {
                    $presensiModel->insert([
                        'nama'       => $val['nama'],
                        'cabang'     => $val['cabang'],
                        'seksi'      => $val['seksi'],
                        'presensi'   => 'hadir',
                        'date_input' => $today
                    ]);
                }
            }
        }

        return redirect()->to(base_url('presensi'))->with('success', 'Presensi berhasil disimpan.');
    }
}
