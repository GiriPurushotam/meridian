<?php

if (empty($banners)) {
    $banners = [
        [
            'filename' => 'hero-banner.png',
            'alt_text' => 'Meridian FMS professional cleaning team',
        ],

        [
            'filename' => 'hero-2.jpg',
            'alt_text' => 'Professional office cleaning service',
        ],

        [
            'filename' => 'hero-3.jpg',
            'alt_text' => 'Commercial gym cleaning',
        ],

        [
            'filename' => 'hero-4.jpg',
            'alt_text' => 'Restaurant and hospitality cleaning',
        ],

        [
            'filename' => 'hero-5.jpg',
            'alt_text' => 'School and childcare facility cleaning',
        ],

    ];
}

?>

<section id="hero" aria-label="Hero slideshow">
    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicator">
            <?php foreach ($banners as $i => $banner): ?>
                <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="<?= $i ?>" class="<?= $i === 0 ? 'active' : '' ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i + 1 ?>">
                </button>
            <?php endforeach; ?>
        </div>


        <!---- | Slides ------------------------------------------------- | -->

        <div class="carousel-inner">
            <?php foreach ($banners as $i => $banner): ?>
                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                    <img src="/assets/images/<?= htmlspecialchars($banner['filename']) ?>" alt="<?= htmlspecialchars($banner['alt_text']) ?>"
                        class="hero-slide-img"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">

                    <!-- colour fallback when image file missing -->

                    <div class="hero-slide-img" style="display: none; background:linear-gradient(135deg, #1B3A5C 0%, #1A56A0 100%) ">

                    </div>


                    <div class="hero-overlay"></div>

                    <!-- text caption layered over image -->
                    <div class="hero-caption">
                        <span class="eyebrow">South East Queensland</span>
                        <h1>Meridian Facility <br> Management Services</h1>
                        <p class="tagline">&ldquo;We Bring Back The Shine&rdquo;</p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="/contact" class="btn-brand-primary">Get a Free Quote</a>
                            <a href="/services" class="btn-brand-outline">Our Services</a>
                        </div>
                    </div>

                </div> <!-- End carousel-item -->
            <?php endforeach; ?>
        </div> <!-- End carousel-inner -->

        <!-- prev / Next arrows -------------- | -->
        <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <button class="carousel-control-next" type="button"
            data-bs-target="#hero-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div><!-- End #hero-carousel -->
</section>

<!-- End hero ------------->