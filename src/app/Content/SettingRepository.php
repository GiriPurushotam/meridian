<?php

declare(strict_types=1);

namespace Meridian\Content;

use Meridian\Database;

class SettingRepository
{
    public function getAll(): array
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query('SELECT `key`, `value` FROM settings');
        return $stmt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public function get(string $key, string $default = ''): string
    {
        $all = $this->getAll();
        return $all[$key] ?? $default;
    }
}
