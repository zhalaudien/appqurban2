<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiModel extends Model
{
    protected $table            = 'realisasi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'cabang_id',
        'R_TS',
        'R_TK',
        'R_A',
        'R_M',
        'R_OS',
        'R_OK',
        'R_K_S',
        'R_K_KB',
        'R_KK_S',
        'R_KLS'
    ];
    protected $useTimestamps = true;

    public function getRealisasi($tahun = null)
    {
        $builder = $this->db->table('cabang c');
        $builder->join('amprah a', 'a.cabang_id = c.id', 'left');
        $builder->join('realisasi r', 'r.cabang_id = c.id', 'left');
        $builder->where('c.pusat', 7);
        $builder->orderBy('c.nama_cabang', 'ASC');

        return $builder->get()->getResultArray();
    }

    public function getDataLengkap()
    {
        return $this->db->table('cabang c')
            ->select("
            c.id,
            c.nama_cabang,

            SUM(CASE WHEN p.jenis_hewan='sapi' THEN 1 ELSE 0 END) as TS,
            SUM(CASE WHEN p.jenis_hewan='kambing' THEN 1 ELSE 0 END) as TK,

            FLOOR(SUM(CASE WHEN p.jenis_hewan='sapi' THEN 1 ELSE 0 END)/7) as jumlah_sapi,
            SUM(CASE WHEN p.jenis_hewan='kambing' THEN 1 ELSE 0 END) as jumlah_kambing
        ")
            ->join('pequrban p', 'p.cabang_id = c.id', 'left')
            ->groupBy('c.id')
            ->where('c.pusat', 7)
            ->get()
            ->getResultArray();
    }
}
