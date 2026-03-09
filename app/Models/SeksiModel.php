<?php

namespace App\Models;

use CodeIgniter\Model;

class SeksiModel extends Model
{
    protected $table            = 'seksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nama_seksi'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_seksi' => 'required|min_length[3]|is_unique[seksi.nama_seksi,id,{id}]'
    ];

    protected $validationMessages = [
        'nama_seksi' => [
            'required'   => 'Nama seksi wajib diisi',
            'min_length' => 'Minimal 3 karakter',
            'is_unique'  => 'Nama seksi sudah digunakan'
        ]
    ];

    /**
     * Ambil semua seksi urut A-Z
     */
    public function getAll()
    {
        return $this->orderBy('nama_seksi', 'ASC')->findAll();
    }

    /**
     * Ambil seksi untuk dropdown (id => nama)
     */
    public function getDropdown()
    {
        $data = $this->orderBy('nama_seksi', 'ASC')->findAll();

        $result = [];
        foreach ($data as $row) {
            $result[$row['id']] = $row['nama_seksi'];
        }

        return $result;
    }
}
