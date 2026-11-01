<?php

// Uso: php database/setup.php
// Crea las tablas y, si no existe, el administrador inicial.

declare(strict_types=1);

require dirname(__DIR__) . '/app/bootstrap.php';

use App\Core\Config;
use App\Core\Database;
use App\Models\User;

Database::connection()->exec(file_get_contents(__DIR__ . '/schema.sql'));
echo "Esquema listo.\n";

if (User::countByRol('administrador') === 0) {
    $admin = Config::get('admin_seed');

    User::create([
        'usuario' => $admin['usuario'],
        'correo' => $admin['correo'],
        'password_hash' => password_hash($admin['password'], PASSWORD_DEFAULT),
        'rol' => 'administrador',
    ]);

    echo "Administrador creado: {$admin['usuario']}\n";
} else {
    echo "Ya existe un administrador. No se creó ninguno.\n";
}
