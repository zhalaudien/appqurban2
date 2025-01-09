<?php

namespace App\Models;

use CodeIgniter\Model;

class KandangModel extends Model
{
    protected $table            = 'kandang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['date_input', 'sapi', 'kambing'];

    public function saveKandang($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateKandang($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
}