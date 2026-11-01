<?php

declare(strict_types=1);

use App\Core\Auth;
use App\Core\Config;
use App\Core\Csrf;
use App\Core\Session;

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function url(string $path = '/'): string
{
    return rtrim((string) Config::get('app.url'), '/') . $path;
}

function app_name(): string
{
    return (string) Config::get('app.name');
}

function redirect(string $path): never
{
    header('Location: ' . url($path));
    exit;
}

function auth(): ?array
{
    return Auth::user();
}

function flashed(string $key, mixed $default = null): mixed
{
    return Session::flashed($key, $default);
}

function old(string $field): string
{
    return (string) (flashed('old', [])[$field] ?? '');
}

function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(Csrf::token()) . '">';
}

function role_label(string $rol): string
{
    return match ($rol) {
        'administrador' => 'Administrador',
        'empresa' => 'Empresa',
        'cliente' => 'Cliente',
        default => $rol,
    };
}

/**
 * Renderiza un campo de formulario con su valor anterior y su mensaje de error.
 * Las contraseñas nunca se devuelven al formulario.
 */
function field(string $name, string $label, string $type = 'text', array $attributes = []): string
{
    $error = flashed('errors', [])[$name] ?? null;
    $value = $type === 'password' ? '' : old($name);

    $extra = '';
    foreach ($attributes as $key => $attributeValue) {
        $extra .= ' ' . e($key) . '="' . e($attributeValue) . '"';
    }

    $invalid = $error !== null ? ' class="is-invalid" aria-invalid="true"' : '';

    $html = '<label class="field"><span>' . e($label) . '</span>';
    $html .= '<input type="' . e($type) . '" name="' . e($name) . '" value="' . e($value) . '"' . $invalid . $extra . '>';

    if ($error !== null) {
        $html .= '<small class="field-error">' . e($error) . '</small>';
    }

    return $html . '</label>';
}
