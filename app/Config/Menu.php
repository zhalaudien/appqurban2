<?php

namespace Config;

class Menu
{
    public static function getSidebar($roleId)
    {
        $menus = [

            /*
            |--------------------------------------------------------------------------
            | ROLE 1 - SUPER ADMIN
            |--------------------------------------------------------------------------
            */

            1 => [

                [
                    'title' => 'Dashboard',
                    'icon'  => 'bi bi-speedometer',
                    'url'   => '/dashboard',
                    'key'   => 'dashboard'
                ],

                /*
                |==================== DATA ====================
                */
                [
                    'title' => 'Data',
                    'icon'  => 'bi bi-database',
                    'group' => 'data',
                    'children' => [

                        ['title' => 'Data Cabang',      'url' => '/cabang',      'key' => 'cabang', 'icon' => 'bi bi-building'],
                        ['title' => 'Data Panitia',     'url' => '/panitia',     'key' => 'panitia', 'icon' => 'bi bi-people'],
                        ['title' => 'Presensi Panitia', 'url' => '/presensi',    'key' => 'presensi', 'icon' => 'bi bi-check-circle'],
                        ['title' => 'Data Muspika',     'url' => '/muspika',     'key' => 'muspika', 'icon' => 'bi bi-person-badge'],

                    ]
                ],

                /*
                |==================== MASTER QURBAN ====================
                */
                [
                    'title' => 'Master Qurban',
                    'icon'  => 'bi bi-database',
                    'group' => 'qurban',
                    'children' => [

                        ['title' => 'Data Pequrban',        'url' => '/pequrban',   'key' => 'pequrban', 'icon' => 'bi bi-person'],
                        ['title' => 'Data Qurban Cabang',   'url' => '/qurban',     'key' => 'qurbancabang', 'icon' => 'bi bi-building'],
                        ['title' => 'Amprah Besek',         'url' => '/amprah',     'key' => 'amprah', 'icon' => 'bi bi-truck'],
                        ['title' => 'Realisasi Besek',      'url' => '/realisasi',  'key' => 'realisasi', 'icon' => 'bi bi-check-circle'],
                        ['title' => 'Jadwal Pengiriman',    'url' => '/jadwal',     'key' => 'jadwal',  'icon' => 'bi bi-calendar'],

                    ]
                ],

                /*
                |==================== PENERIMAAN ====================
                */
                [
                    'title' => 'Penerimaan',
                    'icon'  => 'bi bi-book',
                    'group' => 'penerimaan',
                    'children' => [

                        ['title' => 'Hewan Masuk', 'url' => '/penerimaan', 'key' => 'penerimaan', 'icon' => 'bi bi-box-fill'],
                        ['title' => 'Data Sapi',   'url' => '/datasapi',   'key' => 'datasapi', 'icon' => 'bi bi-box-fill'],
                        ['title' => 'Data Pengiriman hewan', 'url' => '/datahewan', 'key' => 'datahewan', 'icon' => 'bi bi-box-fill']

                    ]
                ],

                /*
                |==================== MENU TUNGGAL ====================
                */
                ['title' => 'Kandang',          'icon' => 'bi bi-box-fill', 'url' => '/kandang', 'key' => 'kandang'],
                ['title' => 'Produksi Besek',   'icon' => 'bi bi-box-fill', 'url' => '/besek',   'key' => 'besek'],
                ['title' => 'K3',               'icon' => 'bi bi-box-fill', 'url' => '/k3',      'key' => 'k3'],

                /*
                |==================== MASTER SURAT ====================
                */
                [
                    'title' => 'Master Surat',
                    'icon'  => 'bi bi-envelope-fill',
                    'group' => 'surat',
                    'children' => [

                        ['title' => 'Kirim Besek',      'url' => '/kirimbesek',   'key' => 'kirimbesek', 'icon' => 'bi bi-truck'],
                        ['title' => 'Kirim Kulit',      'url' => '/kirimkulit',   'key' => 'kirimkulit', 'icon' => 'bi bi-truck'],
                        ['title' => 'Surat Muspika',    'url' => '/suratmuspika', 'key' => 'suratmuspika', 'icon' => 'bi bi-envelope'],
                        ['title' => 'Surat Rekomendasi', 'url' => '/rekomendasi',  'key' => 'rekomendasi',  'icon' => 'bi bi-envelope'],

                    ]
                ],

                ['title' => 'Setting', 'icon' => 'bi bi-gear', 'url' => '/setting', 'key' => 'setting'],
            ],



            /*
            |--------------------------------------------------------------------------
            | ROLE 6 - ADMIN CABANG
            |--------------------------------------------------------------------------
            */

            6 => [

                [
                    'title' => 'Dashboard',
                    'icon'  => 'bi bi-speedometer2',
                    'url'   => 'dashboard',
                    'key'   => 'dashboard'
                ],


                [
                    'title' => 'Data Pequrban',
                    'icon'  => 'bi bi-person',
                    'url'   => 'pequrban',
                    'key'   => 'pequrban',

                ],

                [
                    'title' => 'Data Panitia',
                    'icon'  => 'bi bi-person',
                    'url'   => 'panitia',
                    'key'   => 'panitia',

                ],

                [
                    'title' => 'Amprah Besek',
                    'icon'  => 'bi bi-book-open',
                    'url'   => 'amprah',
                    'key'   => 'amprah',

                ],

                [
                    'title' => 'Profil Cabang',
                    'icon'  => 'bi bi-book-open',
                    'url'   => 'profilcabang',
                    'key'   => 'profilcabang',

                ],


            ],

        ];

        return $menus[$roleId] ?? [];
    }
}
