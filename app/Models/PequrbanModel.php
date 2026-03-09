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
        $pusat = session()->get('user')['pusat'];
        $builder = $this->db->table('cabang c');

        $builder->select("
        c.id,
        c.nama_cabang,
        COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' THEN 1 ELSE 0 END), 0) AS total_sapi,
        COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' THEN 1 ELSE 0 END), 0) AS total_kambing,
        COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS sapi_mandiri,
        COALESCE(SUM(CASE WHEN p.jenis_hewan = 'sapi' AND p.sumber = 'bumm' THEN 1 ELSE 0 END), 0) AS sapi_bumm,
        COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' AND p.sumber = 'mandiri' THEN 1 ELSE 0 END), 0) AS kambing_mandiri,
        COALESCE(SUM(CASE WHEN p.jenis_hewan = 'kambing' AND p.sumber = 'bumm' THEN 1 ELSE 0 END), 0) AS kambing_bumm
    ");

        $builder->join('pequrban p', 'p.cabang_id = c.id AND p.tahun = ' . ($tahun ? $tahun : 'YEAR(NOW())'), 'left');
        $builder->where('c.pusat', $pusat);
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
