<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaanModel extends Model
{
    protected $table            = 'penerimaan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cabang', 'pengirim', 'sapi', 'kambing', 'shadaqoh', 'pembayaran', 'ket', 'date_input'];

    public function savePenerimaan($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatePenerimaan($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
}
