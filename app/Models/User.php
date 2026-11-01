<?php

declare(strict_types=1);

namespace App\Models;

final class User extends Model
{
    public static function create(array $data): int
    {
        self::query(
            'INSERT INTO users (usuario, correo, password_hash, rol) VALUES (:usuario, :correo, :password_hash, :rol)',
            [
                'usuario' => $data['usuario'],
                'correo' => $data['correo'],
                'password_hash' => $data['password_hash'],
                'rol' => $data['rol'],
            ]
        );

        return self::lastId();
    }

    public static function findById(int $id): ?array
    {
        $row = self::query('SELECT * FROM users WHERE id = :id AND activo = 1', ['id' => $id])->fetch();

        return $row ?: null;
    }

    // Permite iniciar sesión con el usuario o con el correo.
    public static function findByLogin(string $login): ?array
    {
        $row = self::query(
            'SELECT * FROM users WHERE (usuario = :usuario OR correo = :correo) AND activo = 1 LIMIT 1',
            ['usuario' => $login, 'correo' => $login]
        )->fetch();

        return $row ?: null;
    }

    public static function findByCorreo(string $correo): ?array
    {
        $row = self::query('SELECT * FROM users WHERE correo = :correo AND activo = 1 LIMIT 1', ['correo' => $correo])->fetch();

        return $row ?: null;
    }

    public static function existsUsuario(string $usuario): bool
    {
        return self::query('SELECT COUNT(*) FROM users WHERE usuario = :usuario', ['usuario' => $usuario])->fetchColumn() > 0;
    }

    public static function existsCorreo(string $correo): bool
    {
        return self::query('SELECT COUNT(*) FROM users WHERE correo = :correo', ['correo' => $correo])->fetchColumn() > 0;
    }

    public static function updatePassword(int $id, string $passwordHash): void
    {
        self::query('UPDATE users SET password_hash = :hash WHERE id = :id', ['hash' => $passwordHash, 'id' => $id]);
    }

    public static function byRol(string $rol): array
    {
        return self::query('SELECT * FROM users WHERE rol = :rol ORDER BY created_at DESC', ['rol' => $rol])->fetchAll();
    }

    public static function countByRol(string $rol): int
    {
        return (int) self::query('SELECT COUNT(*) FROM users WHERE rol = :rol', ['rol' => $rol])->fetchColumn();
    }
}
