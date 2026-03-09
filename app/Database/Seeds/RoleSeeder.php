<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['role_key' => 'superadmin', 'role_name' => 'Super Admin'],
            ['role_key' => 'adminpenerimaan', 'role_name' => 'Admin Penerimaan'],
            ['role_key' => 'adminkandang', 'role_name' => 'Admin Kandang'],
            ['role_key' => 'admink3', 'role_name' => 'Admin K3'],
            ['role_key' => 'adminbesek', 'role_name' => 'Admin Besek'],
            ['role_key' => 'admincabang', 'role_name' => 'Admin Cabang'],
            ['role_key' => 'adminbumm', 'role_name' => 'Admin BUMM'],
        ];
        $this->db->table('roles')->insertBatch($data);
    }
}
