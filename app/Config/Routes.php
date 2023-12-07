<?php

use App\Controllers\OrderController;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/auth', 'Home::index');
$routes->post('/auth', 'Login::index');
$routes->post('/register', 'Register::index');
$routes->get('/package', 'PackageController::index');
$routes->get('/package/(:num)', 'PackageController::show/$1');
$routes->post('/package', 'PackageController::create');
$routes->get('/user/quota/(:num)', 'QuotaController::show/$1');
$routes->patch('/user/quota/(:num)', 'QuotaController::update/$1');
$routes->get('/order', 'OrderController::index');
$routes->get('/order/(:num)', 'OrderController::show/$1');
$routes->post('/order', 'OrderController::create');
$routes->delete('/order/(:num)', 'OrderController::delete/$1');
$routes->get('/orderHistory/(:num)', 'OrderController::showHistory/$1');
$routes->get('/menu', 'MenuController::index');
$routes->post('/menu', 'MenuController::create');
$routes->post('/menu/(:num)', 'MenuController::update/$1');
$routes->delete('/menu/(:num)', 'MenuController::delete/$1');
$routes->post('/payment', 'PaymentController::index');
