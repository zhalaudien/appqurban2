<?php

namespace App\Models;

use CodeIgniter\Model;

class PanitiaModel extends Model
{
    protected $table            = 'datapanitia';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama', 'cabang', 'no_hp', 'seksi', 'ket', 'date_input'];

    public function savePanitia($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePanitia($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

}