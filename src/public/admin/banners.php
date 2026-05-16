<?php

declare(strict_types=1);

session_start();
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';

use Meridian\Content\BannerRepository;

$repo = new BannerRepository();

$uploadDir      = __DIR__ . '/../assets/images/uploads/';
$allowedExt     = ['jpg', 'jpeg', 'png'];
$maxBytes       = 5 * 1024 * 1024;            //  5 MB

// POST handler (PRG pattern) ----------------------------------------------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id < 1) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Invalid banner slot.'];
        header('Location: banners.php');
        exit;
    }

    $file = $_FILES['image'] ?? null;
    if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Please choose an image file to upload'];
        header('Location: banners.php');
        exit;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Uplaod failed. please try again.'];
        header('Location: banners.php');
        exit;
    }

    if ($file['size'] > $maxBytes) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'File is too large. Maximum size is 5MB.'];
        header('Location: banners.php');
        exit;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Only JPG and PNG files are allowed.'];
        header('Location: banners.php');
        exit;
    }

    $mime = mime_content_type($file['tmp_name']);
    if (!in_array($mime, ['image/jpeg', 'image/png'], true)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Invalid image file.'];
        header('Location: banners.php');
        exit;
    }


    // Fetch the target banner row 

    $banners = $repo->getAll();
    $targetRow = null;
    foreach ($banners as $b) {
        if ((int) $b['id'] === $id) {
            $targetRow = $b;
            break;
        }
    }

    if (!$targetRow) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Banner slot not found.'];
        header('Location: banners.php');
        exit;
    }

    // Keep original base filename, store in uploads/
    // e.g. hero-banner.png → uploads/hero-banner.png
    // If already replaced before, strip existing uploads/ prefix first

    $originalBase = basename($targetRow['filename']);
    $newFilename  = 'uploads/' . $originalBase;
    $destination  = $uploadDir . $originalBase;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Could not save the file. Check the folder permission.'];
        header('Location: banners.php');
        exit;
    }

    // Upldate DB filename to uploads/ path

    $repo->update($id, $newFilename);

    $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Banner ' . (int) $targetRow['sort_order'] . ' updated sucessfully.'];
    header('Location: banners.php');
    exit;
}

$banners = $repo->getAll();
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Page meta --------------------------------------------------------------

$pageTitle = 'Banners';
$activePage = 'banners';

require_once __DIR__ . '/../../admin/templates/admin-header.php';
?>

<div class="admin-content-header">
    <div>
        <h1 class="admin-page-title">Hero Banners</h1>
        <p class="admin-page-sub text-muted">
            Replace any banner image. The slide order stays fixed — replacing Banner 1 updates the first slide, and so on.
            Original images are always preserved.
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
    <?php foreach ($banners as $banner): ?>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="admin-card h-100 d-flex flex-column p-0 overflow-hidden">

                <!-- Current image thumbnail -->
                <div class="banner-thumb-wrap">
                    <img src="/assets/images/<?= htmlspecialchars($banner['filename']) ?>"
                        alt="<?= htmlspecialchars($banner['alt_text']) ?>"
                        class="banner-thumb"
                        onerror="this.src=''; this.closest('.banner-thumb-wrap').classList.add('banner-thumb--missing')">
                    <span class="banner-slot-badge">Slide <?= (int) $banner['sort_order'] ?></span>
                </div>

                <!-- Card body -->
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <p class="fw-semibold mb-1 text-truncate" title="<?= htmlspecialchars($banner['alt_text']) ?>">
                        <?= htmlspecialchars($banner['alt_text']) ?>
                    </p>
                    <p class="small text-muted mb-3">
                        <i class="bi bi-file-image me-1"></i><?= htmlspecialchars($banner['filename']) ?>
                    </p>

                    <form method="POST" enctype="multipart/form-data" class="mt-auto">
                        <input type="hidden" name="id" value="<?= (int) $banner['id'] ?>">

                        <div class="mb-2">
                            <input type="file"
                                name="image"
                                accept=".jpg,.jpeg,.png"
                                class="form-control form-control-sm"
                                data-preview="preview-<?= (int) $banner['id'] ?>">
                            <div class="form-text">JPG/JPEG or PNG · max 5MB · recommended 1400×580px</div>
                        </div>

                        <!-- Preview before upload -->
                        <img id="preview-<?= (int) $banner['id'] ?>"
                            src="#"
                            alt="Preview"
                            class="banner-preview d-none mb-2">

                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-arrow-repeat me-1"></i>Replace Banner <?= (int) $banner['sort_order'] ?>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../../admin/templates/admin-footer.php'; ?>