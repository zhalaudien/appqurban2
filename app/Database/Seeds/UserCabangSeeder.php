<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserCabangSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('users')->insert([
            'username'   => 'kedawung2',
            'password'   => password_hash('admin1234', PASSWORD_DEFAULT),
            'nama'       => 'Admin Cabang Kedawung 2',
            'role_id'    => 6,      // pastikan ini role admin cabang
            'cabang_id'  => 15,     // Kedawung 2
            'pusat'      => 7,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}
