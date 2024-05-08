<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes); // recurso creado con el comando "php spark shield:setup" (v176)

$routes->presenter("admin"); // v179
$routes->presenter("other"); // v179
$routes->presenter("regular"); // v179