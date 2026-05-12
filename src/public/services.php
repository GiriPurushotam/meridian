<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

use Meridian\Content\ServiceRepository;

$pageTitle = 'Services';
$activePage = 'services';

// Data
$services = (new ServiceRepository())->getActiveService();

$tplBase = __DIR__ . '/../templates';


// Layout + Section 

require_once $tplBase . '/layout/header.php';
require_once $tplBase . '/sections/services.php';
require_once $tplBase . '/layout/footer.php';
