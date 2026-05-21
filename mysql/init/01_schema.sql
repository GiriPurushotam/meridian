-- -------
-- Meridian FMS - Database schema + seed data 
-- -------
-- 1. settings (key/value store for site-wide config)
CREATE TABLE IF NOT EXISTS settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) NOT NULL UNIQUE,
    `value` TEXT NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB;
INSERT INTO settings (`key`, `value`)
VALUES ('phone', '+61 494 632 063'),
    ('email', 'Operations@meridianfms.com.au'),
    (
        'address',
        'U29/23 Barwon St, Murrumba Downs QLD 4503'
    ),
    ('service_area', 'South East Queensland'),
    ('staff_photo_1', 'washroom.jpeg'),
    ('staff_photo_2', 'sink.jpeg'),
    ('staff_photo_3', 'floors.jpeg');
-- Admin password (default: change immediately after first login)
INSERT INTO settings (`key`, `value`)
VALUES (
        'admin_pass',
        '$2y$12$eWaNlH0tJyOOuaSjbWTkC.aaPfaYV0Q9BhCrY2y.kxTCpLMmq6Y0S'
    );
-- 2. Banners (hero carousel slides)
CREATE TABLE IF NOT EXISTS banners (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    alt_text VARCHAR(255) NOT NULL DEFAULT '',
    sort_order TINYINT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE = InnoDB;
INSERT INTO banners (filename, alt_text, sort_order)
VALUES (
        'hero-banner.png',
        'Meridian FMS team at work',
        1
    ),
    (
        'hero-2.png',
        'Spotless Offices. Productive Teams.',
        2
    ),
    (
        'hero-3.png',
        'Healthy Spaces. Happy People.',
        3
    ),
    (
        'hero-4.png',
        'One Company. All Industries.',
        4
    ),
    (
        'hero-5.png',
        'Your Workplace Deserves the Best.',
        5
    );
-- 3. services  (service cards on homepage + services page)
CREATE TABLE IF NOT EXISTS services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL DEFAULT '',
    sort_order TINYINT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE = InnoDB;
INSERT INTO services (title, slug, description, image, sort_order)
VALUES (
        'Office Cleaning',
        'office',
        'Create a pristine, professional workspace with our premium office cleaning services. We deliver meticulous attention to detail, ensuring a hygienic, organised, and welcoming environment that enhances productivity and leaves a lasting impression on clients.',
        'service-office.png',
        1
    ),
    (
        'Gym Cleaning',
        'gym',
        'Maintain a spotless and sanitary fitness environment with our specialised gym cleaning solutions. From equipment and training zones to locker rooms and high-touch surfaces, we help protect member health while preserving your facility\'s professional image.',
        'service-gym.png',
        2
    ),
    (
        'Restaurant & Pub Cleaning',
        'restaurant',
        'Deliver an exceptional dining experience with our comprehensive restaurant and pub cleaning services. We uphold the highest hygiene standards across dining areas, kitchens, bars, and restrooms.',
        'service-restaurant.png',
        3
    ),
    (
        'School & Childcare Cleaning',
        'school',
        'Provide children and educators with a safe, healthy learning environment through our careful and thorough cleaning services using child-safe practices.',
        'service-school.png',
        4
    ),
    (
        'Retail Store Cleaning',
        'retail',
        'Enhance your customers\' shopping experience with beautifully maintained retail spaces. Floors gleaming, displays dust-free, stores fresh and inviting.',
        'service-retail.png',
        5
    ),
    (
        'Public Area Cleaning',
        'public',
        'Make strong first impressions with professionally maintained lobbies, corridors, and shared facilities — immaculate even in high-traffic environments.',
        'service-public.png',
        6
    ),
    (
        'Other Services',
        'other',
        'Tailored commercial and industrial cleaning solutions designed around your unique requirements, schedules, and compliance needs.',
        'service-other.jpg',
        7
    );
-- 4. messages  (contact form submissions)
CREATE TABLE IF NOT EXISTS messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(30) NOT NULL DEFAULT '',
    message TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_read TINYINT(1) NOT NULL DEFAULT 0
) ENGINE = InnoDB;