<?php

use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Router\Router;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);

$routes->get('/panitia', 'Panitia::index', ['filter' => 'auth']);
$routes->post('/panitia/tambah', 'Panitia::tambah', ['filter' => 'auth']);
$routes->post('/panitia/edit', 'Panitia::edit', ['filter' => 'auth']);
$routes->get('/panitia/hapus/(:num)', 'Panitia::hapus/$1', ['filter' => 'auth']);
$routes->get('/panitia/export', 'Panitia::export', ['filter' => 'auth']);

$routes->get('/cabang', 'Cabang::index', ['filter' => 'auth']);
$routes->post('/cabang/tambah', 'Cabang::tambah', ['filter' => 'auth']);
$routes->post('/cabang/edit', 'Cabang::edit', ['filter' => 'auth']);
$routes->get('/cabang/hapus/(:num)', 'Cabang::hapus/$1', ['filter' => 'auth']);
$routes->get('/cabang/export', 'Cabang::export', ['filter' => 'auth']);

$routes->get('/penerimaan', 'Penerimaan::index', ['filter' => 'auth']);
$routes->post('/penerimaan/tambah', 'Penerimaan::tambah', ['filter' => 'auth']);
$routes->post('/penerimaan/edit', 'Penerimaan::edit', ['filter' => 'auth']);
$routes->get('/penerimaan/hapus/(:num)', 'Penerimaan::hapus/$1', ['filter' => 'auth']);
$routes->get('/penerimaan/export', 'Penerimaan::export', ['filter' => 'auth']);

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

$routes->get('/login', 'Login::index');
$routes->post('/loginProcess', 'Login::loginProcess');
$routes->get('/logout', 'Login::logout');