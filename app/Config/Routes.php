<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index', ['filter' => 'auth']);
// $routes->get('/login', 'Auth::login');
// // $routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);
// $routes->post('/login', 'Auth::login');
// $routes->get('/logout', 'Auth::logout');

// $routes->get('/profile', 'Home::profile');
// $routes->get('/chat', 'Home::chat');

$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::loginSubmit');
    $routes->get('logout', 'Auth::logout');

    $routes->get('profile', 'Profile::index');

    // rate
    $routes->get('rate', 'Rate::index');
    $routes->post('rate/hitung', 'Rate::hitung');
    $routes->get('rate/placeid', 'Rate::placeid');

    // akun
    $routes->get('akun', 'Akun::index');

    // history
    // $routes->get('history', 'History::index');

    // proses
    $routes->get('proses', 'Proses::index');
});

// history
$routes->group('history', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'History::index');
});

// pelaporan: order masuk, order keluar, hutang, piutang, status pembayaran, verifikasi pembayaran
$routes->group('pelaporan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pelaporan::index');
    $routes->get('order-masuk', 'Pelaporan::orderMasuk');
    $routes->get('order-keluar', 'Pelaporan::orderKeluar');
    $routes->get('hutang', 'Pelaporan::hutang');
    $routes->get('piutang', 'Pelaporan::piutang');
    $routes->get('status-pembayaran', 'Pelaporan::statusPembayaran');
    $routes->get('verifikasi-pembayaran', 'Pelaporan::verifikasiPembayaran');
});

// pengaturan: akun, bbm, driver, batas wilayah, lokasi garasi, unit, pengguna, ganti password
$routes->group('pengaturan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pengaturan::index');
    $routes->get('akun', 'Pengaturan::akun');
    $routes->add('bbm', 'Pengaturan::bbm'); //handle GET and POST
    $routes->get('driver', 'Pengaturan::driver');
    $routes->get('batas-wilayah', 'Pengaturan::batasWilayah');
    $routes->add('lokasi-garasi', 'Pengaturan::lokasiGarasi');
    $routes->get('unit', 'Pengaturan::unit');
    $routes->get('pengguna', 'Pengaturan::pengguna');
    $routes->get('ganti-password', 'Pengaturan::gantiPassword');
});

$routes->group('api', function($routes) {
    // $routes->get('rate', 'Rate::api');
});
