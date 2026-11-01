<?php

declare(strict_types=1);

namespace App\Models;

final class Empresa extends Model
{
    public static function create(int $userId, array $data): void
    {
        self::query(
            'INSERT INTO empresas (user_id, nombre, nit, direccion, telefono)
             VALUES (:user_id, :nombre, :nit, :direccion, :telefono)',
            [
                'user_id' => $userId,
                'nombre' => $data['nombre'],
                'nit' => $data['nit'],
                'direccion' => $data['direccion'],
                'telefono' => $data['telefono'],
            ]
        );
    }

    public static function findById(int $id): ?array
    {
        $row = self::query('SELECT * FROM empresas WHERE id = :id', ['id' => $id])->fetch();

        return $row ?: null;
    }

    public static function findByUserId(int $userId): ?array
    {
        $row = self::query('SELECT * FROM empresas WHERE user_id = :user_id', ['user_id' => $userId])->fetch();

        return $row ?: null;
    }

    public static function existsNit(string $nit): bool
    {
        return self::query('SELECT COUNT(*) FROM empresas WHERE nit = :nit', ['nit' => $nit])->fetchColumn() > 0;
    }

    public static function all(): array
    {
        return self::query(
            "SELECT e.*, u.usuario, u.correo
             FROM empresas e
             JOIN users u ON u.id = e.user_id
             ORDER BY FIELD(e.estado, 'pendiente', 'aprobada', 'rechazada'), e.created_at DESC"
        )->fetchAll();
    }

    public static function countByEstado(string $estado): int
    {
        return (int) self::query('SELECT COUNT(*) FROM empresas WHERE estado = :estado', ['estado' => $estado])->fetchColumn();
    }

    public static function updateEstado(int $id, string $estado, ?float $comision, int $adminId): void
    {
        self::query(
            'UPDATE empresas
             SET estado = :estado, porcentaje_comision = :comision, aprobado_por = :admin_id
             WHERE id = :id',
            ['estado' => $estado, 'comision' => $comision, 'admin_id' => $adminId, 'id' => $id]
        );
    }
}
