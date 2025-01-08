<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Admin::index', ['filter' => 'auth']);
$routes->get('/panitia', 'Panitia::index', ['filter' => 'auth']);
$routes->get('/cabang', 'Cabang::index', ['filter' => 'auth']);

$routes->get('/login', 'Login::index');
$routes->post('/loginProcess', 'Login::loginProcess');
$routes->get('/logout', 'Login::logout');