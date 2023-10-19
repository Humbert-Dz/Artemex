<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Artemex::index');
$routes->get('/inicio', 'Artemex::inicio');
$routes->get('/producto', 'Producto::index');
$routes->get('/informe', 'Informe::index');
