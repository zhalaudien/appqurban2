<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiModel extends Model
{
    protected $table            = 'realisasi_besek';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['ts', 'tk', 'a', 'os', 'ok', 'ks', 'kb', 'kks', 'kls', 'realisasi', 'info_kirim', 'date_input'];

    public function saveRealisasi($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateRealisasi($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

}