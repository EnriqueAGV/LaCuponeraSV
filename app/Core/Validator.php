<?php

declare(strict_types=1);

namespace App\Core;

use DateTimeImmutable;
use LogicException;

final class Validator
{
    private array $errors = [];

    private function __construct(private array $data)
    {
    }

    /**
     * Reglas separadas por "|" y argumentos con ":". Ejemplo: 'required|min:3|max:20'.
     */
    public static function make(array $data, array $rules): self
    {
        $validator = new self($data);

        foreach ($rules as $field => $ruleSet) {
            foreach (explode('|', $ruleSet) as $rule) {
                $validator->apply($field, $rule);
            }
        }

        return $validator;
    }

    public function fails(): bool
    {
        return $this->errors !== [];
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function addError(string $field, string $message): void
    {
        $this->errors[$field] ??= $message;
    }

    private function apply(string $field, string $rule): void
    {
        [$name, $argument] = array_pad(explode(':', $rule, 2), 2, null);
        $value = trim((string) ($this->data[$field] ?? ''));

        if ($name === 'required') {
            if ($value === '') {
                $this->addError($field, 'Este campo es obligatorio.');
            }

            return;
        }

        // Un campo opcional vacío no se valida, y solo se guarda el primer error por campo.
        if ($value === '' || isset($this->errors[$field])) {
            return;
        }

        if (!$this->passes($name, $value, $argument)) {
            $this->addError($field, $this->message($name, $argument));
        }
    }

    private function passes(string $rule, string $value, ?string $argument): bool
    {
        return match ($rule) {
            'email' => filter_var($value, FILTER_VALIDATE_EMAIL) !== false,
            'min' => mb_strlen($value) >= (int) $argument,
            'max' => mb_strlen($value) <= (int) $argument,
            'username' => preg_match('/^[A-Za-z0-9_.]{4,20}$/', $value) === 1,
            'password' => preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $value) === 1,
            'same' => $value === trim((string) ($this->data[$argument] ?? '')),
            'nit' => preg_match('/^\d{4}-?\d{6}-?\d{3}-?\d$/', $value) === 1,
            'dui' => preg_match('/^\d{8}-?\d$/', $value) === 1,
            'phone' => preg_match('/^\d{4}-?\d{4}$/', $value) === 1,
            'numeric' => is_numeric($value),
            'between' => $this->between($value, (string) $argument),
            'date' => $this->isDate($value),
            'adult' => $this->isAdult($value),
            default => throw new LogicException("Regla de validación desconocida: {$rule}"),
        };
    }

    private function message(string $rule, ?string $argument): string
    {
        return match ($rule) {
            'email' => 'Ingresa un correo electrónico válido.',
            'min' => "Debe tener al menos {$argument} caracteres.",
            'max' => "No puede superar {$argument} caracteres.",
            'username' => 'Usa de 4 a 20 caracteres: letras, números, punto o guion bajo.',
            'password' => 'La contraseña debe tener al menos 8 caracteres, con una letra y un número.',
            'same' => 'Las contraseñas no coinciden.',
            'nit' => 'El NIT debe tener el formato ####-######-###-#.',
            'dui' => 'El DUI debe tener el formato ########-#.',
            'phone' => 'El teléfono debe tener el formato ####-####.',
            'numeric' => 'Debe ser un número.',
            'between' => 'Debe estar entre ' . str_replace(',', ' y ', (string) $argument) . '.',
            'date' => 'Ingresa una fecha válida.',
            'adult' => 'Debes tener al menos 18 años.',
            default => 'Valor no válido.',
        };
    }

    private function between(string $value, string $argument): bool
    {
        [$min, $max] = array_map('floatval', explode(',', $argument));

        return (float) $value >= $min && (float) $value <= $max;
    }

    private function isDate(string $value): bool
    {
        $date = DateTimeImmutable::createFromFormat('!Y-m-d', $value);

        return $date !== false && $date->format('Y-m-d') === $value;
    }

    private function isAdult(string $value): bool
    {
        if (!$this->isDate($value)) {
            return false;
        }

        $birthDate = DateTimeImmutable::createFromFormat('!Y-m-d', $value);

        return $birthDate <= new DateTimeImmutable('-18 years');
    }
}
