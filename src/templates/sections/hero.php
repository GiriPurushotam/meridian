<?php

/**
 * templates/sections/hero.php
 *
 * Bootstrap 5 carousel.
 * NOTE: The banner images already have company name + slogan
 * baked in, so we do NOT overlay repeated text on top.
 * We only overlay two action buttons at the bottom.
 *
 * Interval: 3000ms (3 seconds)
 */

if (empty($banners)) {
    $banners = [
        [
            'filename' => 'hero-banner.png',
            'alt_text' => 'Meridian FMS professional cleaning team',
        ],
        [
            'filename' => 'hero-2.png',
            'alt_text' => 'Professional office cleaning services',
        ],
        [
            'filename' => 'hero-3.png',
            'alt_text' => 'Commercial gym cleaning',
        ],
        [
            'filename' => 'hero-4.png',
            'alt_text' => 'Restaurant and hospitality cleaning',
        ],
        [
            'filename' => 'hero-5.png',
            'alt_text' => 'School and childcare facility cleaning',
        ],
    ];
}
?>

<section id="hero" aria-label="Hero slideshow">

    <div id="hero-carousel"
        class="carousel slide"
        data-bs-ride="carousel"
        data-bs-interval="3000">

        <!-- Dot indicators -->
        <div class="carousel-indicators">
            <?php foreach ($banners as $i => $banner): ?>
                <button type="button"
                    data-bs-target="#hero-carousel"
                    data-bs-slide-to="<?= $i ?>"
                    class="<?= $i === 0 ? 'active' : '' ?>"
                    aria-current="<?= $i === 0 ? 'true' : 'false' ?>"
                    aria-label="Slide <?= $i + 1 ?>">
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            <?php foreach ($banners as $i => $banner): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">

                    <img src="/assets/images/<?= htmlspecialchars($banner['filename']) ?>"
                        alt="<?= htmlspecialchars($banner['alt_text']) ?>"
                        class="hero-slide-img"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">

                    <!-- Colour fallback when image missing -->
                    <div class="hero-slide-img"
                        style="display:none; min-height:500px; background:linear-gradient(135deg, #1B3A5C 0%, #1A56A0 100%);">
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- Prev / Next arrows -->
        <button class="carousel-control-prev" type="button"
            data-bs-target="#hero-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button"
            data-bs-target="#hero-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>
</section>