<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';

$pageTitle = 'Services';
$activePage = 'services';

$tplBase = __DIR__ . '/../templates';


// Layout + Section 

require_once $tplBase . '/layout/header.php';
require_once $tplBase . '/sections/services.php';
require_once $tplBase . '/layout/footer.php';
