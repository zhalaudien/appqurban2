<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'presensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'nama', 'cabang', 'seksi', 'presensi', 'date_inpt'];

    public function savePresensi($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
}
