<?php

namespace App\Models;

use CodeIgniter\Model;

class PequrbanModel extends Model
{
    protected $table            = 'pequrban';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'cabang_id',
        'nama',
        'jenis_hewan',   // sapi | kambing
        'sumber',        // mandiri | bumm
        'harga',
        'tahun',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /*
    |--------------------------------------------------------------------------
    | REKAP SUPERADMIN - JUMLAH HEWAN PER CABANG
    |--------------------------------------------------------------------------
    */

    public function getRekapPerCabang($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        $user  = session()->get('user');
        $pusat = $user['pusat'] ?? null;

        // Ambil daftar harga BUMM yang unik untuk tahun tersebut guna membangun kolom dinamis
        $priceRows = $this->db->table($this->table)
            ->select('jenis_hewan, harga')
            ->where('tahun', $tahun)
            ->where('sumber', 'bumm')
            ->groupBy('jenis_hewan, harga')
            ->orderBy('harga', 'ASC')
            ->get()->getResultArray();

        $priceColumns = "";
        foreach ($priceRows as $p) {
            $alias = "bumm_" . $p['jenis_hewan'] . "_" . $p['harga'];
            $priceColumns .= ", COALESCE(SUM(CASE WHEN p.jenis_hewan = " . $this->db->escape($p['jenis_hewan']) . " AND p.sumber = 'bumm' AND p.harga = " . (int)$p['harga'] . " THEN 1 ELSE 0 END), 0) AS `{$alias}`";
        }

        $builder = $this->db->table('cabang c');
        $builder->select("
            c.id,
            c.nama_cabang,
            j.id AS jadwal_id,
            j.antrian,
            j.kirim_hewan,
            j.kirim_besek,
            j.status AS status_jadwal,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS sapi_mandiri,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS kambing_mandiri,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' AND p.sumber = 'bumm' THEN 1 ELSE 0 END), 0) AS sapi_bumm,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' AND p.sumber = 'bumm' THEN 1 ELSE 0 END), 0) AS kambing_bumm,
            COALESCE(SUM(CASE WHEN p.sumber = 'bumm' THEN p.harga ELSE 0 END), 0) AS total_uang
            $priceColumns
        ");

        $builder->join('pequrban p', "p.cabang_id = c.id AND p.tahun = " . $this->db->escape($tahun), 'left');
        // Menggunakan subquery untuk memastikan hanya 1 baris jadwal yang di-join per cabang
        $builder->join('jadwal j', "j.id = (SELECT id FROM jadwal WHERE cabang_id = c.id AND tahun = " . $this->db->escape($tahun) . " ORDER BY id DESC LIMIT 1)", 'left');
        if ($pusat) {
            $builder->where('c.pusat', $pusat);
        }
        $builder->groupBy('c.id');
        $builder->orderBy('c.nama_cabang', 'ASC');

        return [
            'rekap'  => $builder->get()->getResultArray(),
            'prices' => $priceRows
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | REKAP BUMM - JUMLAH HEWAN
    |--------------------------------------------------------------------------
    */

    public function getRekapBumm($tahun = null)
    {
        $user  = session()->get('user');
        $pusat = $user['pusat'] ?? null;
        $tahun = $tahun ?? date('Y');

        $builder = $this->db->table('cabang c');
        $builder->select("
            c.id,
            c.nama_cabang,
            COALESCE(SUM(CASE WHEN LOWER(p.jenis_hewan) = 'sapi' AND LOWER(p.sumber) = 'bumm' THEN 1 ELSE 0 END), 0) AS sapi_bumm,
            COALESCE(SUM(CASE WHEN LOWER(p.jenis_hewan) = 'kambing' AND LOWER(p.sumber) = 'bumm' THEN 1 ELSE 0 END), 0) AS kambing_bumm,
            COALESCE(SUM(CASE WHEN LOWER(p.sumber) = 'bumm' THEN p.harga ELSE 0 END), 0) AS uang_bumm
        ");

        $builder->join('pequrban p', "p.cabang_id = c.id AND p.tahun = '$tahun'", 'left');
        if ($pusat) {
            $builder->where('c.pusat', $pusat);
        }
        $builder->groupBy('c.id');
        $builder->orderBy('c.nama_cabang', 'ASC');

        return $builder->get()->getResultArray();
    }

    /*
    |--------------------------------------------------------------------------
    | MASTER GRAND TOTAL - GABUNGAN PEQURBAN, AMPRAH, REALISASI, JADWAL
    |--------------------------------------------------------------------------
    */
    public function getMasterRekap($tahun = null)
    {
        $tahun = $tahun ?? date('Y');
        $user  = session()->get('user');
        $pusat = $user['pusat'] ?? null;

        $builder = $this->db->table('cabang c');
        $builder->select("
            c.id,
            c.nama_cabang,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS target_sapi_mandiri,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS target_kambing_mandiri,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' AND p.sumber = 'bumm' THEN 1 ELSE 0 END), 0) AS target_sapi_bumm,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' AND p.sumber = 'bumm' THEN 1 ELSE 0 END), 0) AS target_kambing_bumm,
            a.TS AS amprah_ts, a.TK AS amprah_tk, a.A AS amprah_a, a.M AS amprah_m, a.OS AS amprah_os, a.OK AS amprah_ok,
            a.K_S AS amprah_ks, a.K_KB AS amprah_kb, a.KK_S AS amprah_kks, a.KLS AS amprah_kls,
            r.id AS realisasi_id, r.R_TS AS real_ts, r.R_TK AS real_tk, r.R_A AS real_a, r.R_M AS real_m, r.R_OS AS real_os, r.R_OK AS real_ok,
            r.R_K_S AS real_ks, r.R_K_KB AS real_kb, r.R_KK_S AS real_kks, r.R_KLS AS real_kls,
            j.antrian, j.kirim_hewan, j.kirim_besek, j.status AS status_jadwal
        ", false);

        $builder->join('pequrban p', "p.cabang_id = c.id AND p.tahun = " . $this->db->escape($tahun), 'left');
        $builder->join('jadwal j', "j.id = (SELECT id FROM jadwal WHERE cabang_id = c.id ORDER BY id DESC LIMIT 1)", 'left');
        $builder->join('amprah a', "a.cabang_id = c.id", 'left');
        $builder->join('realisasi r', "r.cabang_id = c.id", 'left');

        if ($pusat) {
            $builder->where('c.pusat', $pusat);
        }
        $builder->groupBy('c.id, j.id, a.id, r.id');
        $builder->orderBy('c.nama_cabang', 'ASC');

        return $builder->get()->getResultArray();
    }


    /*
    |--------------------------------------------------------------------------
    | GRAND TOTAL SEMUA CABANG
    |--------------------------------------------------------------------------
    */

    public function getGrandTotal(int $tahun)
    {
        return $this->db->table($this->table)
            ->select("
                COUNT(*) AS total_semua,

                SUM(CASE WHEN jenis_hewan = 'sapi' THEN 1 ELSE 0 END) AS total_sapi,
                SUM(CASE WHEN jenis_hewan = 'kambing' THEN 1 ELSE 0 END) AS total_kambing,

                SUM(CASE WHEN sumber = 'mandiri' THEN 1 ELSE 0 END) AS total_mandiri,
                SUM(CASE WHEN sumber = 'bumm' THEN 1 ELSE 0 END) AS total_bumm
            ")
            ->where('tahun', $tahun)
            ->get()
            ->getRowArray();
    }


    /*
    |--------------------------------------------------------------------------
    | REKAP ADMIN CABANG - PEQURBAN CABANGNYA
    |--------------------------------------------------------------------------
    */
    public function getPerCabang($cabang_id, $tahun = null)
    {
        $tahun = $tahun ?? date('Y');

        return $this->db->table($this->table)
            ->where('cabang_id', $cabang_id)
            ->where('tahun', $tahun)
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->getResultArray();
    }
}
