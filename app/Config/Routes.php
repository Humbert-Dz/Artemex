<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/* Login */
$routes->get('/login', 'Artemex::login');
$routes->post('/login', 'Artemex::login');
$routes->get('/logout', 'Artemex::logout');

/* inicio */
$routes->get('/inicio', 'Artemex::inicio');

/* Productos */
$routes->get('/producto', 'Producto::index');
$routes->post('producto/agregar', 'Producto::agregar');
$routes->post('producto/buscar', 'Producto::buscar');
$routes->post('producto/filtrado', 'Producto::filtrado');
$routes->get('producto/editar/(:num)', 'Producto::editar/$1');
$routes->post('producto/actualizar/(:num)', 'Producto::actualizar/$1');
$routes->get('producto/eliminar/(:num)', 'Producto::eliminar/$1');

/* Informes */
$routes->get('/informe', 'Informe::index');
$routes->post('/informe', 'Informe::index');

// Pedido
$routes->get('/pedido', 'Pedido::index');
$routes->get('/pedido/confirmar/(:num)', 'Pedido::confirmar/$1');
$routes->get('/pedido/cancelar/(:num)', 'Pedido::cancelar/$1');
$routes->get('/pedido/enviar/(:num)', 'Pedido::enviar/$1');
$routes->post('/pedido/buscar', 'Pedido::buscar');
$routes->post('/pedido/filtrado', 'Pedido::filtrado');

