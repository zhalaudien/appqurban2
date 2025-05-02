<?php

namespace App\Models;

use CodeIgniter\Model;

class QurbanModel extends Model
{
    protected $table            = 'masterqurban';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cabang', 'sapi_bumm', 'sapib_bumm', 'kambing_bumm', 'sapi_mandiri', 'kambing_mandiri', 'p_ts', 'p_tk', 'p_a', 'p_os', 'p_ok', 'p_ks', 'p_kb', 'p_kks', 'p_kls', 'r_ts', 'r_tk', 'r_a', 'r_os', 'r_ok', 'r_ks', 'r_kb', 'r_kks', 'r_kls', 'antrian', 'kirim_hewan', 'kirim_besek', 'info', 'realisasi', 'status', 'date_input'];

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
