<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// recurso creado con el comando "php spark shield:setup" (v176)
// ver las rutas incluidas en este recurso en 3_notas-generales.txt, apartado "177."
service('auth')->routes($routes); 

$routes->group("dashboard", ["namespace" => "App\Controllers\Dashboard"], function($routes){ // v181
    $routes->get("usuario", "Usuario::index"); // v181
    $routes->get("usuario/(:num)", "Usuario::show/$1", ["as" => "usuario.show"]); // v182 
});


$routes->presenter("admin"); // v179
$routes->presenter("other"); // v179
$routes->presenter("regular"); // v179