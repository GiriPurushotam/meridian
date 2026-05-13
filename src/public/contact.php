<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use Meridian\Content\SettingRepository;


$pageTitle = 'Contact';
$activePage = 'contact';

$settings = (new SettingRepository())->getAll();

$tplBase = __DIR__ . '/../templates';

// Layout + Sections 

require_once $tplBase . '/layout/header.php';
require_once $tplBase . '/sections/contact-cta.php';
require_once $tplBase . '/layout/footer.php';
