<?php

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Router\Router;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/jadwal2', 'Home::jadwal');
$routes->get('/datasapi2', 'Home::datasapi');
$routes->get('/dataqurban', 'Home::dataqurban');

$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);

$routes->get('/panitia', 'Data::index', ['filter' => 'auth']);
$routes->post('/panitia/tambah', 'Data::tambah', ['filter' => 'auth']);
$routes->post('/panitia/edit', 'Data::edit', ['filter' => 'auth']);
$routes->get('/panitia/hapus/(:num)', 'Data::hapus/$1', ['filter' => 'auth']);
$routes->get('/panitia/export', 'Data::export', ['filter' => 'auth']);

$routes->get('/cabang', 'Data::indexcabang', ['filter' => 'auth']);
$routes->post('/cabang/tambah', 'Data::tambahcabang', ['filter' => 'auth']);
$routes->post('/cabang/edit', 'Data::editcabang', ['filter' => 'auth']);
$routes->get('/cabang/hapus/(:num)', 'Data::hapuscabang/$1', ['filter' => 'auth']);
$routes->get('/cabang/export', 'Data::exportcabang', ['filter' => 'auth']);

$routes->get('/muspika', 'Data::muspika', ['filter' => 'auth']);
$routes->post('/muspika/tambah', 'Data::tambahmuspika', ['filter' => 'auth']);
$routes->post('/muspika/edit', 'Data::editmuspika', ['filter' => 'auth']);
$routes->get('/muspika/hapus/(:num)', 'Data::hapusmuspika/$1', ['filter' => 'auth']);
$routes->get('/muspika/export', 'Data::exportmuspika', ['filter' => 'auth']);

$routes->get('/penerimaan', 'Penerimaan::index', ['filter' => 'auth']);
$routes->post('/penerimaan/tambah', 'Penerimaan::tambah', ['filter' => 'auth']);
$routes->post('/penerimaan/edit', 'Penerimaan::edit', ['filter' => 'auth']);
$routes->get('/penerimaan/hapus/(:num)', 'Penerimaan::hapus/$1', ['filter' => 'auth']);
$routes->get('/penerimaan/export', 'Penerimaan::export', ['filter' => 'auth']);
$routes->get('/penerimaan/print/(:num)', 'Penerimaan::print/$1', ['filter' => 'auth']);

$routes->get('/datasapi', 'Penerimaan::datasapi', ['filter' => 'auth']);
$routes->post('/datasapi/tambah', 'Penerimaan::tambahdatasapi', ['filter' => 'auth']);
$routes->post('/datasapi/edit', 'Penerimaandatasapi::edit', ['filter' => 'auth']);
$routes->get('/datasapi/hapus/(:num)', 'Penerimaan::hapusdatasapi/$1', ['filter' => 'auth']);
$routes->get('/datasapi/export', 'Penerimaan::exportdatasapi', ['filter' => 'auth']);

$routes->get('/kandang', 'Kandang::index', ['filter' => 'auth']);
$routes->post('/kandang/tambah', 'Kandang::tambah', ['filter' => 'auth']);
$routes->post('/kandang/edit', 'Kandang::edit', ['filter' => 'auth']);
$routes->get('/kandang/hapus/(:num)', 'Kandang::hapus/$1', ['filter' => 'auth']);
$routes->get('/kandang/export', 'Kandang::export', ['filter' => 'auth']);

$routes->get('/besek', 'Besek::index', ['filter' => 'auth']);
$routes->post('/besek/tambah', 'Besek::tambah', ['filter' => 'auth']);
$routes->post('/besek/edit', 'Besek::edit', ['filter' => 'auth']);
$routes->get('/besek/hapus/(:num)', 'Besek::hapus/$1', ['filter' => 'auth']);
$routes->get('/besek/export', 'Besek::export', ['filter' => 'auth']);

$routes->get('/k3', 'Kandang::viewk3', ['filter' => 'auth']);
$routes->post('/k3/tambah', 'Kandang::tambahk3', ['filter' => 'auth']);
$routes->post('/k3/edit', 'Kandang::editk3', ['filter' => 'auth']);
$routes->get('/k3/hapus/(:num)', 'Kandang::hapusk3/$1', ['filter' => 'auth']);
$routes->get('/k3/export', 'Kandang::exportk3', ['filter' => 'auth']);

$routes->get('/qurban', 'Qurban::index', ['filter' => 'auth']);
$routes->post('/qurban/tambah', 'Qurban::tambah', ['filter' => 'auth']);
$routes->post('/qurban/edit', 'Qurban::edit', ['filter' => 'auth']);
$routes->get('/qurban/hapus/(:num)', 'Qurban::hapus/$1', ['filter' => 'auth']);
$routes->get('/qurban/export', 'Qurban::export', ['filter' => 'auth']);

$routes->get('/amprah', 'Qurban::amprah', ['filter' => 'auth']);
$routes->post('/amprah/tambah', 'Qurban::tambahamprah', ['filter' => 'auth']);
$routes->post('/amprah/edit', 'Qurban::editamprah', ['filter' => 'auth']);
$routes->get('/amprah/hapus/(:num)', 'Qurban::hapusamprah/$1', ['filter' => 'auth']);
$routes->get('/amprah/export', 'Qurban::exportamprah', ['filter' => 'auth']);

$routes->get('/realisasi', 'Qurban::realisasi', ['filter' => 'auth']);
$routes->post('/realisasi/tambah', 'Qurban::tambahrealisasi', ['filter' => 'auth']);
$routes->post('/realisasi/edit', 'Qurban::editrealisasi', ['filter' => 'auth']);
$routes->get('/realisasi/hapus/(:num)', 'Qurban::hapusrealisasi/$1', ['filter' => 'auth']);
$routes->get('/realisasi/export', 'Qurban::exportrealisasi', ['filter' => 'auth']);

$routes->get('/jadwal', 'Qurban::jadwal', ['filter' => 'auth']);
$routes->post('/jadwal/tambah', 'Qurban::tambahjadwal', ['filter' => 'auth']);
$routes->post('/jadwal/edit', 'Qurban::editjadwal', ['filter' => 'auth']);
$routes->get('/jadwal/hapus/(:num)', 'Qurban::hapusjadwal/$1', ['filter' => 'auth']);
$routes->get('/jadwal/export', 'Qurban::exportjadwal', ['filter' => 'auth']);

$routes->get('/login', 'Login::index');
$routes->post('/loginProcess', 'Login::loginProcess');
$routes->get('/logout', 'Login::logout');

$routes->get('/kirimbesek', 'Surat::index', ['filter' => 'auth']);
$routes->post('/kirimbesek/tambah', 'Surat::tambah', ['filter' => 'auth']);
$routes->post('/kirimbesek/edit', 'Surat::updatekirim', ['filter' => 'auth']);
$routes->get('/kirimbesek/hapus/(:num)', 'Surat::hapus/$1', ['filter' => 'auth']);
$routes->get('/kirimbesek/export', 'Surat::export', ['filter' => 'auth']);
$routes->get('/kirimbesek/print/(:num)', 'Surat::printsurat/$1', ['filter' => 'auth']);

$routes->get('/kirimbesek/permintaan/(:num)', 'Surat::printpermintaan/$1', ['filter' => 'auth']);
$routes->get('/kirimbesek/permintaanhapus/(:num)', 'Surat::hapuspermintaan/$1', ['filter' => 'auth']);

$routes->get('/kirimkulit', 'Kulit::index', ['filter' => 'auth']);
$routes->post('/kirimkulit/tambah', 'Kulit::tambah', ['filter' => 'auth']);
$routes->post('/kirimkulit/edit', 'Kulit::updatekirim', ['filter' => 'auth']);
$routes->get('/kirimkulit/hapus/(:num)', 'Kulit::hapus/$1', ['filter' => 'auth']);
$routes->get('/kirimkulit/export', 'Kulit::export', ['filter' => 'auth']);
$routes->get('/kirimkulit/print/(:num)', 'Kulit::printsurat/$1', ['filter' => 'auth']);

$routes->get('/setting', 'Setting::index', ['filter' => 'auth']);
$routes->post('/setting/edit', 'Setting::edit', ['filter' => 'auth']);
