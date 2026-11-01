<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    public static function render(string $view, array $data = []): void
    {
        $path = BASE_PATH . '/app/Views/' . str_replace('.', '/', $view) . '.php';

        extract($data, EXTR_SKIP);

        ob_start();
        require $path;
        $content = ob_get_clean();

        require BASE_PATH . '/app/Views/layouts/main.php';
    }
}
