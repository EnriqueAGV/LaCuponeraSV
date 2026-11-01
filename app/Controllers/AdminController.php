<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Database;
use App\Core\Response;
use App\Core\Validator;
use App\Models\Empresa;
use App\Models\User;

final class AdminController extends Controller
{
    public function empresas(): void
    {
        Auth::requireRole('administrador');

        $this->view('admin.empresas', [
            'title' => 'Empresas',
            'empresas' => Empresa::all(),
        ]);
    }

    public function aprobarEmpresa(string $id): void
    {
        Auth::requireRole('administrador');

        $empresa = $this->empresaPendiente((int) $id);

        $validator = Validator::make(
            ['porcentaje_comision' => $this->input('porcentaje_comision')],
            ['porcentaje_comision' => 'required|numeric|between:0,100']
        );

        if ($validator->fails()) {
            $this->failure('/admin/empresas', 'La comisión debe ser un número entre 0 y 100.');
        }

        Empresa::updateEstado((int) $empresa['id'], 'aprobada', (float) $this->input('porcentaje_comision'), (int) Auth::user()['id']);

        $this->success('/admin/empresas', "Empresa {$empresa['nombre']} aprobada con {$this->input('porcentaje_comision')}% de comisión.");
    }

    public function rechazarEmpresa(string $id): void
    {
        Auth::requireRole('administrador');

        $empresa = $this->empresaPendiente((int) $id);

        Empresa::updateEstado((int) $empresa['id'], 'rechazada', null, (int) Auth::user()['id']);

        $this->success('/admin/empresas', "Solicitud de {$empresa['nombre']} rechazada.");
    }

    public function administradores(): void
    {
        Auth::requireRole('administrador');

        $this->view('admin.administradores', [
            'title' => 'Administradores',
            'administradores' => User::byRol('administrador'),
        ]);
    }

    public function storeAdministrador(): void
    {
        Auth::requireRole('administrador');

        $usuario = $this->input('usuario');
        $correo = $this->input('correo');
        $password = $this->rawInput('password');

        $validator = Validator::make(
            [
                'usuario' => $usuario,
                'correo' => $correo,
                'password' => $password,
                'password_confirmation' => $this->rawInput('password_confirmation'),
            ],
            [
                'usuario' => 'required|username',
                'correo' => 'required|email|max:150',
                'password' => 'required|password',
                'password_confirmation' => 'required|same:password',
            ]
        );

        if (User::existsUsuario($usuario)) {
            $validator->addError('usuario', 'Ese usuario ya está registrado.');
        }

        if (User::existsCorreo($correo)) {
            $validator->addError('correo', 'Ese correo ya está registrado.');
        }

        if ($validator->fails()) {
            $this->backWith('/admin/administradores', $validator->errors(), ['usuario' => $usuario, 'correo' => $correo]);
        }

        User::create([
            'usuario' => $usuario,
            'correo' => $correo,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'rol' => 'administrador',
        ]);

        $this->success('/admin/administradores', "Administrador {$usuario} creado.");
    }

    // Devuelve la empresa solo si existe y todavía está pendiente; si no, responde con error.
    private function empresaPendiente(int $id): array
    {
        $empresa = Empresa::findById($id);

        if ($empresa === null) {
            Response::abort(404);
        }

        if ($empresa['estado'] !== 'pendiente') {
            $this->failure('/admin/empresas', 'Esa solicitud ya fue procesada.');
        }

        return $empresa;
    }
}
