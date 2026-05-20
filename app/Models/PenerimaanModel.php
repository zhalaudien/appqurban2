<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaanModel extends Model
{
    protected $table         = 'penerimaan';
    protected $primaryKey    = 'id';
    protected $useAutoIncrement = true;
    protected $returnType    = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'cabang_id',
        'pengirim',
        'sapi',
        'kambing',
        'pembayaran',
        'shadaqoh',
        'ket',
        'created_at',
        'updated_at',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validasi level model (opsional, bisa juga di controller)
    protected $validationRules = [];
    protected $validationMessages = [];
}
