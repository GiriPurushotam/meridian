# Meridian FMS — Facility Management Services Website

A full-stack php application built for **meridian facility management services**, a commercial cleaning company based in South East Queensland, Australia.

**Live site:** [meridianfms.com.au](https://meridianfms.com.au)

---

### Tech Stack

- **Backend:** PHP 8.2, PDO, PSR-4 autoloading, Composer
- **Frontend:** Bootstrap 5.3, DM Sans, playfair display
- **Database:** MySQL 8
- **Mail:** PHPMailer 6.9
- **Server:** IONOS Web Hosting, Apache, HTTPS
- **Dev Environment:** Docker, doker-compose
- **Standerds:** PSR-1, PSR-12

---

### Features

### Public Site

- Responsive multi-page website (Home, Services, About, Contact)
- Dynamic hero banner carousel (DB-driven)
- Services section pulled from database
- Contact form with CSRF protection, validation and email notification
- SEO optimized - meta tags, Open Graph, Local Business schema, sitemap.xml
- Google Search Console verified and submitted

### Admin Panel

- Secure login with bcrypt password hashing
- Session-based authentication with session regeneration
- Dashboard with status (messages, services, banners)
- Messages manager - view, reply, mark read/unread, delete
- Banner image management with file upload
- Service image management
- Staff photo management
- Site settings editor (phone, email, address)
- Change password page

### Security

- CSRF tokens on all forms
- PDO prepated statements (SQL injection protected)
- `htmlspecialchars()` on all output (XSS protected)
- Admin routes protected by `auth.php` session guard
- `.env` excluded from version control
- Admin panel excluded from search engine indexing via `robots.txt`

---

## Project Structure

```
meridian/
├── docker-compose.yml
├── docker/php/Dockerfile
├── src/
│   ├── public/              ← document root
│   │   ├── index.php
│   │   ├── services.php
│   │   ├── about.php
│   │   ├── contact.php
│   │   ├── sitemap.xml
│   │   ├── robots.txt
│   │   ├── assets/css/
│   │   ├── assets/js/
│   │   ├── assets/images/
│   │   └── admin/
│   ├── templates/layout/
│   ├── templates/sections/
│   ├── admin/templates/
│   ├── app/
│   │   ├── Database.php
│   │   ├── Content/
│   │   └── Mail/
│   └── config/config.php
└── mysql/init/01_schema.sql
```

---

### Local Development Setup

### Requirements

- Docker Desktop
- VS Code

### Steps

```bash
# Clone the repo
git clone git@github.com:GiriPurushotam/meridian.git\
cd meridian

# Copy environment file
cp .env.example .env
# Fill in your DB and mail credentials in .env

# Start Docker
docker-compose up -d --build

# Install dependencies
docker exec -it meridian-php composer install
```

Visit `http://localhost:8080` for the site and `http://localhost:8081` for PhpMyAdmin.

---

### Archetecture

- **Repository pattern** - all DB queries live in `src/app/Content`, never in page controllers
- **Template System** - shared header/footer with per-page `$extraCss` and `$extraJs` slots
- **Admin auth** - single `auth.php` guard required at top of every admin page
- **PDO singleton** - `Database.php` returns one shared connection

---

### Developer

Built by **Giri Purushotam**

- GitHub: [github.com/GiriPurushotam](https://github.com/GiriPurushotam)

---

_This is a real production project for a real client - live at [meridianfms.com.au](https://meridianfms.com.au)_
