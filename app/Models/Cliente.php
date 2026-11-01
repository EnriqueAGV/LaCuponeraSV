<?php

declare(strict_types=1);

namespace App\Models;

final class Cliente extends Model
{
    public static function create(int $userId, array $data): void
    {
        self::query(
            'INSERT INTO clientes (user_id, nombre, apellidos, dui, fecha_nacimiento)
             VALUES (:user_id, :nombre, :apellidos, :dui, :fecha_nacimiento)',
            [
                'user_id' => $userId,
                'nombre' => $data['nombre'],
                'apellidos' => $data['apellidos'],
                'dui' => $data['dui'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
            ]
        );
    }

    public static function findByUserId(int $userId): ?array
    {
        $row = self::query('SELECT * FROM clientes WHERE user_id = :user_id', ['user_id' => $userId])->fetch();

        return $row ?: null;
    }

    public static function existsDui(string $dui): bool
    {
        return self::query('SELECT COUNT(*) FROM clientes WHERE dui = :dui', ['dui' => $dui])->fetchColumn() > 0;
    }
}
