<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';

use Meridian\Content\SettingRepository;

$repo = new SettingRepository();
$uploadDir = __DIR__ . '/../assets/images/uploads/';
$allowedExt = ['jpg', 'jpeg', 'png'];
$maxByte = 5 * 1024 * 1024; // 5MB

$slots = [
    'staff_photo_1' => 'Why Choose Us - Photo 1',
    'staff_photo_2' => 'Why Choose Us - Photo 2',
    'staff_photo_3' => 'Why Choose Us - Photo 3',
];

// POST handler (PRG pattern)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $key = $_POST['key'] ?? '';

    if (!array_key_exists($key, $slots)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Invalid photo slot.'];
        header('Location: staff.php');
        exit;
    }

    $file = $_FILES['image'] ?? null;

    if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Please choose an image file to upload.'];
        header('Location: staff.php');
        exit;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Upload failed. Please try again.'];
        header('Location: staff.php');
        exit;
    }

    if ($file['size'] > $maxByte) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'File is too large. maximum size is 5MB.'];
        header('Location: staff.php');
        exit;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Only JPG/JPEG and PNG files are allowed.'];
        header('Location: staff.php');
        exit;
    }

    $mime = mime_content_type($file['tmp_name']);
    if (!in_array($mime, ['image/jpeg', 'image/png'], true)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Invalid image file.'];
        header('Location: staff.php');
        exit;
    }

    //Current filename for this slot 
    $currentFilename = $repo->get($key);
    $originalBase  = basename($currentFilename); // strips any existing uploads/ prefix

    $newFilename = 'uploads/' . $originalBase;
    $destination = $uploadDir . $originalBase;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Could not save the file. Please check the folder permission.'];
        header('Location: staff.php');
        exit;
    }

    $repo->set($key, $newFilename);
    $_SESSION['flash'] = ['type' => 'success', 'msg' =>  $slots[$key] . ' updated successfully.'];
    header('Location: staff.php');
    exit;
}

// data ----------------------------------------------------
$all = $repo->getAll();
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Page -meta -------------------------------------------------

$pageTitle = 'Staff Photo';
$activePage = 'staff';

require_once __DIR__ . '/../../admin/templates/admin-header.php';

?>

<div class="admin-content-header">
    <div>
        <h1 class="admin-page-title">Staff Photos</h1>
        <p class="admin-page-sub text-muted">
            Replace the three photos shown in the Why Choose Us section.
            Portrait photos work best — they display tall and narrow side by side.
        </p>
    </div>
</div>

<?php if ($flash): ?>
    <div class="alert alert-<?= htmlspecialchars($flash['type']) ?> alert-dismissible fade show mb-4" role="alert">
        <?= htmlspecialchars($flash['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <?php foreach ($slots as $key => $label): ?>
        <?php $filename = $all[$key] ?? ''; ?>
        <div class="col-12 col-md-4">
            <div class="admin-card h-100 d-flex flex-column p-0 overflow-hidden">

                <!-- Current image thumbnail -->
                <div class="staff-thumb-wrap">
                    <img src="/assets/images/<?= htmlspecialchars($filename) ?>"
                        alt="<?= htmlspecialchars($label) ?>"
                        class="staff-thumb"
                        onerror="this.src=''; this.closest('.staff-thumb-wrap').classList.add('banner-thumb--missing')">
                    <span class="banner-slot-badge"><?= htmlspecialchars($label) ?></span>
                </div>

                <!-- Card body -->
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <p class="small text-muted mb-3">
                        <i class="bi bi-file-image me-1"></i><?= htmlspecialchars($filename) ?>
                    </p>

                    <form method="POST" enctype="multipart/form-data" class="mt-auto">
                        <input type="hidden" name="key" value="<?= htmlspecialchars($key) ?>">

                        <div class="mb-2">
                            <input type="file"
                                name="image"
                                accept=".jpg,.jpeg,.png"
                                class="form-control form-control-sm"
                                data-preview="preview-<?= htmlspecialchars($key) ?>">
                            <div class="form-text">JPG/JPEG or PNG · max 5MB · portrait recommended</div>
                        </div>

                        <!-- Preview before upload -->
                        <img id="preview-<?= htmlspecialchars($key) ?>"
                            src="#"
                            alt="Preview"
                            class="staff-preview d-none mb-2">

                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-arrow-repeat me-1"></i>Replace Photo
                        </button>
                    </form>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../../admin/templates/admin-footer.php'; ?>