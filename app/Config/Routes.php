<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);

$routes->get('/panitia', 'Panitia::index', ['filter' => 'auth']);
$routes->post('/panitia/tambah', 'Panitia::tambah', ['filter' => 'auth']);
$routes->post('/panitia/edit', 'Panitia::edit', ['filter' => 'auth']);
$routes->get('/panitia/hapus/(:num)', 'Panitia::hapus/$1', ['filter' => 'auth']);

$routes->get('/cabang', 'Cabang::index', ['filter' => 'auth']);
$routes->post('/cabang/tambah', 'Cabang::tambah', ['filter' => 'auth']);
$routes->post('/cabang/edit', 'Cabang::edit', ['filter' => 'auth']);
$routes->get('/cabang/hapus/(:num)', 'Cabang::hapus/$1', ['filter' => 'auth']);

$routes->get('/login', 'Login::index');
$routes->post('/loginProcess', 'Login::loginProcess');
$routes->get('/logout', 'Login::logout');