<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// !ADMINISTRADOR
/* Login */
$routes->get('/login', 'ADMINISTRADOR\Artemex::login');
$routes->post('/login', 'ADMINISTRADOR\Artemex::login');
$routes->get('/logout', 'ADMINISTRADOR\Artemex::logout');

/* inicio */
$routes->get('/inicio', 'ADMINISTRADOR\Artemex::inicio');

/* Productos */
$routes->get('/producto', 'ADMINISTRADOR\Producto::index');
$routes->post('producto/agregar', 'ADMINISTRADOR\Producto::agregar');
$routes->post('producto/buscar', 'ADMINISTRADOR\Producto::buscar');
$routes->post('producto/filtrado', 'ADMINISTRADOR\Producto::filtrado');
$routes->get('producto/editar/(:num)', 'ADMINISTRADOR\Producto::editar/$1');
$routes->post('producto/actualizar/(:num)', 'ADMINISTRADOR\Producto::actualizar/$1');
$routes->get('producto/eliminar/(:num)', 'ADMINISTRADOR\Producto::eliminar/$1');

/* Informes */
$routes->get('/informe', 'ADMINISTRADOR\Informe::index');
$routes->post('/informe', 'ADMINISTRADOR\Informe::index');

// Pedido
$routes->get('/pedido', 'ADMINISTRADOR\Pedido::index');
$routes->get('/pedido/confirmar/(:num)', 'ADMINISTRADOR\Pedido::confirmar/$1');
$routes->get('/pedido/cancelar/(:num)', 'ADMINISTRADOR\Pedido::cancelar/$1');
$routes->get('/pedido/enviar/(:num)', 'ADMINISTRADOR\Pedido::enviar/$1');
$routes->post('/pedido/buscar', 'ADMINISTRADOR\Pedido::buscar');
$routes->post('/pedido/filtrado', 'ADMINISTRADOR\Pedido::filtrado');

// Cuentas
$routes->get('/cuentas', 'ADMINISTRADOR\CuentasController::index');
$routes->get('/cuentas/administradores', 'ADMINISTRADOR\CuentasController::administradores');
$routes->get('/cuentas/clientes', 'ADMINISTRADOR\CuentasController::clientes');

// !USUARIO
$routes->get('usuario/inicio', 'USUARIOS\UsuarioController::index');