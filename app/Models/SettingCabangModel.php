<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingCabangModel extends Model
{
    protected $table      = 'profilcabang';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'cabang_id',
        'alamat',
        'ketua',
        'ketua_hp',
        'panitia_nama',
        'panitia_hp',
        'it_nama',
        'it_hp',
        'perwakilan',
        'created_at',
        'updated_at'
    ];
}
