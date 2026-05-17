<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/config.php';

use Meridian\Content\ServiceRepository;

$repo = new ServiceRepository();
$uploadDir  = __DIR__ . '/../assets/images/uploads/';
$allowedExt = ['jpg', 'jpeg', 'png'];
$maxByte    = 5 * 1024 * 1024;  // 5MB

// POST handler (PRG pattern)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

    if ($id < 1) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Invalid service'];
        header('Location: services.php');
        exit;
    }

    $file = $_FILES['image'] ?? null;
    if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Please choose an image file to uplaod'];
        header('Location: services.php');
        exit;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Upload failed. please try again'];
        header('Location: services.php');
        exit;
    }

    if ($file['size'] > $maxByte) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'File is too large. maximum size is 5MB.'];
        header('Location: services.php');
        exit;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExt, true)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Only JPG/JPEG and PNG files are allowed.'];
        header('Location: services.php');
        exit;
    }

    $mime = mime_content_type($file['tmp_name']);
    if (!in_array($mime, ['image/jpeg', 'image/png'], true)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Invalid image file.'];
        header('Location: services.php');
        exit;
    }

    // Find targer service row 
    $services = $repo->getAll();
    $targetRow = null;
    foreach ($services as $s) {
        if ((int) $s['id'] === $id) {
            $targetRow = $s;
            break;
        }
    }

    if (!$targetRow) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Service not found'];
        header('Location: services.php');
        exit;
    }

    // Keep original base filename (stored in uploads/)
    $originalBase   = basename($targetRow['image']);
    $newImage       = 'uploads/' . $originalBase;
    $destination    = $uploadDir . $originalBase;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        $_SESSION['flash'] = ['type' => 'danger', 'msg' => 'Could not save the file. Please check the folder permission.'];
        header('Location: services.php');
        exit;
    }

    $repo->updateImage($id, $newImage);
    $_SESSION['flash'] = ['type' => 'success', 'msg' => htmlspecialchars($targetRow['title']) . 'Image upload successfully.'];
    header('Location: services.php');
    exit;
}

// Data ---------------------------------------------------------------------
$services = $repo->getAll();
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Page meta 
$pageTitle = 'Services';
$activePage = 'services';

require_once __DIR__ . '/../../admin/templates/admin-header.php';

?>

<div class="admin-content-header">
    <div>
        <h1 class="admin-page-title">Services</h1>
        <p class="admin-page-sub text-muted">
            Replace the image for any service card. Titles and descriptions are managed by your developer.
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
    <?php foreach ($services as $service): ?>
        <div class="col-12 col-md-6 col-xl-4">
            <div class="admin-card h-100 d-flex flex-column p-0 overflow-hidden">

                <!-- Current image thumbnail -->
                <div class="banner-thumb-wrap">
                    <img src="/assets/images/<?= htmlspecialchars($service['image']) ?>"
                        alt="<?= htmlspecialchars($service['title']) ?>"
                        class="banner-thumb"
                        onerror="this.src=''; this.closest('.banner-thumb-wrap').classList.add('banner-thumb--missing')">
                    <span class="banner-slot-badge"><?= htmlspecialchars($service['title']) ?></span>
                </div>

                <!-- Card body -->
                <div class="p-3 d-flex flex-column flex-grow-1">

                    <p class="small text-muted mb-1">
                        <i class="bi bi-link-45deg me-1"></i>
                        slug: <code><?= htmlspecialchars($service['slug']) ?></code>
                    </p>
                    <p class="small text-muted mb-3">
                        <i class="bi bi-file-image me-1"></i><?= htmlspecialchars($service['image']) ?>
                    </p>

                    <form method="POST" enctype="multipart/form-data" class="mt-auto">
                        <input type="hidden" name="id" value="<?= (int) $service['id'] ?>">

                        <div class="mb-2">
                            <input type="file"
                                name="image"
                                accept=".jpg,.jpeg,.png"
                                class="form-control form-control-sm"
                                data-preview="preview-<?= (int) $service['id'] ?>">
                            <div class="form-text">JPG/JPEG or PNG · max 5MB · landscape photos recommended</div>
                        </div>

                        <!-- Preview before upload -->
                        <img id="preview-<?= (int) $service['id'] ?>"
                            src="#"
                            alt="Preview"
                            class="banner-preview d-none mb-2">

                        <button type="submit" class="btn btn-sm btn-primary w-100">
                            <i class="bi bi-arrow-repeat me-1"></i>Replace Image
                        </button>
                    </form>
                </div>

            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/../../admin/templates/admin-footer.php'; ?>