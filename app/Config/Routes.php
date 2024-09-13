<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/a', 'a::index');
$routes->get('/a/login/', 'a::login');
$routes->get('/a/logout/', 'a::logout');
$routes->post('/a/submit/', 'a::submit');

$routes->get('/a/user', 'a::index');
$routes->get('/a/user/delete/(:num)', 'a::deleteUser/$1');
$routes->get('/a/user/create', 'a::createUser');
$routes->post('/a/home/user/create/submit', 'a::createSubmit');
