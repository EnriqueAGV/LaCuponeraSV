<?php

declare(strict_types=1);

namespace App\Models;

final class PasswordReset extends Model
{
    // Invalida los enlaces anteriores del usuario antes de crear uno nuevo.
    public static function create(int $userId, string $tokenHash, string $expiresAt): void
    {
        self::invalidatePending($userId);

        self::query(
            'INSERT INTO password_resets (user_id, token_hash, expires_at) VALUES (:user_id, :token_hash, :expires_at)',
            ['user_id' => $userId, 'token_hash' => $tokenHash, 'expires_at' => $expiresAt]
        );
    }

    public static function findValidByHash(string $tokenHash): ?array
    {
        $row = self::query(
            'SELECT * FROM password_resets
             WHERE token_hash = :token_hash AND used_at IS NULL AND expires_at > NOW()
             LIMIT 1',
            ['token_hash' => $tokenHash]
        )->fetch();

        return $row ?: null;
    }

    public static function invalidatePending(int $userId): void
    {
        self::query('UPDATE password_resets SET used_at = NOW() WHERE user_id = :user_id AND used_at IS NULL', ['user_id' => $userId]);
    }
}
