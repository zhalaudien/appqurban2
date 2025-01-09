<?php

namespace App\Models;

use CodeIgniter\Model;

class AmparahModel extends Model
{
    protected $table            = 'permohonan_besek';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['p_ts', 'p_tk', 'p_a', 'p_os', 'p_ok', 'p_ks', 'p_kb', 'p_kks', 'p_kls', 'info', 'date_input'];

    public function saveamprah($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateamprah($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

}