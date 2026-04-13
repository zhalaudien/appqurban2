<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table      = 'setting';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'b_kb',        // besek kambing
        'b_sapi',      // besek sapi
        'j_h_1',
        'j_h',
        'j_h2',
        'j_h3',
        'j_h4',
        'biaya',
        'hari',
        'jadwal',
        'access_password',
    ];

    public function getValue($key)
    {
        return $this->where('access_password', $key)
            ->first()['value'] ?? null;
    }
}
