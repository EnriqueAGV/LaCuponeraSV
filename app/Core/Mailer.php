<?php

declare(strict_types=1);

namespace App\Core;

final class Mailer
{
    public static function send(string $to, string $subject, string $body): void
    {
        if (Config::get('mail.driver') === 'mail') {
            $from = Config::get('mail.from');
            mail($to, $subject, $body, "From: {$from}\r\nContent-Type: text/plain; charset=UTF-8");

            return;
        }

        // Modo de desarrollo: el correo queda en storage/logs/mail.log.
        $entry = sprintf("[%s] Para: %s | Asunto: %s\n%s\n\n", date('Y-m-d H:i:s'), $to, $subject, $body);
        file_put_contents(BASE_PATH . '/storage/logs/mail.log', $entry, FILE_APPEND | LOCK_EX);
    }
}
