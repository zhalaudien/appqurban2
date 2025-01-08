<?php

namespace App\Models;

use CodeIgniter\Model;

class CabangModel extends Model
{
    protected $table            = 'datacabang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cabang', 'ketua_cabang', 'no_hp', 'panitia_qurban', 'no2_hp', 'alamat', 'perwakilan', 'date_input'];

    public function saveCabang($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateCabang($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
}