<?php
session_start();

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';

use Meridian\Content\SettingRepository;

$hash = (new SettingRepository())->get('admin_pass', '');
// die('Hash from DB: ' . $hash . ' | Length: ' . strlen($hash));

// Already authenticated — go straight to dashboard
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: /admin/dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = $_POST['password'] ?? '';
    $hash      = (new SettingRepository())->get('admin_pass', '');

    if ($hash !== '' && password_verify($submitted, $hash)) {
        session_regenerate_id(true);
        $_SESSION['admin_logged_in'] = true;
        header('Location: /admin/dashboard.php');
        exit;
    }

    $error = 'Incorrect password. Please try again.';
}

// Render the login page
require_once __DIR__ . '/../../admin/templates/login.php';
