<?php

namespace App\Models;

use CodeIgniter\Model;

class QurbanModel extends Model
{
    protected $table            = 'dataqurban';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'cabang', 'sapi_bumm', 'sapib_bumm', 'kambing_bumm', 'sapi_mandiri', 'kambing_mandiri', 'info', 'date_input'];

    public function saveQurban($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateQurban($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
}