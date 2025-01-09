<?php

namespace App\Models;

use CodeIgniter\Model;

class IdpantiaModel extends Model
{
    protected $table            = 'id_panitia';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'seksi'];
    
}