<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran_bumm';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_cabang', 'nama', 'pembayaran', 'keterangan', 'catatan', 'tahun', 'created_at', 'updated_at'];
}
