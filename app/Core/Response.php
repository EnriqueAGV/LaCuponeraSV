<?php

declare(strict_types=1);

namespace App\Core;

final class Response
{
    private const MESSAGES = [
        403 => 'No tienes permiso para ver esta página.',
        404 => 'La página que buscas no existe.',
        405 => 'Método no permitido.',
        419 => 'El formulario expiró. Recarga la página e inténtalo de nuevo.',
        500 => 'Ocurrió un error inesperado.',
    ];

    public static function abort(int $code, string $message = ''): never
    {
        http_response_code($code);

        View::render('errors.error', [
            'title' => 'Error ' . $code,
            'code' => $code,
            'message' => $message !== '' ? $message : (self::MESSAGES[$code] ?? 'Error'),
        ]);

        exit;
    }
}
