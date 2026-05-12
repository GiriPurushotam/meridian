<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use Meridian\Content\BannerRepository;
use Meridian\Content\ServiceRepository;
use Meridian\Content\SettingRepository;

$pageTitle  = 'Home';
$activePage = 'home';

$banners    = (new BannerRepository())->getActiveBanner();
$services   = (new ServiceRepository())->getActiveService();
$settings   = (new SettingRepository())->getAll();

$staffPhotos = [
    $settings['staff_photo_1'] ?? 'washroom.jpeg',
    $settings['staff_photo_2'] ?? 'sink.jpeg',
    $settings['staff_photo_3'] ?? 'floors.jpeg',
];




// ── Templates ─────────────────────────────────────────────

$tplBase = __DIR__ . '/../templates';

// ── Layout: open ─────────────────────────────────────────────

require_once $tplBase . '/layout/header.php';

require_once $tplBase . '/sections/hero.php';
require_once $tplBase . '/sections/why-choose-us.php';
require_once $tplBase . '/sections/services.php';
require_once $tplBase . '/sections/about-snippet.php';
require_once $tplBase . '/sections/contact-cta.php';

// ── Layout: close ─────────────────────────────────────────────
require_once $tplBase . '/layout/footer.php';
