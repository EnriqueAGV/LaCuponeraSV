<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Config;
use App\Core\Controller;
use App\Core\Mailer;
use App\Core\Validator;
use App\Models\PasswordReset;
use App\Models\User;

final class PasswordController extends Controller
{
    private const TOKEN_TTL_SECONDS = 3600;

    public function showOlvide(): void
    {
        $this->view('password.olvide', ['title' => 'Recuperar contraseña']);
    }

    public function enviarEnlace(): void
    {
        $correo = $this->input('correo');

        $validator = Validator::make(['correo' => $correo], ['correo' => 'required|email']);

        if ($validator->fails()) {
            $this->backWith('/password/olvide', $validator->errors(), ['correo' => $correo]);
        }

        $user = User::findByCorreo($correo);

        if ($user !== null) {
            // Solo se guarda el hash del token; el token en claro va únicamente en el enlace.
            $token = bin2hex(random_bytes(32));

            PasswordReset::create(
                (int) $user['id'],
                hash('sha256', $token),
                date('Y-m-d H:i:s', time() + self::TOKEN_TTL_SECONDS)
            );

            $link = url('/password/restablecer?token=' . $token);

            Mailer::send(
                $correo,
                Config::get('app.name') . ': recupera tu contraseña',
                "Hola {$user['usuario']},\n\nUsa este enlace para crear una nueva contraseña (vence en 1 hora):\n{$link}\n\nSi no pediste este cambio, ignora este mensaje."
            );
        }

        // Respuesta igual exista o no el correo, para no revelar cuentas registradas.
        $this->success('/login', 'Si el correo está registrado, recibirás un enlace para restablecer tu contraseña.');
    }

    public function showRestablecer(): void
    {
        $token = (string) ($_GET['token'] ?? '');
        $valido = $token !== '' && PasswordReset::findValidByHash(hash('sha256', $token)) !== null;

        $this->view('password.restablecer', [
            'title' => 'Nueva contraseña',
            'token' => $token,
            'valido' => $valido,
        ]);
    }

    public function restablecer(): void
    {
        $token = $this->input('token');
        $password = $this->rawInput('password');

        $reset = $token !== '' ? PasswordReset::findValidByHash(hash('sha256', $token)) : null;

        if ($reset === null) {
            $this->failure('/password/olvide', 'El enlace no es válido o ya venció. Solicita uno nuevo.');
        }

        $validator = Validator::make(
            ['password' => $password, 'password_confirmation' => $this->rawInput('password_confirmation')],
            [
                'password' => 'required|password',
                'password_confirmation' => 'required|same:password',
            ]
        );

        if ($validator->fails()) {
            $this->backWith('/password/restablecer?token=' . urlencode($token), $validator->errors());
        }

        User::updatePassword((int) $reset['user_id'], password_hash($password, PASSWORD_DEFAULT));
        PasswordReset::invalidatePending((int) $reset['user_id']);

        $this->success('/login', 'Contraseña actualizada. Ya puedes iniciar sesión.');
    }
}
