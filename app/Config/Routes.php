<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// recurso creado con el comando "php spark shield:setup" (v176)
// ver las rutas incluidas en este recurso en 3_notas-generales.txt, apartado "177."
service('auth')->routes($routes); 

// modulo Usuario (v193)
$routes->group("dashboard", ["namespace" => "App\Controllers\Dashboard"], function($routes){ // v181
    $routes->get("usuario", "Usuario::index"); // v181
    $routes->get("usuario/(:num)", "Usuario::show/$1", ["as" => "usuario.show"]); // v182 
    $routes->get("usuario/gestionar_permisos/(:num)", "Usuario::gestionar_permisos/$1", ["as" => "usuario.gestionar_permisos"]); // v186
    $routes->get("usuario/gestionar_grupos/(:num)", "Usuario::gestionar_grupos/$1", ["as" => "usuario.gestionar_grupos"]); // v186
    $routes->post("usuario/(:num)/manejar-permisos", "Usuario::manejar_permisos/$1", ["as" => "usuario.manejar_permisos"]); // v187
    $routes->post("usuario/(:num)/manejar-grupos", "Usuario::manejar_grupos/$1", ["as" => "usuario.manejar_grupos"]); // v189
    $routes->post("usuario/(:num)/sincronizar-permisos", "Usuario::sincronizar_permisos/$1", ["as" => "usuario.sincronizar_permisos"]); // v191
});

$routes->get("contacto", "Other::contacto"); // v196
$routes->presenter("admin"); // v179
$routes->presenter("other"); // v179
$routes->presenter("regular"); // v179