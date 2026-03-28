<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserBummSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'username'   => 'bumm',
            'password'   => password_hash('admin1234', PASSWORD_DEFAULT),
            'nama'       => 'Admin bumm',
            'role_id'    => 7,      // pastikan ini role admin bumm
            'cabang_id'  => null,
            'pusat'      => null,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
