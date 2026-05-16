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
    $phone          = trim($_POST['phone']          ?? '');
    $email          = trim($_POST['email']          ?? '');
    $address        = trim($_POST['address']        ?? '');
    $serviceArea   = trim($_POST['service_area']   ?? '');

    $errors = [];

    if ($phone === '')              $errors[] = 'Phone number is required';
    if ($email === '')              $errors[] = 'Email address is required';
    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address';

    if ($address === '')            $errors[] = 'Address in required';
    if ($serviceArea === '')       $errors[] = 'Service Area is required';

    if (empty($errors)) {
        $repo->set('phone',     $phone);
        $repo->set('email',     $email);
        $repo->set('address',     $address);
        $repo->set('service_area',     $serviceArea);

        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Settings saved successfully.'];
        header('Location: settings.php');
        exit;
    }

    // Keep submitted values on error so form stays filled

    $_SESSION['flash'] = ['type' => 'danger', 'msg' => implode(' ', $errors)];
    $_SESSION['settings_input'] = compact('phone', 'email', 'address', 'serviceArea');
    header('Location: settings.php');
    exit;
}

// Load current values ---------------------------------------------

$all = $repo->getAll();

// If bounced back afrer a validation error, restore a submitted values

$input = $_SESSION['settings_input'] ?? null;
unset($_SESSION['settings_input']);

$phone =            $input['phone']         ?? $all['phone']           ?? '';
$email =            $input['email']         ?? $all['email']           ?? '';
$address =          $input['address']       ?? $all['address']         ?? '';
$serviceArea =      $input['serviceArea']   ?? $all['service_area']     ?? '';

// Flash message ------------------------------------------------------

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Page meta    --------------------------------------------------------

$pageTitle  = 'Settings';
$activePage = 'settings';

require_once __DIR__ . '/../../admin/templates/admin-header.php';

?>

<div class="admin-content-header">
    <div>
        <h1 class="admin-page-title">Settings</h1>
        <p class="admin-page-sub text-muted">Update the business contact details shown across the website.</p>
    </div>
</div>

<?php if ($flash): ?>
    <div class="alert alert-<?= htmlspecialchars($flash['type']) ?> alert-dismissible fade show mb-4" role="alert">
        <?= htmlspecialchars($flash['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="admin-card" style="max-width: 640px;">

    <form method="POST" novalidate>

        <div class="mb-4">
            <label for="phone" class="form-label fw-semibold">
                <i class="bi bi-telephone me-1 text-primary"></i>Phone Number
            </label>
            <input type="text"
                id="phone"
                name="phone"
                class="form-control"
                value="<?= htmlspecialchars($phone) ?>"
                placeholder="+61 494 632 063"
                required>
            <div class="form-text">Displayed in the navbar, footer, hero banners, and contact page.</div>
        </div>
        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">
                <i class="bi bi-envelope me-1 text-primary"></i>Email Address
            </label>
            <input type="email"
                id="email"
                name="email"
                class="form-control"
                value="<?= htmlspecialchars($email) ?>"
                placeholder="Operations@meridianfms.com.au"
                required>
            <div class="form-text">Displayed in the footer and contact page. Also used as the notification recipient.</div>
        </div>
        <div class="mb-4">
            <label for="address" class="form-label fw-semibold">
                <i class="bi bi-geo-alt me-1 text-primary"></i>Address
            </label>
            <input type="text"
                id="address"
                name="address"
                class="form-control"
                value="<?= htmlspecialchars($address) ?>"
                placeholder="U29/23 Barwon St, Murrumba Downs QLD 4503"
                required>
            <div class="form-text">Displayed in the footer and contact page.</div>
        </div>
        <div class="mb-4">
            <label for="service_area" class="form-label fw-semibold">
                <i class="bi bi-map me-1 text-primary"></i>Service Area
            </label>
            <input type="text"
                id="service_area"
                name="service_area"
                class="form-control"
                value="<?= htmlspecialchars($serviceArea) ?>"
                placeholder="South East Queensland"
                required>
            <div class="form-text">Displayed in the footer and contact page.</div>
        </div>

        <hr class="my-4">

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-floppy me-2"></i>Save Settings
            </button>
            <span class="text-muted small">Changes apply to the live site immediately.</span>
        </div>

    </form>

</div>

<!-- <?php require_once __DIR__ . '/../../admin/templates/admin-footer.php'; ?> -->