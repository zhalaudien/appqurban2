<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';

    protected $allowedFields = ['username', 'password'];

    protected $returnType     = 'array';
    protected $useTimestamps  = false;

    // Untuk menyimpan password secara otomatis dalam bentuk hash
    protected function beforeInsert(array $data)
    {
        $data = $this->hashPassword($data);
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->hashPassword($data);
        return $data;
    }

    // Aktifkan hooks
    protected $beforeInsert = ['encryptPassword'];
    protected $beforeUpdate = ['encryptPassword'];

    // Fungsi enkripsi password sebelum simpan/update
    protected function encryptPassword(array $data)
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['data']['password']); // Jangan ubah jika kosong
        }
        return $data;
    }
}
