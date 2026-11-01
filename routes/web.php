<?php

declare(strict_types=1);

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\PasswordController;
use App\Controllers\RegistroController;

/** @var App\Core\Router $router */

$router->get('/', [DashboardController::class, 'index']);
$router->get('/dashboard', [DashboardController::class, 'index']);

$router->get('/login', [AuthController::class, 'showLogin']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

$router->get('/registro/empresa', [RegistroController::class, 'showEmpresa']);
$router->post('/registro/empresa', [RegistroController::class, 'storeEmpresa']);
$router->get('/registro/cliente', [RegistroController::class, 'showCliente']);
$router->post('/registro/cliente', [RegistroController::class, 'storeCliente']);

$router->get('/password/olvide', [PasswordController::class, 'showOlvide']);
$router->post('/password/olvide', [PasswordController::class, 'enviarEnlace']);
$router->get('/password/restablecer', [PasswordController::class, 'showRestablecer']);
$router->post('/password/restablecer', [PasswordController::class, 'restablecer']);

$router->get('/admin/empresas', [AdminController::class, 'empresas']);
$router->post('/admin/empresas/{id}/aprobar', [AdminController::class, 'aprobarEmpresa']);
$router->post('/admin/empresas/{id}/rechazar', [AdminController::class, 'rechazarEmpresa']);
$router->get('/admin/administradores', [AdminController::class, 'administradores']);
$router->post('/admin/administradores', [AdminController::class, 'storeAdministrador']);
