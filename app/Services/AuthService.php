<?php

namespace App\Services;

use App\Models\UserModel;

class AuthService
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function attempt(string $username, string $password): bool
    {
        $user = $this->userModel
            ->where('username', $username)
            ->first();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        // 🔐 SESSION FINAL (KONSISTEN)
        session()->set('user', [
            'id'        => $user['id'],
            'username'  => $user['username'],
            'nama'      => $user['nama'],
            'role_id'   => $user['role_id'],
            'cabang_id' => $user['cabang_id'],
            'pusat'    => $user['pusat']
        ]);

        return true;
    }
}
