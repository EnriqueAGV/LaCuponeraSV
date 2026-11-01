<?php

// Uso: php tests/run.php
// Pruebas unitarias de las reglas de validación y del formato de datos.

declare(strict_types=1);

require dirname(__DIR__) . '/app/bootstrap.php';

use App\Core\Format;
use App\Core\Validator;

$passed = 0;
$failed = 0;

function check(string $name, bool $condition): void
{
    global $passed, $failed;

    if ($condition) {
        $passed++;
        echo "  ok    {$name}\n";
    } else {
        $failed++;
        echo "  FALLA {$name}\n";
    }
}

function valida(string $rules, mixed $value): bool
{
    return !Validator::make(['campo' => $value], ['campo' => $rules])->fails();
}

echo "NIT\n";
check('acepta formato con guiones', valida('nit', '0614-010101-101-1'));
check('acepta formato sin guiones', valida('nit', '06140101011011'));
check('rechaza NIT corto', !valida('nit', '0614-0101'));

echo "DUI\n";
check('acepta 01234567-8', valida('dui', '01234567-8'));
check('rechaza DUI sin dígito verificador', !valida('dui', '01234567'));

echo "Teléfono\n";
check('acepta 2222-3333', valida('phone', '2222-3333'));
check('rechaza letras', !valida('phone', '2222-ABCD'));

echo "Usuario y contraseña\n";
check('usuario válido', valida('username', 'juan_perez'));
check('usuario con espacios no es válido', !valida('username', 'juan perez'));
check('usuario muy corto no es válido', !valida('username', 'ab'));
check('contraseña con letra y número', valida('password', 'Clave1234'));
check('contraseña sin número no es válida', !valida('password', 'SoloLetras'));
check('contraseña menor a 8 caracteres no es válida', !valida('password', 'a1'));

echo "Fecha de nacimiento\n";
check('mayor de 18 años', valida('date|adult', '1990-05-20'));
check('menor de 18 años no es válido', !valida('date|adult', (new DateTimeImmutable('-10 years'))->format('Y-m-d')));
check('fecha inexistente no es válida', !valida('date|adult', '1990-02-31'));

echo "Otras reglas\n";
check('correo válido', valida('email', 'cliente@correo.com'));
check('correo inválido', !valida('email', 'cliente@'));
check('comisión entre 0 y 100', valida('numeric|between:0,100', '12.5'));
check('comisión mayor a 100 no es válida', !valida('numeric|between:0,100', '101'));
check('confirmación coincide', !Validator::make(
    ['password' => 'Clave1234', 'password_confirmation' => 'Clave1234'],
    ['password_confirmation' => 'same:password']
)->fails());
check('confirmación distinta falla', Validator::make(
    ['password' => 'Clave1234', 'password_confirmation' => 'Otra12345'],
    ['password_confirmation' => 'same:password']
)->fails());
check('campo obligatorio vacío falla', Validator::make(['campo' => ' '], ['campo' => 'required'])->fails());

echo "Formato\n";
check('nit normalizado', Format::nit('06140101011011') === '0614-010101-101-1');
check('dui normalizado', Format::dui('012345678') === '01234567-8');
check('teléfono normalizado', Format::phone('22223333') === '2222-3333');

echo "\n{$passed} correctas, {$failed} fallidas.\n";

exit($failed === 0 ? 0 : 1);
