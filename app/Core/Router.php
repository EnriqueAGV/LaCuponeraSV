<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->add('GET', $path, $handler);
    }

    public function post(string $path, array $handler): void
    {
        $this->add('POST', $path, $handler);
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        $path = rtrim($path, '/') ?: '/';
        $pathExists = false;

        foreach ($this->routes as [$routeMethod, $pattern, $handler]) {
            if (preg_match($pattern, $path, $matches) !== 1) {
                continue;
            }

            $pathExists = true;

            if ($routeMethod !== $method) {
                continue;
            }

            // Solo los parámetros con nombre ({id}) se pasan al método del controlador.
            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            [$class, $action] = $handler;

            (new $class())->$action(...$params);

            return;
        }

        Response::abort($pathExists ? 405 : 404);
    }

    private function add(string $method, string $path, array $handler): void
    {
        $pattern = '#^' . preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $path) . '$#';

        $this->routes[] = [$method, $pattern, $handler];
    }
}
