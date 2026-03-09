<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['username', 'password', 'nama', 'role_id', 'cabang_id', 'pusat'];
    protected $useTimestamps = true;

    public function getByUsername($username)
    {
        return $this->select('users.*, roles.role_key, cabang.nama_cabang')
            ->join('roles', 'roles.id = users.role_id')
            ->join('cabang', 'cabang.id = users.cabang_id', 'left')
            ->join('pusat', 'pusat.id = cabang.pusat', 'left')
            ->where('username', $username)
            ->first();
    }
}
