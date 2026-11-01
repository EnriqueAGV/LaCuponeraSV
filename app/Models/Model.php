<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDOStatement;

abstract class Model
{
    protected static function query(string $sql, array $params = []): PDOStatement
    {
        $statement = Database::connection()->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    protected static function lastId(): int
    {
        return (int) Database::connection()->lastInsertId();
    }
}
