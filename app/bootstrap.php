<?php

declare(strict_types=1);

use App\Core\Config;

define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';

    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $file = BASE_PATH . '/app/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

require BASE_PATH . '/app/helpers.php';

Config::load(BASE_PATH . '/config/config.php');

ini_set('log_errors', '1');
ini_set('error_log', BASE_PATH . '/storage/logs/app.log');
