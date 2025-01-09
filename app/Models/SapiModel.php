<?php

namespace App\Models;

use CodeIgniter\Model;

class SapiModel extends Model
{
    protected $table            = 'data_sapi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cabang', 'harga', 'berat', 'nomor', 'date_input'];

    public function saveSapi($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateSapi($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

}