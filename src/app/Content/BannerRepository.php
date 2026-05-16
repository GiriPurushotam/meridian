<?php

declare(strict_types=1);

namespace Meridian\Content;

use Meridian\Database;

class BannerRepository
{
    public function getActiveBanner(): array
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query('SELECT filename, alt_text FROM banners WHERE is_active = 1 ORDER BY sort_order ASC');

        return $stmt->fetchAll();
    }

    public function getAll(): array
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query('SELECT id, filename, alt_text, sort_order FROM banners ORDER BY sort_order ASC');
        return $stmt->fetchAll();
    }

    public function update(int $id, string $fileName): void
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('UPDATE banners SET filename = :filename WHERE id =:id');
        $stmt->execute([':filename' => $fileName, ':id' => $id]);
    }
}
