<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Format;
use App\Core\Validator;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\User;

final class RegistroController extends Controller
{
    public function showEmpresa(): void
    {
        $this->view('registro.empresa', ['title' => 'Registro de empresa']);
    }

    public function storeEmpresa(): void
    {
        $cuenta = $this->datosCuenta();
        $empresa = [
            'nombre' => $this->input('nombre'),
            'nit' => $this->input('nit'),
            'direccion' => $this->input('direccion'),
            'telefono' => $this->input('telefono'),
        ];

        $validator = Validator::make(
            $cuenta['valores'] + $empresa,
            $this->reglasCuenta() + [
                'nombre' => 'required|max:150',
                'nit' => 'required|nit',
                'direccion' => 'required|max:255',
                'telefono' => 'required|phone',
            ]
        );

        // Los datos se normalizan solo si son válidos, así el formulario muestra lo que escribió el usuario.
        if (!$validator->fails()) {
            $empresa['nit'] = Format::nit($empresa['nit']);
            $empresa['telefono'] = Format::phone($empresa['telefono']);

            $this->validarUnicos($validator, $cuenta['valores'], ['nit' => $empresa['nit']]);
        }

        if ($validator->fails()) {
            $this->backWith('/registro/empresa', $validator->errors(), $cuenta['old'] + $empresa);
        }

        Database::transaction(function () use ($cuenta, $empresa): void {
            $userId = User::create($cuenta['registro'] + ['rol' => 'empresa']);
            Empresa::create($userId, $empresa);
        });

        $this->success('/login', 'Solicitud enviada. Un administrador revisará tu empresa antes de publicar ofertas.');
    }

    public function showCliente(): void
    {
        $this->view('registro.cliente', ['title' => 'Registro de cliente']);
    }

    public function storeCliente(): void
    {
        $cuenta = $this->datosCuenta();
        $cliente = [
            'nombre' => $this->input('nombre'),
            'apellidos' => $this->input('apellidos'),
            'dui' => $this->input('dui'),
            'fecha_nacimiento' => $this->input('fecha_nacimiento'),
        ];

        $validator = Validator::make(
            $cuenta['valores'] + $cliente,
            $this->reglasCuenta() + [
                'nombre' => 'required|max:100',
                'apellidos' => 'required|max:100',
                'dui' => 'required|dui',
                'fecha_nacimiento' => 'required|date|adult',
            ]
        );

        if (!$validator->fails()) {
            $cliente['dui'] = Format::dui($cliente['dui']);

            $this->validarUnicos($validator, $cuenta['valores'], ['dui' => $cliente['dui']]);
        }

        if ($validator->fails()) {
            $this->backWith('/registro/cliente', $validator->errors(), $cuenta['old'] + $cliente);
        }

        Database::transaction(function () use ($cuenta, $cliente): void {
            $userId = User::create($cuenta['registro'] + ['rol' => 'cliente']);
            Cliente::create($userId, $cliente);
        });

        $this->success('/login', 'Cuenta creada. Ya puedes iniciar sesión.');
    }

    /**
     * Datos comunes de cuenta (usuario, correo y contraseña).
     * "valores" se usa para validar, "old" se devuelve al formulario sin contraseñas
     * y "registro" se guarda en la tabla users.
     */
    private function datosCuenta(): array
    {
        $usuario = $this->input('usuario');
        $correo = $this->input('correo');
        $password = $this->rawInput('password');

        return [
            'valores' => [
                'usuario' => $usuario,
                'correo' => $correo,
                'password' => $password,
                'password_confirmation' => $this->rawInput('password_confirmation'),
            ],
            'old' => ['usuario' => $usuario, 'correo' => $correo],
            'registro' => [
                'usuario' => $usuario,
                'correo' => $correo,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ],
        ];
    }

    private function reglasCuenta(): array
    {
        return [
            'usuario' => 'required|username',
            'correo' => 'required|email|max:150',
            'password' => 'required|password',
            'password_confirmation' => 'required|same:password',
        ];
    }

    // Revisa duplicados en usuario, correo, NIT o DUI, según los campos que se envíen en $unicos.
    private function validarUnicos(Validator $validator, array $cuenta, array $unicos = []): void
    {
        if (User::existsUsuario($cuenta['usuario'])) {
            $validator->addError('usuario', 'Ese usuario ya está registrado.');
        }

        if (User::existsCorreo($cuenta['correo'])) {
            $validator->addError('correo', 'Ese correo ya está registrado.');
        }

        if (isset($unicos['nit']) && Empresa::existsNit($unicos['nit'])) {
            $validator->addError('nit', 'Ese NIT ya está registrado.');
        }

        if (isset($unicos['dui']) && Cliente::existsDui($unicos['dui'])) {
            $validator->addError('dui', 'Ese DUI ya está registrado.');
        }
    }
}
