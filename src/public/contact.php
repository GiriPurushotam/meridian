<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/config.php';


use Meridian\Content\SettingRepository;
use Meridian\Content\MessageRepository;
use Meridian\Mail\Mailer;


// Session (CSRF)

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Generate CSRF token once for session 

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle post

$formStatus = null;
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. csrf check
    $submittedToken = $_POST['csrf_token'] ?? '';
    if (!hash_equals($_SESSION['csrf_token'], $submittedToken)) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        header('Location: /contact?status=error');
        exit;
    }

    // 2. collect sanitize input 

    $data = [
        'name'     => trim(strip_tags($_POST['name']  ?? '')),
        'email'    => trim(strip_tags($_POST['email']  ?? '')),
        'phone'    => trim(strip_tags($_POST['phone']  ?? '')),
        'message'  => trim(strip_tags($_POST['message']  ?? '')),
    ];

    //3. Basic server-side validation
    $errors = [];
    if ($data['name'] === '') {
        $errors[] = 'name';
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'email';
    }

    if ($data['message'] === '') {
        $errors[] = 'message';
    }

    if (empty($errors)) {
        // 4.Save to DB (always attempt even if mail fails)
        $saved = false;
        try {
            $saved = (new MessageRepository())->save($data);
        } catch (\Throwable $e) {
            error_log('[Meridian Contact] DB save failed: ' . $e->getMessage());
        }

        // 5. Send notification email (non-blocking -- site works even if mail fails)
        Mailer::sendContactNotification($data);

        // 6. Regenerate CSRF token after successful submission
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

        // 7, PRG redirect - prevent duplicate submission on refresh
        $status = $saved ? 'success' : 'error';
        header("Location: /contact?status={$status}");
        exit;
    } else {
        // Validation failed - keep old values, show inline errors
        // We do not redirect so sticky fields work

        $old        = $data;
        $formStatus = 'error';
    }
}

// GET: check for redirect status param ------------------------------------------------

if ($formStatus === null && isset($_GET['status'])) {
    $formStatus = $_GET['status'] === 'success' ? 'success' : 'error';
}

$settings = (new SettingRepository())->getAll();

$pageTitle = 'Contact Us  — Meridian FMS';
$activePage = 'contact';
$extraCss = '/assets/css/contact.css';
$extraJs = '/assets/js/contact.js';



$tplBase = __DIR__ . '/../templates';

// Layout + Sections 

require_once $tplBase . '/layout/header.php';
require_once $tplBase . '/sections/contact-form.php';
require_once $tplBase . '/layout/footer.php';
