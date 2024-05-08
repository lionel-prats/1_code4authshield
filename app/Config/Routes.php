<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// recurso creado con el comando "php spark shield:setup" (v176)
// ver las rutas incluidas en este recurso en 3_notas-generales.txt, apartado "177."
service('auth')->routes($routes); 

// v181
$routes->group("dashboard", ["namespace" => "App\Controllers\Dashboard"], function($routes){ 
    $routes->get("usuario", "Usuario::index"); 
});


$routes->presenter("admin"); // v179
$routes->presenter("other"); // v179
$routes->presenter("regular"); // v179