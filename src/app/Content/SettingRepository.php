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

    public function set(string $key, string $value): void
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('INSERT INTO settings (`key`, `value`) VALUES (:key, :value) ON DUPLICATE KEY UPDATE `value` = :value2');
        $stmt->execute([
            ':key'      => $key,
            ':value'    => $value,
            ':value2'   => $value,
        ]);
    }
}
