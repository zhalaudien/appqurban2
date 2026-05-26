<?php

namespace App\Controllers;

use App\Models\RealisasiModel;
use App\Models\QurbanModel;
use CodeIgniter\Controller;
use App\Models\SapiModel;
use App\Models\PenerimaanModel;
use App\Models\PanitiaModel;
use App\Models\CabangModel;
use App\Models\KandangModel;
use App\Models\BesekModel;
use App\Models\K3Model;
use App\Models\MuspikaModel;
use App\Models\SettingModel;
use App\Models\PequrbanModel;
use App\Models\JadwalModel;
use CodeIgniter\Commands\Database\Seed;

class Home extends Controller
{
    public function index()
    {
        $userModel = new PanitiaModel();
        $data['jumlahpanitia'] = $userModel->get()->getNumRows();

        $userModel = new CabangModel();
        $data['jumlahcabang'] = $userModel->get()->getNumRows();

        $userModel = new MuspikaModel();
        $data['jumlahmuspika'] = $userModel->get()->getNumRows();

        $pequrbanModel = new PequrbanModel();
        $tahun = date('Y');
        $data['sapib_bumm']      = $pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'sapi', 'sumber' => 'bumm'])->countAllResults() % 7;
        $data['sapi_bumm']       = intdiv($pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'sapi', 'sumber' => 'bumm'])->countAllResults(), 7);
        $data['kambing_bumm']    = $pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'kambing', 'sumber' => 'bumm'])->countAllResults();
        $data['sapi_mandiri']    = intdiv($pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'sapi', 'sumber' => 'mandiri'])->countAllResults(), 7);
        $data['kambing_mandiri'] = $pequrbanModel->where(['tahun' => $tahun, 'jenis_hewan' => 'kambing', 'sumber' => 'mandiri'])->countAllResults();

        $realisasiModel = new RealisasiModel();
        $realStats = $realisasiModel->selectSum('R_TS', 'ts')->selectSum('R_TK', 'tk')->selectSum('R_A', 'a')->selectSum('R_OS', 'os')->selectSum('R_OK', 'ok')
            ->selectSum('R_K_S', 'ks')->selectSum('R_K_KB', 'kb')->selectSum('R_KK_S', 'kks')->selectSum('R_KLS', 'kls')->get()->getRow();

        $data['t_ts'] = $realStats->ts ?? 0;
        $data['t_tk'] = $realStats->tk ?? 0;
        $data['t_a']  = $realStats->a ?? 0;
        $data['t_os'] = $realStats->os ?? 0;
        $data['t_ok'] = $realStats->ok ?? 0;
        $data['t_ks'] = $realStats->ks ?? 0;
        $data['t_kb'] = $realStats->kb ?? 0;
        $data['t_kks'] = $realStats->kks ?? 0;
        $data['t_kls'] = $realStats->kls ?? 0;

        $userModel = new PenerimaanModel();
        $data['viewpenerimaan'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['total_sapi_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_sapi_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_kambing_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('kambing')->get()->getRow()->kambing;
        $data['total_kambing_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('kambing')->get()->getRow()->kambing;
        $data['uang_bumm'] = $userModel->where('cabang', 'BUMM Sragen')->selectSum('pembayaran')->get()->getRow()->pembayaran;
        $data['uang_cabang'] = $userModel->where('cabang !=', 'BUMM Sragen')->selectSum('pembayaran')->get()->getRow()->pembayaran;
        $data['shadaqoh'] = $userModel->selectSum('shadaqoh')->get()->getRow()->shadaqoh;
        $data['total_sapi'] = $userModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['total_kambing'] = $userModel->selectSum('kambing')->get()->getRow()->kambing;

        $userModel = new KandangModel();
        $data['viewkandang'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['disembelih_sapi'] = $userModel->selectSum('sapi')->get()->getRow()->sapi;
        $data['disembelih_kambing'] = $userModel->selectSum('kambing')->get()->getRow()->kambing;

        $userModel = new BesekModel();
        $data['viewbesek'] = $userModel->orderBy('date_input', 'DESC')->findAll();
        $data['ts'] = $userModel->selectSum('ts')->get()->getRow()->ts;
        $data['tk'] = $userModel->selectSum('tk')->get()->getRow()->tk;
        $data['a'] = $userModel->selectSum('a')->get()->getRow()->a;
        $data['os'] = $userModel->selectSum('os')->get()->getRow()->os;
        $data['ok'] = $userModel->selectSum('ok')->get()->getRow()->ok;


        $userModel = new K3Model();
        $data['ks'] = $userModel->selectSum('ks')->get()->getRow()->ks;
        $data['kb'] = $userModel->selectSum('kb')->get()->getRow()->kb;
        $data['kks'] = $userModel->selectSum('kks')->get()->getRow()->kks;
        $data['kls'] = $userModel->selectSum('kls')->get()->getRow()->kls;

        $header = [
            'title' => 'Home',
            'navbar' => 'home',
            'active' => 'home'
        ];

        echo view("homepage/header", $header);
        echo view("homepage/index", $data);
        echo view("homepage/footer");
    }

    public function jadwal()
    {
        $header = [
            'title' => 'Jadwal Pengiriman',
            'navbar' => 'jadwal2',
            'active' => 'jadwal2'
        ];

        $settingModel = new SettingModel();
        $rowSetting = $settingModel->first();
        $data['s_jadwal'] = $rowSetting['jadwal'] ?? '';

        $db = \Config\Database::connect();
        $tahun = date('Y');

        $days = ['h1', 'h2', 'h3', 'h4'];
        foreach ($days as $day) {
            $builder = $db->table('cabang c');
            $builder->select('
                c.nama_cabang as cabang,
                j.kirim_hewan,
                j.kirim_besek,
                COALESCE(SUM(CASE WHEN p.jenis_hewan = \'sapi\' AND p.sumber = \'bumm\' THEN 1 ELSE 0 END), 0) as sapib_bumm_raw,
                COALESCE(SUM(CASE WHEN p.jenis_hewan = \'kambing\' AND p.sumber = \'bumm\' THEN 1 ELSE 0 END), 0) as kambing_bumm,
                COALESCE(SUM(CASE WHEN p.jenis_hewan = \'sapi\' AND p.sumber = \'mandiri\' THEN 1 ELSE 0 END), 0) as sapi_mandiri_raw,
                COALESCE(SUM(CASE WHEN p.jenis_hewan = \'kambing\' AND p.sumber = \'mandiri\' THEN 1 ELSE 0 END), 0) as kambing_mandiri
            ');
            $builder->join('jadwal j', 'j.cabang_id = c.id', 'left');
            $builder->join('pequrban p', 'p.cabang_id = c.id AND p.tahun = ' . $db->escape($tahun), 'left');
            $builder->where('c.pusat', 7);
            $builder->like('j.kirim_besek', $day);
            $builder->groupBy('c.id, j.id');
            $builder->orderBy('j.kirim_hewan', 'ASC');

            $results = $builder->get()->getResultArray();

            $sapi_bumm_tot = 0;
            $sapib_bumm_tot = 0;
            $kambing_bumm_tot = 0;
            $sapi_mandiri_tot = 0;
            $kambing_mandiri_tot = 0;

            foreach ($results as &$r) {
                $r['sapi_bumm'] = intdiv($r['sapib_bumm_raw'], 7);
                $r['sapib_bumm'] = $r['sapib_bumm_raw'] % 7;
                $r['sapi_mandiri'] = intdiv($r['sapi_mandiri_raw'], 7);

                $sapi_bumm_tot += $r['sapi_bumm'];
                $sapib_bumm_tot += $r['sapib_bumm'];
                $kambing_bumm_tot += $r['kambing_bumm'];
                $sapi_mandiri_tot += $r['sapi_mandiri'];
                $kambing_mandiri_tot += $r['kambing_mandiri'];
            }

            $data[$day] = $results;
            $data['sapi_bumm_' . $day] = $sapi_bumm_tot;
            $data['sapib_bumm_' . $day] = $sapib_bumm_tot;
            $data['kambing_bumm_' . $day] = $kambing_bumm_tot;
            $data['sapi_mandiri_' . $day] = $sapi_mandiri_tot;
            $data['kambing_mandiri_' . $day] = $kambing_mandiri_tot;
        }

        echo view("homepage/header", $header);
        echo view("homepage/jadwal", $data);
        echo view("homepage/footer");
    }

    public function datasapi()
    {
        $header = [
            'title' => 'Data Sapi',
            'navbar' => 'datasapi2',
            'active' => 'datasapi2'
        ];

        $userModel = new SapiModel();
        $data['viewsapi'] = $userModel->orderBy('date_input', 'DESC')->findAll() ?? 0;

        echo view("homepage/header", $header);
        echo view("homepage/datasapi", $data);
        echo view("homepage/footer");
    }

    public function dataqurban()
    {
        $header = [
            'title' => 'Data Qurban',
            'navbar' => 'dataqurban',
            'active' => 'dataqurban'
        ];

        $pequrbanModel = new PequrbanModel();
        $tahun = date('Y');
        $rekap = $pequrbanModel->getRekapPerCabang($tahun)['rekap'];

        foreach ($rekap as &$r) {
            $r['cabang'] = $r['nama_cabang'];
            $total_sapi_bumm = $r['sapi_bumm'];
            $r['sapi_bumm'] = intdiv($total_sapi_bumm, 7);
            $r['sapib_bumm'] = $total_sapi_bumm % 7;
            $r['sapi_mandiri'] = intdiv($r['sapi_mandiri'], 7);
        }
        $data['qurban'] = $rekap;

        echo view("homepage/header", $header);
        echo view("homepage/dataqurban", $data);
        echo view("homepage/footer");
    }

    public function realisasi()
    {
        $header = [
            'title' => 'Realisasi Besek',
            'navbar' => 'realisasi',
            'active' => 'realisasi',
            'auto_refresh' => 'true'
        ];

        $settingModel = new SettingModel();
        $rowSetting = $settingModel->select('hari')->first();
        $s_hari = $rowSetting['hari'] ?? '';
        $data['s_hari'] = $s_hari;

        $db     = \Config\Database::connect();
        $tahun  = date('Y');

        $groups = explode(',', $s_hari);
        foreach ($groups as $hari) {
            $keyword = trim($hari);
            if (empty($keyword)) continue;

            // Query Manual untuk menggabungkan Cabang, Realisasi, dan Jadwal
            // Pastikan filter tahun dilakukan pada join jadwal dan realisasi
            $builder = $db->table('cabang c');
            $builder->select('
                c.nama_cabang as cabang,
                COALESCE(r.R_TS, 0) as r_ts,
                COALESCE(r.R_TK, 0) as r_tk,
                COALESCE(r.R_A, 0) as r_a,
                COALESCE(r.R_OS, 0) as r_os,
                COALESCE(r.R_OK, 0) as r_ok,
                COALESCE(r.R_K_S, 0) as r_ks,
                COALESCE(r.R_K_KB, 0) as r_kb,
                COALESCE(r.R_KK_S, 0) as r_kks,
                COALESCE(r.R_KLS, 0) as r_kls,
                j.antrian,
                j.status
            ');
            $builder->join('realisasi r', 'r.cabang_id = c.id', 'left');
            $builder->join('jadwal j', 'j.cabang_id = c.id', 'left');
            $builder->where('c.pusat', 7);
            $builder->like('j.kirim_besek', $keyword);
            $builder->orderBy('j.antrian', 'ASC');

            $data[$keyword] = $builder->get()->getResultArray();
        }

        echo view("homepage/header", $header);
        echo view("homepage/realisasi", $data);
        echo view("homepage/footer");
    }
}
