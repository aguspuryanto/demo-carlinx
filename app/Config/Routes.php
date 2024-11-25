<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
// $routes->get('/dashboard', 'DashboardController::index', ['filter' => 'auth']);
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

