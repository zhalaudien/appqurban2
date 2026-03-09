<?php

namespace App\Services;

use App\Models\PequrbanModel;

class PequrbanService
{
    public function getAll($user)
    {
        return (new PequrbanModel())
            ->where('cabang_id', $user['cabang_id'])
            ->findAll();
    }

    public function store($data, $user)
    {
        $data['cabang_id'] = $user['cabang_id'];
        return (new PequrbanModel())->insert($data);
    }
}
