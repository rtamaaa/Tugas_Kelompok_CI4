<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Dashboard::index');
$routes->get('Dashboard/show/(:num)', 'Dashboard::show/$1');


// Search route
$routes->post('/', 'Dashboard::search');

// Auth routes
$routes->get('login', 'Auth::login');
$routes->post('authenticate', 'Auth::authenticate');
$routes->get('logout', 'Auth::logout');

// User routes
$routes->group('user', function($routes) {
    $routes->get('/', 'User::index');
    $routes->get('create', 'User::create');
    $routes->post('store', 'User::store');
    $routes->get('edit/(:num)', 'User::edit/$1');
    $routes->post('update/(:num)', 'User::update/$1');
    $routes->get('delete/(:num)', 'User::delete/$1');
});

// Content routes
$routes->group('content', function($routes) {
    $routes->get('/', 'Content::index');
    $routes->get('create', 'Content::create');
    $routes->post('store', 'Content::store');
    $routes->get('edit/(:num)', 'Content::edit/$1');
    $routes->post('update/(:num)', 'Content::update/$1');
    $routes->get('delete/(:num)', 'Content::delete/$1');
    $routes->get('read/(:num)', 'Content::read/$1');

});
