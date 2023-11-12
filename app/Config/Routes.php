<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'Artemex::login');
$routes->post('/login', 'Artemex::login');
$routes->get('/logout', 'Artemex::logout');

$routes->get('/inicio', 'Artemex::inicio');

/* Productos */
$routes->get('/producto', 'Producto::index');
$routes->post('producto/agregar', 'Producto::agregar');


$routes->get('/informe', 'Informe::index');
$routes->get('/pedido', 'Pedido::index');
