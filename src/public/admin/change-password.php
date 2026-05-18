<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';


use Meridian\Content\SettingRepository;

$repo = new SettingRepository();


// POST handler (PRG pattern)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new     = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $errors = [];

    if ($current === '')      $errors[] = 'Current password is required';
    if ($new     === '')      $errors[] = 'New password is required';
    if ($confirm === '')      $errors[] = 'Please confirm your new password';

    if (empty($errors)) {
        // verify current password against stored hash password
        $storedHash = $repo->get('admin_pass');

        if (!password_verify($current, $storedHash)) {
            $errors[] = 'Current password is incorrect.';
        }

        if ($new !== $confirm) {
            $errors[] = 'New password and confirmation did not match.';
        }

        if (strlen($new) < 8) {
            $errors[] = 'New password must be atleast 8 characters.';
        }
    }

    if (empty($errors)) {
        $newHash = password_hash($new, PASSWORD_BCRYPT);
        $repo->set('admin_pass', $newHash);

        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Password changed successfully.'];
        header('Location: change-password.php');
        exit;
    }

    $_SESSION['flash'] = ['type' => 'danger', 'msg' => implode(' ', $errors)];
    header('Location: change-password.php');
    exit;
}

// Flash message ---------------------------------------------------

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Page meta -------------------------------------------------------

$pageTitle  = 'Change Password';
$activePage = 'change-password';

require_once __DIR__ . '/../../admin/templates/admin-header.php';

?>

<div class="admin-content-header">
    <div>
        <h1 class="admin-page-title">Change Password</h1>
        <p class="admin-page-sub text-muted">Update your admin login password.</p>
    </div>
</div>

<?php if ($flash): ?>
    <div class="alert alert-<?= htmlspecialchars($flash['type']) ?> alert-dismissible fade show mb-4" role="alert">
        <?= htmlspecialchars($flash['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="admin-card" style="max-width: 480px;">

    <form method="POST" novalidate>

        <div class="mb-4">
            <label for="current_password" class="form-label fw-semibold">
                <i class="bi bi-lock me-1 text-primary"></i>Current Password
            </label>
            <div class="input-group">
                <input type="password"
                    id="current_password"
                    name="current_password"
                    class="form-control"
                    autocomplete="current-password"
                    required>
                <button type="button"
                    class="btn btn-outline-secondary password-toggle"
                    data-target="current_password"
                    title="Show/hide password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <div class="mb-4">
            <label for="new_password" class="form-label fw-semibold">
                <i class="bi bi-lock-fill me-1 text-primary"></i>New Password
            </label>
            <div class="input-group">
                <input type="password"
                    id="new_password"
                    name="new_password"
                    class="form-control"
                    autocomplete="new-password"
                    required>
                <button type="button"
                    class="btn btn-outline-secondary password-toggle"
                    data-target="new_password"
                    title="Show/hide password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
            <div class="form-text">Minimum 8 characters.</div>
        </div>

        <div class="mb-4">
            <label for="confirm_password" class="form-label fw-semibold">
                <i class="bi bi-lock-fill me-1 text-primary"></i>Confirm New Password
            </label>
            <div class="input-group">
                <input type="password"
                    id="confirm_password"
                    name="confirm_password"
                    class="form-control"
                    autocomplete="new-password"
                    required>
                <button type="button"
                    class="btn btn-outline-secondary password-toggle"
                    data-target="confirm_password"
                    title="Show/hide password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>

        <hr class="my-4">

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-shield-lock me-2"></i>Update Password
            </button>
            <span class="text-muted small">You will stay logged in after changing.</span>
        </div>

    </form>

</div>

<?php require_once __DIR__ . '/../../admin/templates/admin-footer.php'; ?>