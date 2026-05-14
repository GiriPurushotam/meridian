<!-- ── footer: start ──────────────────────────────────── -->

<footer id="main-footer">
    <div class="container">
        <div class="row g-4">

            <!-- Col 1: Brand + tagline -->
            <div class="col-12 col-md-4">
                <img src="/assets/images/logo-full.png"
                    alt="Meridian FMS"
                    style="height:60px; background:#ffffff; border-radius:8px; padding:6px; margin-bottom:0.75rem;"
                    onerror="this.style.display='none'">
                <p style="color:rgba(255,255,255,0.65); font-size:0.88rem; line-height:1.6;">
                    Professional cleaning and facility management
                    across South East Queensland.<br>
                    <em style="color:rgba(71, 211, 15, 0.92);">We Bring Back The Shine.</em>
                </p>
            </div>

            <!-- Col 2: Quick links -->
            <div class="col-6 col-md-2">
                <h5>Quick Links</h5>
                <a href="/">Home</a>
                <a href="/services">Services</a>
                <a href="/about">About Us</a>
                <a href="/contact">Contact</a>
            </div>

            <!-- Col 3: Services list -->
            <div class="col-6 col-md-3">
                <h5>Our Services</h5>
                <span>Office Cleaning</span>
                <span>Gym Cleaning</span>
                <span>Restaurant &amp; Pub</span>
                <span>School &amp; Childcare</span>
                <span>Retail Store</span>
                <span>Public Areas</span>
            </div>

            <!-- Col 4: Contact details -->
            <div class="col-12 col-md-3">
                <h5>Contact Us</h5>

                <p class="mb-1">
                    <i class="bi bi-telephone-fill me-2 text-green"></i>
                    <a href="tel:<?= preg_replace('/\s+/', '', $settings['phone'] ?? '') ?>"><?= htmlspecialchars($settings['phone'] ?? '') ?></a>
                </p>

                <p class="mb-1">
                    <i class="bi bi-envelope-fill me-2 text-green"></i>
                    <a href="mailto:<?= htmlspecialchars($settings['email'] ?? '') ?>"
                        style="word-break:break-word;"><?= htmlspecialchars($settings['email'] ?? '') ?></a>
                </p>

                <p class="mb-1">
                    <i class="bi bi-geo-alt-fill me-2 text-green"></i>
                    <?= nl2br(htmlspecialchars($settings['address'] ?? '')) ?>
                </p>

                <!-- Social icons — links to be added when client provides them -->
                <div class="d-flex gap-2 mt-3">
                    <a href="https://www.facebook.com/profile.php?id=61574365701468"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Facebook"
                        style="width:34px;height:34px;background:rgba(255,255,255,0.08);border-radius:6px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-facebook" style="color:rgba(255,255,255,0.7);"></i>
                    </a>
                    <!-- <a href="#" aria-label="Instagram"
                        style="width:34px;height:34px;background:rgba(255,255,255,0.08);border-radius:6px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-instagram" style="color:rgba(255,255,255,0.7);"></i>
                    </a> -->
                    <a href="https://www.linkedin.com/in/meridian-facility-management-37b1163bb/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="LinkedIn"
                        style="width:34px;height:34px;background:rgba(255,255,255,0.08);border-radius:6px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-linkedin" style="color:rgba(255,255,255,0.7);"></i>
                    </a>
                </div>

            </div>
        </div><!-- /.row -->

        <hr class="footer-divider">

        <div class="row footer-bottom">
            <div class="col-12 col-md-6 mb-1">
                &copy; <?= date('Y') ?> Meridian Facility Management Services Pty Ltd. All rights reserved.
            </div>
            <div class="col-12 col-md-6 text-md-end">
                South East Queensland &mdash; ABN pending
            </div>
        </div>

    </div><!-- /.container -->
</footer>
<!-- ── footer: end ──────────────────────────────────── -->

<!-- ── Js files ──────────────────────────────────── -->

<!-- Bootstrap 5 Bundle — includes Popper (needed for dropdowns/tooltips) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<!-- ── Our custom script ──────────────────────────────────── -->
<script src="/assets/js/main.js"></script>


<!-- Page-specific JS — set $extraJs in the page controller -->
<?php if (!empty($extraJs)): ?>
    <script src="<?= htmlspecialchars($extraJs) ?>"></script>
<?php endif; ?>

</body>

</html>