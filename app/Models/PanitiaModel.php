<?php

namespace App\Models;

use CodeIgniter\Model;

class PanitiaModel extends Model
{
    protected $table = 'panitia';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama',
        'no_hp',
        'cabang_id',
        'seksi_id',
        'jabatan'
    ];

    protected $useTimestamps = true;

    public function getWithRelation($search = null, $cabangFilter = null)
    {
        $builder = $this->select('
                panitia.*,
                cabang.nama_cabang,
                seksi.nama_seksi
            ')
            ->join('cabang', 'cabang.id = panitia.cabang_id')
            ->join('seksi', 'seksi.id = panitia.seksi_id');

        if ($search) {
            $builder->groupStart()
                ->like('panitia.nama', $search)
                ->orLike('panitia.no_hp', $search)
                ->orLike('cabang.nama_cabang', $search)
                ->orLike('seksi.nama_seksi', $search)
                ->groupEnd();
        }

        if ($cabangFilter) {
            $builder->where('panitia.cabang_id', $cabangFilter);
        }

        return $builder->orderBy('panitia.nama', 'ASC')->findAll();
    }
}
