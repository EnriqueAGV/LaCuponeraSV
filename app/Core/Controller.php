<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function input(string $key): string
    {
        return trim((string) ($_POST[$key] ?? ''));
    }

    // Para contraseñas: no se recortan espacios.
    protected function rawInput(string $key): string
    {
        return (string) ($_POST[$key] ?? '');
    }

    /**
     * Regresa al formulario con los errores de validación y los valores escritos.
     * $old nunca debe incluir contraseñas.
     */
    protected function backWith(string $path, array $errors, array $old = []): never
    {
        Session::flash('errors', $errors);
        Session::flash('old', $old);

        redirect($path);
    }

    protected function success(string $path, string $message): never
    {
        Session::flash('success', $message);

        redirect($path);
    }

    protected function failure(string $path, string $message): never
    {
        Session::flash('error', $message);

        redirect($path);
    }
}
