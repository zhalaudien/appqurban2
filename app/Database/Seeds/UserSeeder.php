<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'nama' => 'Super Admin',
            'role_id' => 1,
            'cabang_id' => null,
            'pusat' => 7,
        ]);
        $this->db->table('users')->insert([
            'username' => 'superadmin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'nama' => 'Super Admin',
            'role_id' => 1,
            'cabang_id' => null,
            'pusat' => null,
        ]);
    }
}
