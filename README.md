# Dynamic Personal Portfolio Website (Laravel + Vue.js + Tailwind CSS)

A complete, production-ready, dynamic personal portfolio website built for **Mudassir Yaseen** (Full Stack Web Developer). It features a beautiful, responsive public-facing portfolio and a full-featured Admin Panel (`/admin`) for managing projects, skills, education history, work timeline, testimonials, blog articles, and contact submissions.

---

## 🛠 Tech Stack

- **Backend:** Laravel 12 (latest stable), Eloquent ORM, MVC Architecture
- **Frontend:** Blade templates, Tailwind CSS, Alpine.js (for auth components)
- **Interactivity:** Vue 3 (AJAX contact forms, dynamic project tag filters, animated skills progress bars, and persistent dark/light mode toggle)
- **Database:** MySQL
- **Tooling:** Vite, Composer, npm

---

## 🚀 Features

- **Responsive Landing Page:** Fully optimized for mobile, tablet, and desktop viewports.
- **Vanilla JS Typist Effect:** Smoothly cycles titles in the Hero section.
- **Vue.js Filtering:** Instantly filters projects by tech tags (HTML5, Laravel, Vue.js, etc.) without page reloads.
- **Scroll Animators:** Skills progress bars animate from 0% to the seeded target when scrolled into view.
- **Contact Inbox:** Submits forms asynchronously via AJAX, stores submissions in the database, sends email notifications to the owner, and shows error or success toast overlays.
- **Rich Blog Engine:** Uses a clean slug structure (`/blog/{slug}`), paginated directory lists, and a rich-text WYSIWYG editor (Trix Editor CDN-based) inside the Admin Panel.
- **Dynamic Sitemap:** Generates a compliant `sitemap.xml` dynamically for search engine optimization (SEO).
- **Admin Dashboard:** Overview stats of inbox messages (showing unread badges), total projects, blogs, and a list of recent messages.
- **Secure Authentication:** Built on Laravel Breeze. Guest registrations are completely disabled for security; only pre-seeded admins can access the backend.

---

## 📂 Project Structure Highlights

- **Controllers:**
  - `app/Http/Controllers/HomeController.php`: Public views, sitemap, CV download, and AJAX contact form submissions.
  - `app/Http/Controllers/Admin/DashboardController.php`: Admin analytics.
  - `app/Http/Controllers/Admin/ProjectController.php`, `SkillController.php`, etc.: Complete resource controllers managing database CRUD screens.
- **Models:**
  - `app/Models/Project.php`, `Skill.php`, `Experience.php`, `Education.php`, `Testimonial.php`, `BlogPost.php`, `ContactMessage.php`, `Setting.php`.
- **Views:**
  - `resources/views/layouts/app.blade.php`: Public wrapper layout (incorporates Outfit/Jakarta Sans fonts, dark mode checks, and header/footer).
  - `resources/views/layouts/admin.blade.php`: Admin sidebar wrapper layout (with flash banners and dashboard navigation).
  - `resources/views/home.blade.php`: Public portfolio landing sections.
  - `resources/views/blog/`: Blog indexes and detail post readers.
  - `resources/views/admin/`: Backend CRUD views.
- **Vue Components:**
  - `resources/js/components/ThemeToggle.vue`: Handles persistent dark mode toggle classes on `<html>`.
  - `resources/js/components/ContactForm.vue`: AJAX request handling with Axios-like fetch, validation feedback, and alerts.
  - `resources/js/components/ProjectsFilter.vue`: Dynamic tag filter showing card highlights, tags, and code repository links.
  - `resources/js/components/SkillsList.vue`: Animates progress bars on page scrolls.

---

## 💻 Local Installation & Setup

Follow these steps to set up the project locally on your machine:

### 1. Prerequisites
Ensure you have the following installed:
- PHP 8.2 or higher (e.g., via XAMPP)
- Composer
- Node.js & npm
- MySQL / MariaDB (e.g., via XAMPP)

### 2. Install Dependencies
Navigate to the project root directory and install PHP packages:
```bash
composer install
```

### 3. Environment Settings
The `.env` file is pre-configured with default database values. If you need to make changes, look for these variables:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=
```
Make sure MySQL is running in your control panel (e.g., XAMPP).

### 4. Create Database & Seed Content
Run the migrations and database seeders. The seeder will automatically create the database `portfolio` if it doesn't exist, and populate it with Mudassir Yaseen's full developer profile:
```bash
php artisan migrate --seed
```

### 5. Link Public Storage
Connect the public storage link to upload/download files like CV PDF and images:
```bash
php artisan storage:link
```

### 6. Frontend Assets (Zero Compilation Required)
The project is configured to load **Tailwind CSS**, **Vue 3**, and **Alpine.js** dynamically via CDN links. 
- **No Node.js or npm installation is required** to run or build assets.
- Changes made to files like `/public/js/portfolio.js` will instantly apply on page refresh!

### 7. Run Servers
Start the Laravel development server:
```bash
php artisan serve
```
Open a browser and navigate to: `http://127.0.0.1:8000`.

---

## 🔒 Seeded Admin Credentials

You can access the admin dashboard by visiting `http://127.0.0.1:8000/admin`. Log in with:

- **Email:** `jammudassiryaseen2004@gmail.com`
- **Password:** `password`

> ⚠️ **Important:** After logging in for the first time, navigate to the Profile section in the sidebar to change your password and email address for security.
