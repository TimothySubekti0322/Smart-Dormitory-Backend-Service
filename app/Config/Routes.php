<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/auth', 'Home::index');
$routes->post('/auth', 'Login::index');
$routes->post('/register', 'Register::index');
$route->get('/package', 'PackageController::index');
$route->post('/package', 'PackageController::create');
