<?php

namespace App\Models;

use CodeIgniter\Model;

class AmprahModel extends Model
{
    protected $table            = 'amprah';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'cabang_id',
        'TS',
        'TK',
        'A',
        'M',
        'OS',
        'OK',
        'K_S',
        'K_KB',
        'KK_S',
        'KLS'
    ];
    protected $useTimestamps = true;

    public function getAmprah()
    {
        $builder = $this->db->table('cabang c');
        $builder->join('amprah a', 'a.cabang_id = c.id', 'left');
        $builder->join('realisasi r', 'r.cabang_id = c.id', 'left');
        $builder->where('c.pusat', 7);
        $builder->orderBy('c.nama_cabang', 'ASC');

        return $builder->get()->getResultArray();
    }
}
