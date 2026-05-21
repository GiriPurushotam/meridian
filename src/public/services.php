<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use Meridian\Content\ServiceRepository;
use Meridian\Content\SettingRepository;

$pageTitle       = 'Our Cleaning Services';
$activePage      = 'services';
$metaDescription = 'Explore Meridian FMS cleaning services — office, gym, restaurant, school, retail and public area cleaning across South East Queensland.';
$canonicalPath   = '/services';

// Data
$services = (new ServiceRepository())->getActiveService();
$settings = (new SettingRepository())->getAll();

$tplBase = __DIR__ . '/../templates';


// Layout + Section 

require_once $tplBase . '/layout/header.php';
require_once $tplBase . '/sections/services.php';
require_once $tplBase . '/layout/footer.php';
