<?php

declare(strict_types=1);

namespace App\Core;

final class Csrf
{
    public static function token(): string
    {
        if (!is_string(Session::get('_csrf'))) {
            Session::put('_csrf', bin2hex(random_bytes(32)));
        }

        return (string) Session::get('_csrf');
    }

    public static function valid(mixed $token): bool
    {
        $expected = Session::get('_csrf');

        return is_string($token) && is_string($expected) && hash_equals($expected, $token);
    }
}
