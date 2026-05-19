<?php

/**
 * admin-sidebar.php
 *
 * Included by admin-header.php — never directly.
 *
 * Expects from the calling page controller:
 *   $activePage  (string) — e.g. 'dashboard', 'messages', 'settings'
 *   $unreadCount (int)    — injected by admin-header.php automatically
 */
?>
<aside class="admin-sidebar" id="adminSidebar">

    <!-- Brand -->
    <div class="sidebar-brand">
        <a href="/admin/dashboard.php">
            <img src="/assets/images/logo-full.png" alt="Meridian FMS" style="height:48px; background:#ffffff; border-radius:8px; padding:6px;"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
        </a>
    </div>

    <!-- Navigation -->
    <ul class="sidebar-nav">

        <li class="<?= ($activePage ?? '') === 'dashboard' ? 'active' : '' ?>">
            <a href="/admin/dashboard.php">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="<?= ($activePage ?? '') === 'messages' ? 'active' : '' ?>">
            <a href="/admin/messages.php">
                <i class="bi bi-envelope"></i>
                Messages
                <?php if (!empty($unreadCount) && $unreadCount > 0): ?>
                    <span class="sidebar-badge"><?= (int) $unreadCount ?></span>
                <?php endif; ?>
            </a>
        </li>

        <li class="<?= ($activePage ?? '') === 'settings' ? 'active' : '' ?>">
            <a href="/admin/settings.php">
                <i class="bi bi-gear"></i>
                Settings
            </a>
        </li>

        <li class="<?= ($activePage ?? '') === 'banners' ? 'active' : '' ?>">
            <a href="/admin/banners.php">
                <i class="bi bi-images"></i>
                Banners
            </a>
        </li>

        <li class="<?= ($activePage ?? '') === 'services' ? 'active' : '' ?>">
            <a href="/admin/services.php">
                <i class="bi bi-grid"></i>
                Services
            </a>
        </li>

        <li class="<?= ($activePage ?? '') === 'staff' ? 'active' : '' ?>">
            <a href="/admin/staff.php">
                <i class="bi bi-people"></i>
                Staff Photos
            </a>
        </li>

        <li class="<?= ($activePage ?? '') === 'change-password' ? 'active' : '' ?>">
            <a href="/admin/change-password.php">
                <i class="bi bi-key"></i>
                Change Password
            </a>
        </li>

    </ul>

    <!-- Sign out -->
    <div class="sidebar-footer">
        <a href="/admin/logout.php">
            <i class="bi bi-box-arrow-left"></i>
            Sign Out
        </a>
    </div>

</aside>