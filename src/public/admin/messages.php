<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';


use Meridian\Content\MessageRepository;

$repo = new MessageRepository();

// POST action handler (PRG pattern)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id > 0) {
        match ($action) {
            'mark_read'     => $repo->markRead($id, true),
            'mark_unread'   => $repo->markRead($id, false),
            'delete'        => $repo->delete($id),
            default         => null,
        };
    }

    header('Location: messages.php');
    exit;
}


$messages       = $repo->getAll();         // newest first
$unreadCount    = $repo->countUnread();


$pageTitle  = 'Messages';
$activePage = 'messages';


require_once __DIR__ . '/../../admin/templates/admin-header.php';

?>


<div class="admin-content-header">
    <div>
        <h1 class="admin-page-title">Messages</h1>
        <p class="admin-page-sub">
            <?php if ($unreadCount > 0): ?>
                <span class="badge bg-danger"><?= $unreadCount ?> unread</span>
            <?php else: ?>
                <span class="text-muted">All caught up — no unread messages.</span>
            <?php endif; ?>
        </p>
    </div>
</div>

<?php if (empty($messages)): ?>
    <div class="admin-empty-state">
        <i class="bi bi-inbox"></i>
        <p>No messages yet. They will appear here once visitors use the contact form.</p>
    </div>
<?php else: ?>

    <div class="admin-card p-0">
        <div class="table-responsive">
            <table class="admin-table messages-table" id="messagesTable">
                <thead>
                    <tr>
                        <th style="width:2rem"></th><!-- unread dot -->
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Preview</th>
                        <th>Received</th>
                        <th style="width:6rem">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $msg): ?>
                        <?php
                        $isUnread = !(bool) $msg['is_read'];
                        $rowClass = $isUnread ? 'msg-unread' : '';
                        $preview  = mb_strimwidth(strip_tags($msg['message']), 0, 72, '…');
                        $received = date('d M Y, g:ia', strtotime($msg['created_at']));
                        $replySubject = rawurlencode('Re: Enquiry from ' . $msg['name']);
                        $replyHref = 'https://mail.google.com/mail/?view=cm&to=' . rawurlencode($msg['email']) . '&su=' . $replySubject;
                        ?>
                        <!-- ── Summary row ── -->
                        <tr class="msg-row <?= $rowClass ?>"
                            data-id="<?= (int) $msg['id'] ?>"
                            role="button"
                            aria-expanded="false"
                            title="Click to expand">
                            <td class="msg-dot-cell">
                                <?php if ($isUnread): ?>
                                    <span class="msg-dot" title="Unread"></span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-semibold"><?= htmlspecialchars($msg['name']) ?></td>
                            <td class="text-muted small"><?= htmlspecialchars($msg['email']) ?></td>
                            <td class="text-muted small"><?= htmlspecialchars($msg['phone'] ?? '—') ?></td>
                            <td class="msg-preview text-muted small"><?= htmlspecialchars($preview) ?></td>
                            <td class="text-muted small text-nowrap"><?= $received ?></td>
                            <td>
                                <div class="d-flex gap-1" onclick="event.stopPropagation()">
                                    <a href="https://mail.google.com/mail/?view=cm&to=<?= rawurlencode($msg['email']) ?>&su=<?= $replySubject ?>"
                                        target="_blank"
                                        rel="noopener"
                                        class="btn btn-xs btn-outline-primary"
                                        title="Reply by email">
                                        <i class="bi bi-reply"></i>
                                    </a>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?= (int) $msg['id'] ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <button type="submit"
                                            class="btn btn-xs btn-outline-danger"
                                            data-confirm="Delete this message from <?= htmlspecialchars($msg['name']) ?>? This cannot be undone."
                                            title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- ── Expanded detail row (hidden by default) ── -->
                        <tr class="msg-detail-row d-none" id="detail-<?= (int) $msg['id'] ?>">
                            <td colspan="7" class="msg-detail-cell">
                                <div class="msg-detail-inner">

                                    <div class="msg-detail-meta">
                                        <span><i class="bi bi-person"></i> <?= htmlspecialchars($msg['name']) ?></span>
                                        <span><i class="bi bi-envelope"></i> <?= htmlspecialchars($msg['email']) ?></span>
                                        <?php if (!empty($msg['phone'])): ?>
                                            <span><i class="bi bi-telephone"></i> <?= htmlspecialchars($msg['phone']) ?></span>
                                        <?php endif; ?>
                                        <span class="ms-auto text-muted small"><i class="bi bi-clock"></i> <?= $received ?></span>
                                    </div>

                                    <div class="msg-detail-body">
                                        <?= nl2br(htmlspecialchars($msg['message'])) ?>
                                    </div>

                                    <div class="msg-detail-actions">
                                        <a href="https://mail.google.com/mail/?view=cm&to=<?= rawurlencode($msg['email']) ?>&su=<?= $replySubject ?>"
                                            target="_blank"
                                            rel="noopener"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-reply me-1"></i>Reply
                                        </a>

                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= (int) $msg['id'] ?>">
                                            <input type="hidden" name="action"
                                                value="<?= $isUnread ? 'mark_read' : 'mark_unread' ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-<?= $isUnread ? 'check2-circle' : 'circle' ?> me-1"></i>
                                                <?= $isUnread ? 'Mark as read' : 'Mark as unread' ?>
                                            </button>
                                        </form>

                                        <form method="POST" class="d-inline ms-auto">
                                            <input type="hidden" name="id" value="<?= (int) $msg['id'] ?>">
                                            <input type="hidden" name="action" value="delete">
                                            <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                data-confirm="Delete this message from <?= htmlspecialchars($msg['name']) ?>? This cannot be undone.">
                                                <i class="bi bi-trash me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- /.table-responsive -->
    </div><!-- /.admin-card -->

<?php endif; ?>

<?php require_once __DIR__ . '/../../admin/templates/admin-footer.php'; ?>