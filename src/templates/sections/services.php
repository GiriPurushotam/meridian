<?php

if (empty($services)) {
    $services = [
        [
            'title'        => 'Office Cleaning',
            'slug'         => 'office',
            'description'  => 'Create a pristine, professional workspace with our premium office cleaning services. We deliver meticulous attention to detail, ensuring a hygienic, organised, and welcoming environment that enhances productivity.',
            'image'        => 'staff-2.jpg',
            'icon'         => 'bi-building',
        ],

        [
            'title'        => 'Gym Cleaning',
            'slug'         => 'gym',
            'description'  => 'Maintain a spotless and sanitary fitness environment with our specialised gym cleaning solutions. From equipment and training zones to locker rooms and high-touch surfaces, we protect member health.',

            'image'        => 'service-gym.jpg',
            'icon'         => 'bi-bicycle',
        ],

        [
            'title'       => 'Restaurant &amp; Pub Cleaning',
            'slug'        => 'restaurant',
            'description' => 'Deliver an exceptional dining experience with our comprehensive restaurant and pub cleaning services. We uphold the highest hygiene standards across dining areas, kitchens, bars, and restrooms.',
            'image'       => 'service-restaurant.jpg',
            'icon'        => 'bi-cup-hot',
        ],
        [
            'title'       => 'School &amp; Childcare Cleaning',
            'slug'        => 'school',
            'description' => 'Provide children and educators with a safe, healthy learning environment. We use child-safe practices to maintain spotless classrooms, play areas, and facilities where wellbeing comes first.',
            'image'       => 'service-school.jpg',
            'icon'        => 'bi-mortarboard',
        ],
        [
            'title'       => 'Retail Store Cleaning',
            'slug'        => 'retail',
            'description' => 'Enhance your customers\' shopping experience with beautifully maintained retail spaces. Our expert cleaning keeps floors gleaming, displays dust-free, and stores fresh and inviting.',
            'image'       => 'service-retail.jpg',
            'icon'        => 'bi-shop',
        ],
        [
            'title'       => 'Public Area Cleaning',
            'slug'        => 'public',
            'description' => 'Make strong first impressions with professionally maintained public spaces. We ensure lobbies, corridors, and shared facilities remain immaculate, hygienic, and welcoming.',
            'image'       => 'service-public.jpg',
            'icon'        => 'bi-people',
        ],
        [
            'title'       => 'Other Services',
            'slug'        => 'other',
            'description' => 'Need something specific? We provide tailored commercial and industrial cleaning solutions designed around your unique requirements, schedules, and compliance needs.',
            'image'       => 'service-other.jpg',
            'icon'        => 'bi-stars',
        ],
    ];
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
                            <div class="mt-3">
                                <a href="/services/#<?= htmlspecialchars($service['slug']) ?>" class="text-blue fw-600 small"
                                    style="font-weight: 600;">Learn more <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>

                </div><!-- End.card -->
            <?php endforeach; ?>
        </div>

        <!-- Bottom CTA -->

        <div class="text-center mt-5 reveal">
            <a href="/services.php" class="btn-brand-primary" style="display:inline-block;">
                View All Services <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>


    </div><!-- Container -->
</section>

<!-- END section -->