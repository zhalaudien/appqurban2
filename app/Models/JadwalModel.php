<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwalpengiriman';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cabang', 'antrian', 'kirim_hewan', 'kirim_besek', 'date_input'];

    public function savejadwal($data)
    {
        return $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updatejadwal($data, $id)
    {
        // Pastikan data adalah array dan kunci adalah string
        if (!is_array($data) || array_keys($data) !== array_filter(array_keys($data), 'is_string')) {
            throw new \InvalidArgumentException('Invalid data format. Keys must be strings.');
        }
    
        // Pastikan ID valid dan berupa string atau integer
        if (!is_int($id) && !is_string($id)) {
            throw new \InvalidArgumentException('Invalid ID format.');
        }
    
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }
}