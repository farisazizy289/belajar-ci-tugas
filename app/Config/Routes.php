<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('/register_view', 'AuthController::register_view');
$routes->add('/register_view', 'AuthController::register_view');
$routes->get('/register', 'AuthController::register');
$routes->add('/register', 'AuthController::register');

$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
    $routes->get('download', 'ProdukController::download');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->get('getcity', 'TransaksiController::getcity', ['filter' => 'auth']);
$routes->get('getcost', 'TransaksiController::getcost', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);

$routes->get('faq', 'Home::faq', ['filter' => 'auth']);
$routes->get('profile', 'Home::profile', ['filter' => 'auth']);
$routes->get('contact', 'Home::contact', ['filter' => 'auth']);

$routes->get('profile', 'Home::profile', ['filter' => 'auth']);

$routes->add('/profile/edit/(:any)', 'ProfileController::edit/$1', ['filter' => 'auth']);
$routes->get('/profile/edit_view/(:any)', 'ProfileController::edit_view/$1', ['filter' => 'auth']);
$routes->get('/profile/(:any)', 'ProfileController::view/$1', ['filter' => 'auth']);

$routes->post('transaksi/verifikasi', 'TransaksiController::verifikasi');

