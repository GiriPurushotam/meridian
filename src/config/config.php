<?php

declare(strict_types=1);

// Load .env values safely — Docker passes them as real environment variables,
// but this fallback handles local dev without a package like vlucas/phpdotenv


function env(string $key, mixed $default = null): mixed
{
    $value = $_ENV[$key] ?? getenv($key) ?? $default;
    return $value;
}

// Database 
define('DB_HOST', env('DB_HOST', 'db'));
define('DB_PORT', env('DB_PORT', '3306'));
define('DB_NAME', env('DB_NAME', 'meridian_db'));
define('DB_USER', env('DB_USER', 'meridian_user'));
define('DB_PASS', env('DB_PASS', ''));

//Mail 
define('MAIL_HOST', env('MAIL_HOST', 'smtp.gmail.com'));
define('MAIL_PORT', env('MAIL_PORT', '587'));
define('MAIL_USER', env('MAIL_USER', ''));
define('MAIL_PASS', env('MAIL_PASS', ''));
define('MAIL_FROM', env('MAIL_FROM', 'Operations@meridianfms.com.au'));
define('MAIL_NAME', env('MAIL_NAME', 'Meridian FMS'));

//App
define('APP_ENV', env('APP_ENV', 'production'));
define('APP_DEBUG', env('APP_DEBUG', 'false') === 'true');
