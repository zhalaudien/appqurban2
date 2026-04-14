<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'roles';
    protected $primary = 'id';
    protected $allowedFields = ['role_key', 'role_name', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
