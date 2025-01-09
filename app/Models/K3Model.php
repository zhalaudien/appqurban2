<?php

namespace App\Models;

use CodeIgniter\Model;

class K3Model extends Model
{
    protected $table            = 'seksi_k3';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['kepala_sapi', 'kepala_kambing', 'kulit_kambing', 'kulit_sapi', 'kaki_sapi'];

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