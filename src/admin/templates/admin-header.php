<?php

/**
 * admin-header.php
 *
 * Opens the full admin page structure.
 * Closed by admin-footer.php.
 *
 * Expects from the calling page controller:
 *   $pageTitle  (string) — shown in <title> and topbar
 *   $activePage (string) — passed through to admin-sidebar.php
 *
 * Automatically queries unread message count for the sidebar badge.
 */

use Meridian\Content\MessageRepository;

// Unread badge — every admin page gets this for free
$unreadCount = (new MessageRepository())->countUnread();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Admin') ?> — Meridian FMS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap + Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Admin styles -->
    <link rel="stylesheet" href="/assets/css/admin.css">

    <!-- Optional page-specific CSS -->
    <?php if (!empty($extraCss)): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($extraCss) ?>">
    <?php endif; ?>
</head>

<body>

    <!-- Sidebar overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="admin-wrapper">

        <!-- Sidebar -->
        <?php require_once __DIR__ . '/admin-sidebar.php'; ?>

        <!-- Main -->
        <div class="admin-main">

            <!-- Top bar -->
            <header class="admin-topbar">
                <button class="topbar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="topbar-title"><?= htmlspecialchars($pageTitle ?? 'Admin') ?></h1>
                <div class="topbar-right">
                    <span class="topbar-user">
                        <i class="bi bi-person-circle me-1"></i>Administrator
                    </span>
                </div>
            </header>

            <!-- Page content starts here -->
            <main class="admin-content">