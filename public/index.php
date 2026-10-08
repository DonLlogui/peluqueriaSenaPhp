<?php
session_start();
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/Router.php';

$router = new Router();

// Rutas públicas
$router->get('', 'InicioControlador@index');
$router->get('servicios', 'ServiciosControlador@index');
$router->get('servicios/crear', 'ServiciosControlador@crear');
$router->post('servicios/crear', 'ServiciosControlador@crear');

// Rutas de citas
$router->get('citas', 'CitasControlador@index');
$router->get('citas/crear', 'CitasControlador@crear');
$router->post('citas/crear', 'CitasControlador@crear');
$router->post('citas/actualizar-estado', 'CitasControlador@actualizarEstado');

$router->ejecutar();