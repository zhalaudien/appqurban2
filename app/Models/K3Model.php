<?php

namespace App\Models;

use CodeIgniter\Model;

class K3Model extends Model
{
    protected $table            = 'seksi_k3';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['ks', 'kb', 'kks', 'kls', 'klsb', 'date_input'];

    public function savek3($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatek3($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

}