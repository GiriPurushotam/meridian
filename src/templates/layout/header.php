<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- ── SEO ───────────────────────────────────────────── -->
    <title><?= htmlspecialchars($pageTitle ?? 'Meridian Facility Management Services') ?> | Meridian FMS</title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'Meridian Facility Management Services — professional commercial cleaning for offices, gyms, restaurants, schools and more across South East Queensland.') ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://meridianfms.com.au<?= htmlspecialchars($canonicalPath ?? '/') ?>">

    <!-- ── Open Graph (Facebook / LinkedIn sharing) ──────── -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Meridian FMS">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle ?? 'Meridian Facility Management Services') ?> | Meridian FMS">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription ?? 'Professional commercial cleaning across South East Queensland.') ?>">
    <meta property="og:url" content="https://meridianfms.com.au<?= htmlspecialchars($canonicalPath ?? '/') ?>">
    <meta property="og:image" content="https://meridianfms.com.au/assets/images/hero-banner.png">

    <!-- ── Google Fonts ──────────────────────────────────── -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">


    <!-- ── Bootstrap 5.3 CSS (CDN) ───────────────────────── -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- Bootstrap Icons — small SVG icon library, used throughout the site -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- ── Our custom CSS ────────────────────────────────── -->
    <link rel="stylesheet" href="/assets/css/main.css">

    <!-- Page-specific CSS — set $extraCss in the page controller -->
    <?php if (!empty($extraCss)): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($extraCss) ?>">
    <?php endif; ?>

    <!-- Favicon placeholder — replace with real icon later -->
    <link rel="icon" type="image/png" href="/assets/images/main-logo.png">

    <!-- ── Local Business Schema — helps Google show rich results ── -->
    <?php if (($activePage ?? '') === 'home'): ?>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "LocalBusiness",
                "name": "Meridian Facility Management Services",
                "image": "https://meridianfms.com.au/assets/images/logo-full.png",
                "url": "https://meridianfms.com.au",
                "telephone": "+61494632063",
                "email": "Operations@meridianfms.com.au",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "U29/23 Barwon St",
                    "addressLocality": "Murrumba Downs",
                    "addressRegion": "QLD",
                    "postalCode": "4503",
                    "addressCountry": "AU"
                },
                "geo": {
                    "@type": "GeoCoordinates",
                    "latitude": -27.2469,
                    "longitude": 152.9864
                },
                "areaServed": "South East Queensland",
                "description": "Professional commercial cleaning services for offices, gyms, restaurants, schools and retail across South East Queensland.",
                "openingHoursSpecification": {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                    "opens": "07:00",
                    "closes": "18:00"
                }
            }
        </script>
    <?php endif; ?>
</head>

<body>

    <!-- ════════════════════════════════════════════════════════════
     NAVIGATION
     • sticky-top      — stays visible as you scroll
     • id="main-navbar" — targeted by our scroll JS (adds shadow)
     ════════════════════════════════════════════════════════════ -->

    <nav id="main-navbar" class="navbar navbar-expand-lg sticky-top">
        <div class="container">

            <!-- ── Logo ──────────────────────────────────────── -->

            <a class="navbar-brand d-flex align-items-center gap-2" href="/">
                <img src="/assets/images/logo-full.png"
                    alt="Meridian FMS"
                    style="height:48px; background:#ffffff; border-radius:8px; padding:6px;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                <span style="display:none;">
                    <span class="text-white fw-bold">MERIDIAN</span><br>
                    <small style="font-size:0.65rem; color: rgba(255,255,255,0.6); letter-spacing:0.08em; text-transform:uppercase;">Facility Management</small>
                </span>
            </a>
            <!-- ── Hamburger toggle (mobile) ─────────────────── -->
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarMenu"
                aria-controls="navbarMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- ── Nav links ──────────────────────────────────── -->
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                    <li class="nav-item">
                        <a class="nav-link <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>"
                            href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($activePage ?? '') === 'services' ? 'active' : '' ?>"
                            href="/services">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>"
                            href="/about">About</a>
                    </li>

                    <!-- Contact is a CTA button — stands out from plain links -->
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="nav-link nav-cta <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>"
                            href="/contact">Get a Quote</a>
                    </li>

                </ul>
            </div>

        </div><!-- /.container -->
    </nav>
    <!-- ── Navigation: end ──────────────────────────────────── -->


</body>

</html>