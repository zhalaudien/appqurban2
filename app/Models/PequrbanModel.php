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
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS sapi_mandiri,
            COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS kambing_mandiri,
            COALESCE(SUM(CASE WHEN p.sumber = 'bumm' THEN p.harga ELSE 0 END), 0) AS total_uang
            $priceColumns
        ");

        $builder->join('pequrban p', "p.cabang_id = c.id AND p.tahun = " . $this->db->escape($tahun), 'left');
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
