<?php

use App\Controllers\PequrbanController;
use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Router\Router;

/**
 * @var RouteCollection $routes
 */

// =====================================================
// PUBLIC ROUTES
// =====================================================
$routes->get('/', 'Home::index');
$routes->get('jadwal2', 'Home::jadwal');
$routes->get('datasapi', 'Home::datasapi');
$routes->get('dataqurban', 'Home::dataqurban');
$routes->get('realisasi2', 'Home::realisasi');


// =====================================================
// AUTH ROUTES
// =====================================================
$routes->group('', function ($routes) {
    $routes->get('login', 'Auth\LoginController::index');
    $routes->post('login', 'Auth\LoginController::authenticate');
    $routes->get('logout', 'Auth\LoginController::logout');
});


// =====================================================
// PROTECTED ROUTES (AUTH REQUIRED)
// =====================================================
$routes->group('', ['filter' => 'role:1'], function ($routes) {

    // --------------------
    // DASHBOARD
    // --------------------
    $routes->get('admin', 'Admin\DashboardController::index');

    // =================================================
    // MASTER DATA GROUP
    // =================================================
    $routes->group('panitia', function ($routes) {
        $routes->get('/', 'Admin\Data\PanitiaController::index');
        $routes->post('create', 'Admin\Data\PanitiaController::create');
        $routes->post('update/(:num)', 'Admin\Data\PanitiaController::update/$1');
        $routes->get('delete/(:num)', 'Admin\Data\PanitiaController::delete/$1');
        $routes->get('export', 'Admin\Data\PanitiaController::export');
    });

    $routes->group('cabang', function ($routes) {
        $routes->get('/', 'Admin\Data\CabangController::index');
        $routes->post('create', 'Admin\Data\CabangController::create');
        $routes->post('update/(:num)', 'Admin\Data\CabangController::update/$1');
        $routes->get('delete/(:num)', 'Admin\Data\CabangController::delete/$1');
        $routes->get('export', 'Admin\Data\CabangController::export');
    });

    $routes->group('muspika', function ($routes) {
        $routes->get('/', 'Admin\Data\MuspikaController::index');
        $routes->post('create', 'Admin\Data\MuspikaController::create');
        $routes->post('update/(:num)', 'Admin\Data\MuspikaController::update/$1');
        $routes->get('delete/(:num)', 'Admin\Data\MuspikaController::delete/$1');
        $routes->get('export', 'Admin\Data\MuspikaController::export');
    });

    // =================================================
    // MASTER QURBAN
    // =================================================

    $routes->group('pequrban', function ($routes) {
        $routes->get('/', 'Admin\Master\PequrbanController::index');
        $routes->post('create', 'Admin\Master\PequrbanController::store');
        $routes->post('update/(:num)', 'Admin\Master\PequrbanController::update/$1');
        $routes->get('delete/(:num)', 'Admin\Master\PequrbanController::delete/$1');
        $routes->get('export', 'Admin\Master\PequrbanController::export');
    });

    $routes->group('qurban', function ($routes) {
        $routes->get('/', 'Admin\Master\QurbanCabangController::index');
        $routes->get('export', 'Admin\Master\QurbanCabangController::export');
    });

    $routes->group('amprah', function ($routes) {
        $routes->get('/', 'Admin\Master\AmprahController::index');
        $routes->get('update/(:num)', 'Admin\Master\AmprahController::update/$1');
        $routes->get('export', 'Admin\Master\AmprahController::export');
    });

    $routes->group('realisasi', function ($routes) {
        $routes->get('/', 'Admin\Master\RealisasiController::index');
        $routes->post('update/(:num)', 'Admin\Master\RealisasiController::update/$1');
        $routes->get('export', 'Admin\Master\RealisasiController::export');
    });

    $routes->group('jadwal', function ($routes) {
        $routes->get('/', 'Admin\Master\JadwalController::index');
        $routes->post('update/(:num)', 'Admin\Master\JadwalController::update/$1');
        $routes->get('export', 'Admin\Master\JadwalController::export');
    });

    // =================================================
    // TRANSAKSI
    // =================================================
    $routes->group('penerimaan', function ($routes) {
        $routes->get('/', 'Penerimaan::index');
        $routes->post('create', 'Penerimaan::create');
        $routes->post('update/(:num)', 'Penerimaan::update/$1');
        $routes->get('delete/(:num)', 'Penerimaan::delete/$1');
        $routes->get('export', 'Penerimaan::export');
        $routes->get('print/(:num)', 'Penerimaan::print/$1');
    });

    $routes->group('kandang', function ($routes) {
        $routes->get('/', 'Kandang::index');
        $routes->post('create', 'Kandang::create');
        $routes->post('update/(:num)', 'Kandang::update/$1');
        $routes->get('delete/(:num)', 'Kandang::delete/$1');
        $routes->get('export', 'Kandang::export');
    });

    $routes->group('besek', function ($routes) {
        $routes->get('/', 'Besek::index');
        $routes->post('create', 'Besek::create');
        $routes->post('update/(:num)', 'Besek::update/$1');
        $routes->get('delete/(:num)', 'Besek::delete/$1');
        $routes->get('export', 'Besek::export');
    });


    // =================================================
    // SURAT
    // =================================================
    $routes->group('kirimbesek', function ($routes) {
        $routes->get('/', 'Surat::index');
        $routes->post('create', 'Surat::create');
        $routes->post('update/(:num)', 'Surat::update/$1');
        $routes->get('delete/(:num)', 'Surat::delete/$1');
        $routes->get('export', 'Surat::export');
        $routes->get('print/(:num)', 'Surat::print/$1');
    });

    $routes->group('kirimkulit', function ($routes) {
        $routes->get('/', 'Kulit::index');
        $routes->post('create', 'Kulit::create');
        $routes->post('update/(:num)', 'Kulit::update/$1');
        $routes->get('delete/(:num)', 'Kulit::delete/$1');
        $routes->get('export', 'Kulit::export');
        $routes->get('print/(:num)', 'Kulit::print/$1');
    });

    // =================================================
    // SETTING
    // =================================================
    $routes->group('setting', function ($routes) {
        $routes->get('/', 'Setting::index');
        $routes->post('update', 'Setting::update');

        $routes->post('user/create', 'Setting::createUser');
        $routes->post('user/update/(:num)', 'Setting::updateUser/$1');
        $routes->get('user/delete/(:num)', 'Setting::deleteUser/$1');
    });
});


$routes->group('', ['filter' => 'role:6'], function ($routes) {

    $routes->get('cabang/dashboard', 'Cabang\DashboardController::index');

    $routes->group('cabang/panitia', function ($routes) {
        $routes->get('/', 'Cabang\PanitiaController::index');
        $routes->post('store', 'Cabang\PanitiaController::store');
        $routes->post('update/(:num)', 'Cabang\PanitiaController::update/$1');
        $routes->post('delete/(:num)', 'Cabang\PanitiaController::delete/$1');
    });

    $routes->group('cabang/pequrban', function ($routes) {
        $routes->get('/', 'Cabang\PequrbanController::index');
        $routes->post('store', 'Cabang\PequrbanController::store');
        $routes->post('update/(:num)', 'Cabang\PequrbanController::update/$1');
        $routes->post('delete/(:num)', 'Cabang\PequrbanController::delete/$1');
        $routes->post('import', 'Cabang\PequrbanController::import');
        $routes->get('export', 'Cabang\PequrbanController::export');
        $routes->get('template', 'Cabang\PequrbanController::template');
    });

    $routes->group('cabang/amprah', function ($routes) {
        $routes->get('/', 'Cabang\Master\AmprahController::index');
        $routes->post('update/(:num)', 'Cabang\DashboardController::update/$1');
        $routes->get('export', 'Cabang\Master\AmprahController::export');
    });
});
