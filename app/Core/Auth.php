<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\User;

final class Auth
{
    private static ?array $user = null;
    private static bool $resolved = false;

    public static function login(int $userId): void
    {
        Session::regenerate();
        Session::put('user_id', $userId);

        self::$user = null;
        self::$resolved = false;
    }

    public static function logout(): void
    {
        Session::destroy();

        self::$user = null;
        self::$resolved = false;
    }

    public static function user(): ?array
    {
        if (!self::$resolved) {
            $id = Session::get('user_id');
            self::$user = $id === null ? null : User::findById((int) $id);
            self::$resolved = true;
        }

        return self::$user;
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function role(): ?string
    {
        return self::user()['rol'] ?? null;
    }

    public static function requireLogin(): void
    {
        if (!self::check()) {
            Session::flash('error', 'Inicia sesión para continuar.');
            redirect('/login');
        }
    }

    public static function requireRole(string ...$roles): void
    {
        self::requireLogin();

        if (!in_array(self::role(), $roles, true)) {
            Response::abort(403);
        }
    }
}
