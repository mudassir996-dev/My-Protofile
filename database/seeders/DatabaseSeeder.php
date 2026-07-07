<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'jammudassiryaseen2004@gmail.com'],
            [
                'name' => 'Mudassir Yaseen',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Settings
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Mudassir Yaseen',
                'tagline' => 'Full Stack Web Developer | PHP | Laravel | Vue.js',
                'summary' => 'Motivated and detail-oriented Full Stack Web Developer with hands-on experience in front-end and back-end development using PHP, Laravel, Vue.js, and MySQL. Currently completing a B.Sc. (Hons) in Physics at The Islamia University of Bahawalpur. Experienced in building responsive web applications, collaborating in agile teams, and delivering production-ready code. Fluent in English and Urdu; seeking junior-to-mid-level developer roles locally or remote.',
                'phone' => '+92 326 042 8996',
                'email' => 'jammudassiryaseen2004@gmail.com',
                'github_url' => 'github.com/mudassir-yaseen',
                'linkedin_url' => 'linkedin.com/in/mudassir-yaseen', // Adding a placeholder
                'cv_path' => null,
                'profile_photo' => null,
            ]
        );

        // 3. Skills
        $skills = [
            // Front-End
            ['name' => 'HTML5', 'category' => 'Front-End', 'proficiency' => 95, 'icon' => 'html5'],
            ['name' => 'CSS3', 'category' => 'Front-End', 'proficiency' => 90, 'icon' => 'css3'],
            ['name' => 'Bootstrap 5', 'category' => 'Front-End', 'proficiency' => 85, 'icon' => 'bootstrap'],
            ['name' => 'Vue.js', 'category' => 'Front-End', 'proficiency' => 80, 'icon' => 'vue'],
            ['name' => 'JavaScript (ES6+)', 'category' => 'Front-End', 'proficiency' => 85, 'icon' => 'javascript'],
            ['name' => 'Responsive Design', 'category' => 'Front-End', 'proficiency' => 90, 'icon' => 'responsive'],

            // Back-End
            ['name' => 'PHP', 'category' => 'Back-End', 'proficiency' => 85, 'icon' => 'php'],
            ['name' => 'Laravel (MVC)', 'category' => 'Back-End', 'proficiency' => 85, 'icon' => 'laravel'],
            ['name' => 'REST API Development', 'category' => 'Back-End', 'proficiency' => 80, 'icon' => 'api'],
            ['name' => 'C++', 'category' => 'Back-End', 'proficiency' => 70, 'icon' => 'cpp'],

            // Database
            ['name' => 'MySQL', 'category' => 'Database', 'proficiency' => 80, 'icon' => 'mysql'],
            ['name' => 'Database Design', 'category' => 'Database', 'proficiency' => 80, 'icon' => 'database-design'],
            ['name' => 'CRUD Operations', 'category' => 'Database', 'proficiency' => 90, 'icon' => 'crud'],

            // Tools & Workflow
            ['name' => 'Git', 'category' => 'Tools & Workflow', 'proficiency' => 85, 'icon' => 'git'],
            ['name' => 'GitHub', 'category' => 'Tools & Workflow', 'proficiency' => 85, 'icon' => 'github'],
            ['name' => 'VS Code', 'category' => 'Tools & Workflow', 'proficiency' => 90, 'icon' => 'vscode'],
            ['name' => 'Postman', 'category' => 'Tools & Workflow', 'proficiency' => 80, 'icon' => 'postman'],
            ['name' => 'npm', 'category' => 'Tools & Workflow', 'proficiency' => 75, 'icon' => 'npm'],
            ['name' => 'Composer', 'category' => 'Tools & Workflow', 'proficiency' => 80, 'icon' => 'composer'],

            // Soft Skills
            ['name' => 'Problem-Solving', 'category' => 'Soft Skills', 'proficiency' => 85, 'icon' => 'problem-solving'],
            ['name' => 'Teamwork', 'category' => 'Soft Skills', 'proficiency' => 90, 'icon' => 'teamwork'],
            ['name' => 'Communication', 'category' => 'Soft Skills', 'proficiency' => 85, 'icon' => 'communication'],
            ['name' => 'Time Management', 'category' => 'Soft Skills', 'proficiency' => 80, 'icon' => 'time-management'],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill
            );
        }

        // 4. Experience
        Experience::updateOrCreate(
            ['company' => 'Crescent Company', 'role' => 'Web Developer'],
            [
                'start_date' => 'Jan 2024',
                'end_date' => 'Present',
                'description' => [
                    'Full-stack development of responsive web apps using PHP, Laravel, MySQL',
                    'UI components with HTML5, CSS3, Bootstrap, Vue.js',
                    'Bug fixing across front-end and back-end',
                    'Git-based collaboration, code reviews, daily standups'
                ]
            ]
        );

        Experience::updateOrCreate(
            ['company' => 'Indolike Company', 'role' => 'Full Stack Developer Intern'],
            [
                'start_date' => 'Jun 2023',
                'end_date' => 'Jul 2023',
                'description' => [
                    'Built responsive websites from scratch',
                    'Worked with HTML5, CSS3, PHP, MySQL'
                ]
            ]
        );

        // 5. Education
        Education::updateOrCreate(
            ['institute' => 'The Islamia University of Bahawalpur', 'degree' => 'BSc (Hons) Physics'],
            [
                'start_year' => '2022',
                'end_year' => '2026',
                'grade' => 'CGPA 3.18/4.00',
            ]
        );

        Education::updateOrCreate(
            ['institute' => 'Govt. Khawaja Fareed Graduate College', 'degree' => 'Intermediate ICS'],
            [
                'start_year' => '2020',
                'end_year' => '2022',
                'grade' => '60%, 1st Division',
            ]
        );

        Education::updateOrCreate(
            ['institute' => 'Govt. Secondary High School Amin Garh', 'degree' => 'Matriculation Science'],
            [
                'start_year' => '2018',
                'end_year' => '2020',
                'grade' => '74.54%, 1st Division',
            ]
        );

        // 6. Projects
        Project::updateOrCreate(
            ['slug' => 'personal-portfolio-website'],
            [
                'title' => 'Personal Portfolio Website',
                'description' => 'A clean and personal portfolio website showcasing profile details, skills, experiences, and education, featuring clean contact forms and a modern layout.',
                'tech_stack' => ['HTML5', 'CSS3', 'Bootstrap', 'JavaScript', 'PHP'],
                'image' => null,
                'live_url' => 'https://mudassiryaseen.com',
                'github_url' => 'https://github.com/mudassir-yaseen/portfolio',
                'order' => 1,
            ]
        );

        Project::updateOrCreate(
            ['slug' => 'student-management-system'],
            [
                'title' => 'Student Management System',
                'description' => 'A comprehensive management system built using Laravel MVC architecture, MySQL, and a Vue.js dashboard, complete with role-based authentication and student records CRUD.',
                'tech_stack' => ['Laravel', 'MySQL', 'Vue.js', 'Bootstrap', 'Authentication'],
                'image' => null,
                'live_url' => '',
                'github_url' => 'https://github.com/mudassir-yaseen/student-management-system',
                'order' => 2,
            ]
        );

        Project::updateOrCreate(
            ['slug' => 'e-commerce-product-listing-app'],
            [
                'title' => 'E-commerce Product Listing App',
                'description' => 'A lightweight product listing app featuring product categories, real-time search & filters, a shopping cart system, and an admin panel to manage product listings.',
                'tech_stack' => ['PHP', 'Bootstrap', 'MySQL', 'JavaScript'],
                'image' => null,
                'live_url' => '',
                'github_url' => 'https://github.com/mudassir-yaseen/ecommerce-listing',
                'order' => 3,
            ]
        );

        // 7. Testimonials
        Testimonial::updateOrCreate(
            ['name' => 'Dr. Adnan Malik'],
            [
                'position' => 'Senior Developer / Manager',
                'company' => 'Crescent Company',
                'message' => 'Mudassir is an exceptional full-stack developer who consistently delivers high-quality work. His problem-solving abilities and dedication to clean code were of great value to our agile team.',
                'photo' => null,
            ]
        );

        Testimonial::updateOrCreate(
            ['name' => 'Sarah Connor'],
            [
                'position' => 'Project Lead',
                'company' => 'Indolike Company',
                'message' => 'During his internship, Mudassir showed incredible learning speed and was able to build multiple responsive web interfaces from scratch. A great team player!',
                'photo' => null,
            ]
        );

        // 8. Blog Posts
        BlogPost::updateOrCreate(
            ['slug' => 'getting-started-with-laravel-and-vue-hybrid-stack'],
            [
                'title' => 'Getting Started with Laravel & Vue Hybrid Stack',
                'content' => '<p>In this post, we explore how to integrate Vue.js 3 inside a traditional Laravel Blade environment without the complexity of Inertia.js. We mount individual Vue components to handle interactive pieces like contact forms, and keep Blade for server-side HTML rendering.</p><h5>Why this stack?</h5><ul><li>Fast page load times</li><li>Simple routing and MVC logic</li><li>Targeted interactivity</li></ul><p>By registering components globally on a root app, we can leverage the strengths of both technologies easily!</p>',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
            ]
        );

        BlogPost::updateOrCreate(
            ['slug' => 'balancing-physics-and-programming'],
            [
                'title' => 'Balancing Physics and Programming: A Developer\'s Journey',
                'content' => '<p>As a B.Sc. (Hons) Physics student at The Islamia University of Bahawalpur, I am often asked: why code? The truth is, physics teaches you deep analytical problem-solving skills that translate perfectly into writing code. Solving differential equations and debugging software both require breaking down complex systems into logical steps.</p><p>This post discusses how my studies in physics have helped me approach software architecture, algorithm design, and data structures with a unique perspective.</p>',
                'featured_image' => null,
                'is_published' => true,
                'published_at' => now(),
            ]
        );
    }
}
