<section id="why-choose-us">
    <div class="container">

        <!-- Section header -->

        <div class="text-header mb-5 reveal">
            <span class="section-label">Why Meridian</span>
            <h2 class="section-title">Trusted Commercial Cleaning <br>Professionals</h2>
            <p class="section-subtitle">
                If you're looking for dependable commercial cleaning professionals,
                trust Meridian Facility Management Services to deliver exceptional
                results — every single time.
            </p>
        </div>

        <div class="row g-5 align-items-center">

            <!-- Col Left: Feature List ------------------------------------- | -->

            <div class="col-12 col-lg-7">

                <!-- Feature items ------------------------------------------ | -->

                <div class="feature-item reveal">
                    <div class="feature-icon-wrap">
                        <i class="bi bi-award-fill" style="font-size: 1.4rem; color: var(--clr-blue)"></i>
                    </div>
                    <div>
                        <p><strong>High-quality cleaning solutions</strong> keeping workplaces immaculate, professional, and welcoming — so your environment makes the right impression every day.</p>
                    </div>
                </div>

                <div class="feature-item reveal">
                    <div class="feature-icon-wrap">
                        <i class="bi bi-heart-pulse-fill" style="font-size: 1.4rem; color: var(--clr-blue)"></i>
                    </div>
                    <div>
                        <p><strong>Staff wellbeing and client confidence</strong> built on the knowledge that a clean environment is essential for productive, healthy operations.</p>
                    </div>
                </div>

                <div class="feature-item reveal">
                    <div class="feature-icon-wrap">
                        <i class="bi bi-shield-fill-check" style="font-size: 1.4rem; color: var(--clr-blue)"></i>
                    </div>
                    <div>
                        <p><strong>Highest standards of cleanliness</strong> so your premises always reflects the professionalism of your organisation.</p>
                    </div>
                </div>

                <div class="feature-item reveal">
                    <div class="feature-icon-wrap">
                        <i class="bi bi-sliders2" style="font-size:1.4rem; color:var(--clr-blue);"></i>
                    </div>
                    <div>
                        <p><strong>Every service plan customised</strong> to your unique requirements, schedules, and compliance needs — no cookie-cutter contracts.</p>
                    </div>
                </div>

                <!-- Facilities badges -->

                <div class="mt-4 reveal">
                    <p class="section-label mb-2">Facilities We Service</p>
                    <div>
                        <?php
                        $facilities = [
                            'Corporate Offices',
                            'Schools &amp; Education',
                            'Childcare Centres',
                            'Retails Stores',
                            'Hospitality Venues',
                            'Healthcare &amp; Medical',
                            'Strata &amp; Commercial Buildings',
                        ];
                        foreach ($facilities as $facility): ?>
                            <span class="facility-badge"><?= $facility ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div> <!-- End-Col left -->

            <!-- Col right: Staff Photos -->

            <div class="col-12 col-lg-5 reveal">
                <div class="row g-2">

                    <!-- Top row: first two photos side by side -->

                    <div class="col-6">
                        <img src="/assets/images/staff-1.jpg"
                            alt="Cleaning Bathroom Professionally"
                            class="staff-photo"
                            onerror="this.src=''; this.style.background='linear-gradient(180deg,#1B3A5C,#1A56A0)'; this.alt=''">
                    </div>
                    <div class="col-6">
                        <img src="/assets/images/staff-2.jpg"
                            alt="Window cleaning service"
                            class="staff-photo"
                            onerror="this.src=''; this.style.background='linear-gradient(180deg,#1A56A0,#5A9E2F)'; this.alt=''">
                    </div>
                    <!-- Bottom row: third photo full width -->
                    <div class="col-12">
                        <img src="/assets/images/staff-3.jpg"
                            alt="Vacuuming commercial space"
                            class="staff-photo"
                            style="height:200px;"
                            onerror="this.src=''; this.style.background='linear-gradient(180deg,#5A9E2F,#1B3A5C)'; this.alt=''">
                    </div>
                </div><!-- End: row photos -->
            </div><!-- End: Col right -->
        </div><!-- End: row main -->
    </div><!-- End: container -->
</section>