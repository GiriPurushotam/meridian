<?php

/**
 * Contact form section template.
 *
 * Expected variables (set by contact.php controller):
 *   $settings   — array from SettingRepository::getAll()
 *   $formStatus — 'success' | 'error' | null
 *   $old        — array of previous POST values for sticky fields
 */

$phone      = $settings['phone']        ?? '+61 494 632 063';
$email      = $settings['email']        ?? 'Operations@meridianfms.com.au';
$address    = $settings['address']      ?? 'U29/23 Barwon St, Murrumba Downs QLD 4503';
$area       = $settings['service_area'] ?? 'South East Queensland';

// Sticky field helpers
function old(string $key, array $old): string
{
    return htmlspecialchars($old[$key] ?? '', ENT_QUOTES);
}
?>

<!-- ── Contact Page ──────────────────────────────────────────────────────── -->
<section class="contact-hero">
    <div class="contact-hero__inner">
        <span class="section-eyebrow">Get in Touch</span>
        <h1 class="contact-hero__title">Contact Us</h1>
        <p class="contact-hero__sub">
            Ready to talk? Reach out and our team will respond within one business day.
        </p>
    </div>
</section>

<section class="contact-body section-pad">
    <div class="container">
        <div class="contact-grid">

            <!-- ── Left: Info cards ────────────────────────────────────────────── -->
            <aside class="contact-info">

                <div class="info-card reveal">
                    <div class="info-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07
                       A19.5 19.5 0 0 1 4.17 11.95 19.79 19.79 0 0 1 1.1 3.32
                       2 2 0 0 1 3.07 1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7
                       3.57 2 2 0 0 1-.45 2.11L7.09 9.91a16 16 0 0 0 6 6l1.27-1.27
                       a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 3.57.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                    </div>
                    <div class="info-card__body">
                        <h3 class="info-card__label">Phone</h3>
                        <a href="tel:<?= preg_replace('/\s+/', '', $phone) ?>" class="info-card__value">
                            <?= htmlspecialchars($phone) ?>
                        </a>
                    </div>
                </div>

                <div class="info-card reveal">
                    <div class="info-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1
                       0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                            <polyline points="22,6 12,13 2,6" />
                        </svg>
                    </div>
                    <div class="info-card__body">
                        <h3 class="info-card__label">Email</h3>
                        <a href="https://mail.google.com/mail/?view=cm&to=<?= rawurlencode($email) ?>"
                            target="_blank"
                            rel="noopener"
                            class="info-card__value">
                            <?= htmlspecialchars($email) ?>
                        </a>
                    </div>
                </div>

                <div class="info-card reveal">
                    <div class="info-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                    </div>
                    <div class="info-card__body">
                        <h3 class="info-card__label">Address</h3>
                        <span class="info-card__value"><?= htmlspecialchars($address) ?></span>
                    </div>
                </div>

                <div class="info-card reveal">
                    <div class="info-card__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="2" y1="12" x2="22" y2="12" />
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10
                       15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                        </svg>
                    </div>
                    <div class="info-card__body">
                        <h3 class="info-card__label">Service Area</h3>
                        <span class="info-card__value"><?= htmlspecialchars($area) ?></span>
                    </div>
                </div>

                <div class="contact-social reveal">
                    <a href="https://www.facebook.com/profile.php?id=61574365701468"
                        target="_blank" rel="noopener" aria-label="Facebook" class="social-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7
                       a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/in/meridian-facility-management-37b1163bb/"
                        target="_blank" rel="noopener" aria-label="LinkedIn" class="social-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2
                       2v7h-4v-7a6 6 0 0 1 6-6z" />
                            <rect x="2" y="9" width="4" height="12" />
                            <circle cx="4" cy="4" r="2" />
                        </svg>
                    </a>
                </div>

            </aside>

            <!-- ── Right: Form ─────────────────────────────────────────────────── -->
            <div class="contact-form-wrap reveal">

                <?php
                /**
                 * @var string|null $formStatus
                 */
                if ($formStatus === 'success'): ?>
                    <div class="form-alert form-alert--success" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                        <div>
                            <strong>Message sent!</strong>
                            Thank you for getting in touch. We'll get back to you within one business day.
                        </div>
                    </div>
                <?php elseif ($formStatus === 'error'): ?>
                    <div class="form-alert form-alert--error" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="12" />
                            <line x1="12" y1="16" x2="12.01" y2="16" />
                        </svg>
                        <div>
                            <strong>Something went wrong.</strong>
                            Please try again or call us directly on
                            <a href="tel:<?= preg_replace('/\s+/', '', $phone) ?>"><?= htmlspecialchars($phone) ?></a>.
                        </div>
                    </div>
                <?php endif; ?>

                <form class="contact-form" method="POST" action="/contact" novalidate
                    id="contactForm">
                    <!-- CSRF token -->
                    <input type="hidden" name="csrf_token"
                        value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

                    <div class="form-row form-row--2">
                        <div class="form-group">
                            <label for="cf_name" class="form-label">Full Name <span class="req">*</span></label>
                            <?php /** @var array $old */ ?>
                            <input type="text" id="cf_name" name="name" class="form-control-custom"
                                placeholder="Jane Smith"
                                value="<?= old('name', $old) ?>"
                                required autocomplete="name">
                            <span class="field-error" id="err_name"></span>
                        </div>
                        <div class="form-group">
                            <label for="cf_email" class="form-label">Email Address <span class="req">*</span></label>
                            <input type="email" id="cf_email" name="email" class="form-control-custom"
                                placeholder="jane@example.com"
                                value="<?= old('email', $old) ?>"
                                required autocomplete="email">
                            <span class="field-error" id="err_email"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cf_phone" class="form-label">Phone Number</label>
                        <input type="tel" id="cf_phone" name="phone" class="form-control-custom"
                            placeholder="+61 4XX XXX XXX"
                            value="<?= old('phone', $old) ?>"
                            autocomplete="tel">
                    </div>

                    <div class="form-group">
                        <label for="cf_message" class="form-label">Message <span class="req">*</span></label>
                        <textarea id="cf_message" name="message" class="form-control-custom form-control-custom--textarea"
                            placeholder="Tell us about your cleaning requirements…"
                            rows="5"
                            required><?= old('message', $old) ?></textarea>
                        <span class="field-error" id="err_message"></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-submit" id="submitBtn">
                        <span class="btn-text">Send Message</span>
                        <span class="btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13" />
                                <polygon points="22 2 15 22 11 13 2 9 22 2" />
                            </svg>
                        </span>
                    </button>

                </form>
            </div><!-- /.contact-form-wrap -->

        </div><!-- /.contact-grid -->
    </div><!-- /.container -->
</section>