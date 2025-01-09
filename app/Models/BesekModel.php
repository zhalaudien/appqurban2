<?php

namespace App\Models;

use CodeIgniter\Model;

class BesekModel extends Model
{
    protected $table            = 'produksibesek';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['date_input', 'ts', 'tk', 'm', 'os', 'ok'];

    public function saveBesek($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateBesek($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

}