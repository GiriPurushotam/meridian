<?php
session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';

use Meridian\Content\MessageRepository;
use Meridian\Content\ServiceRepository;
use Meridian\Content\BannerRepository;

$pageTitle  = 'Dashboard';
$activePage = 'dashboard';

$messageRepo = new MessageRepository();
$serviceRepo = new ServiceRepository();
$bannerRepo  = new BannerRepository();

$unreadCount    = $messageRepo->countUnread();
$totalMessages  = count($messageRepo->getAll());
$totalServices  = count($serviceRepo->getActiveService());
$totalBanners   = count($bannerRepo->getActiveBanner());
$recentMessages = array_slice($messageRepo->getAll(), 0, 5);

require_once __DIR__ . '/../../admin/templates/admin-header.php';
?>

<!-- Stat cards -->
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-envelope"></i>
            </div>
            <div>
                <div class="stat-label">Unread Messages</div>
                <div class="stat-value"><?= $unreadCount ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon navy">
                <i class="bi bi-chat-left-text"></i>
            </div>
            <div>
                <div class="stat-label">Total Messages</div>
                <div class="stat-value"><?= $totalMessages ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-grid"></i>
            </div>
            <div>
                <div class="stat-label">Active Services</div>
                <div class="stat-value"><?= $totalServices ?></div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-images"></i>
            </div>
            <div>
                <div class="stat-label">Active Banners</div>
                <div class="stat-value"><?= $totalBanners ?></div>
            </div>
        </div>
    </div>

</div>

<!-- Recent messages -->
<div class="admin-card">

    <div class="admin-card-header">
        <h5><i class="bi bi-envelope me-2"></i>Recent Messages</h5>
        <a href="/admin/messages.php" class="btn-admin-secondary">
            View All
        </a>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($recentMessages)): ?>
            <p class="text-center py-4 mb-0" style="color: var(--muted); font-size: 0.9rem;">
                No messages yet.
            </p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Received</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentMessages as $msg): ?>
                            <tr class="<?= $msg['is_read'] ? '' : 'unread' ?>">
                                <td><?= htmlspecialchars($msg['name']) ?></td>
                                <td><?= htmlspecialchars($msg['email']) ?></td>
                                <td style="max-width: 280px;">
                                    <span style="display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 280px;">
                                        <?= htmlspecialchars($msg['message']) ?>
                                    </span>
                                </td>
                                <td style="white-space: nowrap; color: var(--muted); font-size: 0.82rem;">
                                    <?= date('d M Y, g:i a', strtotime($msg['created_at'])) ?>
                                </td>
                                <td>
                                    <?php if ($msg['is_read']): ?>
                                        <span style="font-size: 0.78rem; color: var(--muted);">Read</span>
                                    <?php else: ?>
                                        <span class="sidebar-badge">New</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<?php require_once __DIR__ . '/../../admin/templates/admin-footer.php'; ?>