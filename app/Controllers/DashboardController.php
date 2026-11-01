<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\User;

final class DashboardController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();

        $user = Auth::user();
        $title = 'Panel';

        if ($user['rol'] === 'administrador') {
            $this->view('dashboard.admin', [
                'title' => $title,
                'stats' => [
                    'pendientes' => Empresa::countByEstado('pendiente'),
                    'aprobadas' => Empresa::countByEstado('aprobada'),
                    'rechazadas' => Empresa::countByEstado('rechazada'),
                    'administradores' => User::countByRol('administrador'),
                ],
            ]);

            return;
        }

        if ($user['rol'] === 'empresa') {
            $this->view('dashboard.empresa', [
                'title' => $title,
                'empresa' => Empresa::findByUserId((int) $user['id']),
            ]);

            return;
        }

        $this->view('dashboard.cliente', [
            'title' => $title,
            'cliente' => Cliente::findByUserId((int) $user['id']),
        ]);
    }
}
