<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'cabang_id',
        'antrian',
        'kirim_hewan',
        'kirim_besek',
        'status',
    ];

    protected $useTimestamps = true;

    public function getJadwal()
    {
        $builder = $this->db->table('cabang c');
        $builder->join('jadwal a', 'a.cabang_id = c.id', 'left');
        $builder->where('c.pusat', 7);
        $builder->orderBy('c.nama_cabang', 'ASC');

        return $builder->get()->getResultArray();
    }
}
