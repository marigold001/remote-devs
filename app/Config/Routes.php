<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'AdminController::dashboard');
$routes->get('/products', 'ProductController::index');
$routes->get('/products/(:num)', 'ProductController::show/$1');
$routes->get('/categories', 'CategoryController::index');
$routes->get('/attributes', 'AttributeController::index');
$routes->get('/attribute-values', 'AttributeValueController::index');
$routes->get('import', '\App\Controllers\Core\ImportController::index');
$routes->post('import/upload', '\App\Controllers\Core\ImportController::upload');



