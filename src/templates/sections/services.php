<?php

if (empty($services)) {
    return;
}

?>

<!-- SERVICES --------------------------------- | -->

<section id="services">
    <div class="container">

        <!-- Section header ------------------- | -->

        <div class="text-center mb-5 reveal">
            <span class="section-label">What We Do</span>
            <h2 class="section-title">Our Cleaning Services</h2>
            <p class="section-subtitle">
                Comprehensive solutions tailored for every type of commercial
                and industrial space across South East Queensland.
            </p>
        </div>


        <!-- Cards grid -->

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4 justify-content-center">

            <?php foreach ($services as $service): ?>
                <div class="col reveal">
                    <div class="card service-card h-100">
                        <!-- Service photo (or icon placeholder if no image yet) -->
                        <img src="/assets/images/<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars(html_entity_decode($service['title'])) ?>" class="service-card-img" onerror="this.style.display='none'; this.nextElementSibling.Style.display='flex'">

                        <!-- Colour placeholder shown when image is missing -->
                        <div class="service-card-img-placeholder" style="display: none;">
                            <i class="bi <?= htmlspecialchars($service['icon']) ?>" style="font-size:3.5rem; color:rgba(255,255,255,0.3)"></i>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title"><?= $service['title'] ?></h3>
                            <p class="card-text flex-grow-1"><?= htmlspecialchars($service['description']) ?></p>

                        </div>
                    </div>

                </div><!-- End.card -->
            <?php endforeach; ?>
        </div>

        <!-- Bottom CTA -->

        <div class="text-center mt-5 reveal">
            <a href="/services" class="btn-brand-primary" style="display:inline-block;">
                View All Services <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>


    </div><!-- Container -->
</section>

<!-- END section -->