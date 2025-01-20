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

    // akun
    $routes->get('akun', 'Akun::index');

    $routes->get('dashboard', 'Home::dashboard');

    // history
    // $routes->get('history', 'History::index');

    // proses
    $routes->get('proses', 'Proses::index');
});

// rate
$routes->group('rate', function($routes) {
    $routes->get('index', 'Rate::index');
    $routes->post('hitung', 'Rate::hitung');
    $routes->get('placeid', 'Rate::placeid');
    $routes->get('get-unit', 'Rate::getUnit');

    $routes->get('lepaskunci', 'Rate::lepasKunci');

    $routes->get('bulanan', 'Rate::orderBulanan');

    // send whatsapp
    $routes->add('send-whatsapp', 'Rate::sendWhatsapp');
});

// pelayanan
$routes->group('order', function($routes) {
    $routes->get('orderlayanan', 'Rate::orderLayanan');
    $routes->post('search-order', 'Rate::searchOrder');

    // lepas-kunci
    // $routes->get('lepas-kunci', 'Rate::lepasKunci');

    // bulanan
    $routes->get('bulanan', 'Rate::orderBulanan');
});

// event
$routes->group('event', ['filter' => 'auth'], function($routes) {
    $routes->get('index', 'Event::index');
});

// inbox
$routes->group('inbox', ['filter' => 'auth'], function($routes) {
    $routes->get('index', 'Inbox::index');
});

// history
$routes->group('history', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'History::index');
});

// pelaporan: order masuk, order keluar, hutang, piutang, status pembayaran, verifikasi pembayaran
$routes->group('pelaporan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pelaporan::index');
    $routes->add('order-masuk', 'Pelaporan::orderMasuk');
    $routes->add('order-keluar', 'Pelaporan::orderKeluar');
    $routes->get('hutang', 'Pelaporan::hutang');
    $routes->get('hutang/detail/(:num)', 'Pelaporan::hutangDetail/$1');
    $routes->get('piutang', 'Pelaporan::piutang');
    $routes->get('piutang/detail/(:num)', 'Pelaporan::piutangDetail/$1');
    $routes->get('status-pembayaran', 'Pelaporan::statusPembayaran');
    $routes->get('status-pembayaran/detail/(:num)', 'Pelaporan::statusPembayaranDetail/$1');
    $routes->get('verifikasi-pembayaran', 'Pelaporan::verifikasiPembayaran');
    $routes->get('verifikasi-pembayaran/detail/(:num)', 'Pelaporan::verifikasiPembayaranDetail/$1');
});

// pengaturan: akun, bbm, driver, batas wilayah, lokasi garasi, unit, pengguna, ganti password
$routes->group('pengaturan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pengaturan::index');
    $routes->get('akun', 'Pengaturan::akun');
    $routes->add('bbm', 'Pengaturan::bbm'); //handle GET and POST
    $routes->add('driver', 'Pengaturan::driver');
    $routes->add('batas-wilayah', 'Pengaturan::batasWilayah');
    $routes->add('lokasi-garasi', 'Pengaturan::lokasiGarasi');
    $routes->post('delete-garasi', 'Pengaturan::lokasiGarasiDelete');
    $routes->add('unit', 'Pengaturan::unit');
    $routes->add('pengguna', 'Pengaturan::pengguna');
    $routes->add('ganti-password', 'Pengaturan::gantiPassword');
});

$routes->group('api', function($routes) {
    // $routes->get('rate', 'Rate::api');
});
