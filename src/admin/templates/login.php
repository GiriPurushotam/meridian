<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Meridian FMS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --blue: #00529B;
            --navy: #003D7A;
            --green: #94B730;
            --light: #F0F7FF;
            --text: #1A2E4A;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
        }

        .login-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 82, 155, 0.10);
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 380px;
        }

        .login-logo {
            display: block;
            margin: 0 auto 1.5rem;
            height: 52px;
        }

        .login-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--navy);
            text-align: center;
            margin-bottom: 0.25rem;
        }

        .login-sub {
            font-size: 0.85rem;
            color: #5A6A80;
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text);
        }

        .form-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 82, 155, 0.15);
        }

        .btn-login {
            background: var(--blue);
            border: none;
            color: #fff;
            font-weight: 600;
            width: 100%;
            padding: 0.65rem;
            border-radius: 8px;
            margin-top: 0.5rem;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: var(--navy);
            color: #fff;
        }

        .pw-wrapper {
            position: relative;
        }

        .pw-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #5A6A80;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .pw-toggle:hover {
            color: var(--blue);
        }
    </style>
</head>

<body>

    <div class="login-card">

        <img src="/assets/images/logo-full.png" alt="Meridian FMS" class="login-logo">

        <p class="login-title">Admin Panel</p>
        <p class="login-sub">Meridian Facility Management Services</p>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2" role="alert">
                <i class="bi bi-exclamation-circle me-1"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/admin/index.php" novalidate>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="pw-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter admin password"
                        required
                        autofocus
                        autocomplete="current-password">
                    <button type="button" class="pw-toggle" id="togglePw" aria-label="Toggle password visibility">
                        <i class="bi bi-eye" id="pwIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-lock me-1"></i> Sign In
            </button>
        </form>

    </div>

    <script>
        document.getElementById('togglePw').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = document.getElementById('pwIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        });
    </script>

</body>

</html>