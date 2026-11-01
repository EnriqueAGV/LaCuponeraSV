<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Validator;
use App\Models\User;

final class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            redirect('/dashboard');
        }

        $this->view('auth.login', ['title' => 'Iniciar sesión']);
    }

    public function login(): void
    {
        $usuario = $this->input('usuario');
        $password = $this->rawInput('password');

        $validator = Validator::make(
            ['usuario' => $usuario, 'password' => $password],
            ['usuario' => 'required', 'password' => 'required']
        );

        if ($validator->fails()) {
            $this->backWith('/login', $validator->errors(), ['usuario' => $usuario]);
        }

        $user = User::findByLogin($usuario);

        // El mensaje es genérico para no revelar si el usuario existe.
        if ($user === null || !password_verify($password, $user['password_hash'])) {
            $this->backWith('/login', ['general' => 'Usuario o contraseña incorrectos.'], ['usuario' => $usuario]);
        }

        Auth::login((int) $user['id']);

        $this->success('/dashboard', 'Bienvenido, ' . $user['usuario'] . '.');
    }

    public function logout(): void
    {
        Auth::logout();

        redirect('/login');
    }
}
