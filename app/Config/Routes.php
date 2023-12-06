<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/auth', 'Home::index');
$routes->post('/auth', 'Login::index');
$routes->post('/register', 'Register::index');
$routes->get('/package', 'PackageController::index');
$routes->post('/package', 'PackageController::create');
$routes->get('/user/quota/(:num)', 'QuotaController::show/$1');
$routes->patch('/user/quota/(:num)', 'QuotaController::update/$1');
