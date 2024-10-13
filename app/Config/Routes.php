<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Home
$routes->get('/', 'HomeController::index');
$routes->get('/about', 'HomeController::about');
$routes->get('/blog', 'HomeController::blog');
$routes->get('/contact', 'HomeController::contact');

// Book
$routes->get('/books', 'BookController::index');
$routes->get('/book/create', 'BookController::create');
$routes->post('/book/store', 'BookController::store');
$routes->post('/book/update/(:num)', 'BookController::update/$1');
$routes->delete('/book/(:num)', 'BookController::delete/$1');
$routes->get('/book/edit/(:segment)', 'BookController::edit/$1');
$routes->get('/book/(:any)', 'BookController::show/$1');
