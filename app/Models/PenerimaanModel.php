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
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validasi level model (opsional, bisa juga di controller)
    protected $validationRules = [
        'cabang_id'  => 'required',
        'pengirim'   => 'required|min_length[3]|max_length[100]',
        'sapi'       => 'required|integer|greater_than_equal_to[0]',
        'kambing'    => 'required|integer|greater_than_equal_to[0]',
        'pembayaran' => 'required|integer|greater_than_equal_to[0]',
        'shadaqoh'   => 'required|integer|greater_than_equal_to[0]',
    ];

    protected $validationMessages = [
        'cabang_id' => ['required' => 'Cabang wajib dipilih.'],
        'pengirim'  => ['required' => 'Nama pengirim wajib diisi.'],
        'sapi'      => ['required' => 'Jumlah sapi wajib diisi.'],
        'kambing'   => ['required' => 'Jumlah kambing wajib diisi.'],
        'pembayaran' => ['required' => 'Pembayaran wajib diisi.'],
        'shadaqoh'  => ['required' => 'Shadaqoh wajib diisi.'],
    ];
}
