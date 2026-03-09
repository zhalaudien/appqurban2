<?php

namespace App\Services\Cabang;

use App\Models\PequrbanModel;
use App\Models\PermintaanBesekModel;
use App\Models\JadwalPengirimanModel;

class DashboardService
{
    public function getSummary($user)
    {
        $cabangId = $user['cabang_id'];

        // Pequrban
        $pequrban = (new PequrbanModel())
            ->where('cabang_id', $cabangId)
            ->countAllResults();

        // Hewan
        $sapi = (new PequrbanModel())
            ->where('cabang_id', $cabangId)
            ->where('jenis_hewan', 'sapi')
            ->countAllResults();

        $kambing = (new PequrbanModel())
            ->where('cabang_id', $cabangId)
            ->where('jenis_hewan', 'kambing')
            ->countAllResults();


        return [
            'title' => 'Dashboard Cabang',
            'pequrban' => $pequrban,
            'sapi' => $sapi,
            'kambing' => $kambing,
            'cabang' => $user['cabang']
        ];
    }
}
