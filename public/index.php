<?php

declare(strict_types=1);

require dirname(__DIR__) . '/app/bootstrap.php';

use App\Core\Config;
use App\Core\Csrf;
use App\Core\Response;
use App\Core\Router;
use App\Core\Session;

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !Csrf::valid($_POST['_token'] ?? null)) {
    Response::abort(419);
}

$router = new Router();
require BASE_PATH . '/routes/web.php';

try {
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (Throwable $e) {
    error_log($e->getMessage() . PHP_EOL . $e->getTraceAsString());

    Response::abort(500, Config::get('app.debug') ? $e->getMessage() : '');
}
