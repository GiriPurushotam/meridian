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
}
