<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => getenv('APP_NAME') ?: 'La Cuponera SV',
        // Sin APP_URL se usa el host de la petición, así funciona en cualquier puerto.
        'url' => getenv('APP_URL') ?: (!empty($_SERVER['HTTPS']) ? 'https://' : 'http://') . ($_SERVER['HTTP_HOST'] ?? 'localhost:8000'),
        'debug' => filter_var(getenv('APP_DEBUG') ?: 'true', FILTER_VALIDATE_BOOLEAN),
    ],

    'db' => [
        'host' => getenv('DB_HOST') ?: '127.0.0.1',
        'port' => getenv('DB_PORT') ?: '3306',
        'name' => getenv('DB_NAME') ?: 'lacuponerasv',
        'user' => getenv('DB_USER') ?: 'cupon_app',
        'pass' => getenv('DB_PASS') ?: 'cupon_app_dev',
        'charset' => 'utf8mb4',
    ],

    // "log" escribe los correos en storage/logs/mail.log; "mail" usa la función mail() de PHP.
    'mail' => [
        'driver' => getenv('MAIL_DRIVER') ?: 'log',
        'from' => getenv('MAIL_FROM') ?: 'no-reply@lacuponerasv.test',
    ],

    // Administrador inicial que crea database/setup.php. Cambia la contraseña en producción.
    'admin_seed' => [
        'usuario' => 'admin',
        'correo' => 'admin@lacuponerasv.test',
        'password' => getenv('ADMIN_PASSWORD') ?: 'Admin12345',
    ],
];
