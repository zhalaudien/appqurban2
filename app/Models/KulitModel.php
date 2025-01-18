<?php

namespace App\Models;

use CodeIgniter\Model;

class KulitModel extends Model
{
    protected $table            = 'kirimkulit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['jumlah', 'date_input'];

    public function savekulit($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }


}