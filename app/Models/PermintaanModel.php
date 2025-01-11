<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanModel extends Model
{
    protected $table            = 'permintaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cabang', 'ts', 'tk', 'a', 'os', 'ok', 'ks', 'kb', 'kks', 'kls', 'date_input'];

    public function savepermintaan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

}