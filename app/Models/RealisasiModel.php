<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiModel extends Model
{
    protected $table            = 'realisasi_besek';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['cabang', 'ts', 'tk', 'a', 'os', 'ok', 'ks', 'kb', 'kks', 'kls', 'realisasi', 'info_kirim', 'date_input'];

    public function saverealisasi($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function editrealisasi($id, $data)
    {
        // Pastikan $data memiliki kunci string
        if (!is_array($data) || array_keys($data) !== array_filter(array_keys($data), 'is_string')) {
            throw new \InvalidArgumentException('Invalid data format. Keys must be strings.');
        }

        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

}