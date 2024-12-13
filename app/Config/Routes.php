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

    // akun
    $routes->get('akun', 'Akun::index');

    // history
    $routes->get('history', 'History::index');

    // proses
    $routes->get('proses', 'Proses::index');
});
