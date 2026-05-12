<?php

declare(strict_types=1);

namespace Meridian\Content;

use Meridian\Database;

class ServiceRepository
{
    private const ICON_MAP = [
        'office'        => 'bi-building',
        'gym'           => 'bi-bicycle',
        'restaurant'    => 'bi-cup-hot',
        'school'        => 'bi-mortarboard',
        'retail'        => 'bi-shop',
        'public'        => 'bi-people',
        'other'         => 'bi-stars',
    ];

    public function getActiveService(): array
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query('SELECT title, slug, description, image FROM services WHERE is_active = 1 ORDER BY sort_order ASC');
        $services = $stmt->fetchAll();

        foreach ($services as $service) {
            $service['icon'] = self::ICON_MAP[$service['slug']] ?? 'bi-stars';
        }
        unset($service);

        return $services;
    }
}
