<?php

declare(strict_types=1);

namespace App\Core;

// Normaliza los datos ya validados al formato con el que se guardan en la base de datos.
final class Format
{
    public static function nit(string $value): string
    {
        $digits = self::digits($value);

        return sprintf('%s-%s-%s-%s', substr($digits, 0, 4), substr($digits, 4, 6), substr($digits, 10, 3), substr($digits, 13, 1));
    }

    public static function dui(string $value): string
    {
        $digits = self::digits($value);

        return substr($digits, 0, 8) . '-' . substr($digits, 8, 1);
    }

    public static function phone(string $value): string
    {
        $digits = self::digits($value);

        return substr($digits, 0, 4) . '-' . substr($digits, 4, 4);
    }

    private static function digits(string $value): string
    {
        return preg_replace('/\D/', '', $value) ?? '';
    }
}
