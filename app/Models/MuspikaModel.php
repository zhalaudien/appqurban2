<?php

namespace App\Models;

use CodeIgniter\Model;

class MuspikaModel extends Model
{
    protected $table            = 'datamuspika';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama', 'dinas', 'pj', 'date_input'];

    public function saveMuspika($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateMuspika($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

}