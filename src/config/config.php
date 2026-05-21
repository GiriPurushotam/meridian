<?php

declare(strict_types=1);

// Parse .env file manually — Docker auto-injects env vars, but IONOS shared
// hosting does not. This parser handles both environments safely.
$envFile = dirname(__DIR__) . '/.env';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) continue;
        [$key, $val] = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($val);
    }
}

function env(string $key, mixed $default = null): mixed
{
    return $_ENV[$key] ?? getenv($key) ?? $default;
}

// Database
define('DB_HOST', env('DB_HOST', 'localhost'));
define('DB_PORT', env('DB_PORT', '3306'));
define('DB_NAME', env('DB_NAME', ''));
define('DB_USER', env('DB_USER', ''));
define('DB_PASS', env('DB_PASS', ''));

// Mail
define('MAIL_HOST', env('MAIL_HOST', 'smtp.gmail.com'));
define('MAIL_PORT', env('MAIL_PORT', '587'));
define('MAIL_USER', env('MAIL_USER', ''));
define('MAIL_PASS', env('MAIL_PASS', ''));
define('MAIL_FROM', env('MAIL_FROM', 'Operations@meridianfms.com.au'));
define('MAIL_NAME', env('MAIL_NAME', 'Meridian FMS'));

// App
define('APP_ENV', env('APP_ENV', 'production'));
define('APP_DEBUG', env('APP_DEBUG', 'false') === 'true');
