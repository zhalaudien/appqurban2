<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'setting';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['b_kb', 'b_sapi', 'j_h_1', 'j_h', 'j_h2', 'j_h3', 'j_h4', 'biaya', 'hari', 'jadwal'];

    public function EditSetting($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
}
