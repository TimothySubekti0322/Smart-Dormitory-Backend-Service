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
