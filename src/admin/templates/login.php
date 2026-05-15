<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Meridian FMS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap + Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Admin styles -->
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>

<body class="admin-login">

    <div class="login-card">

        <img src="/assets/images/logo-full.png" alt="Meridian FMS" class="login-logo">

        <p class="login-title">Admin Panel</p>
        <p class="login-sub">Meridian Facility Management Services</p>

        <?php if (!empty($error)): ?>
            <div class="admin-alert danger">
                <i class="bi bi-exclamation-circle"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/admin/index.php" novalidate>
            <div class="admin-form-group">
                <label for="password" class="admin-label">Password</label>
                <div class="pw-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="admin-input"
                        placeholder="Enter admin password"
                        required
                        autofocus
                        autocomplete="current-password">
                    <button type="button" class="pw-toggle" id="togglePw" aria-label="Toggle password visibility">
                        <i class="bi bi-eye" id="pwIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-admin-primary w-100 justify-content-center mt-1">
                <i class="bi bi-lock"></i> Sign In
            </button>
        </form>

    </div>

    <!-- Admin JS (handles password toggle) -->
    <script src="/assets/js/admin.js"></script>

</body>

</html>