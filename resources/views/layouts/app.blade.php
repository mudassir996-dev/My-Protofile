<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', ($settings->name ?? 'Mudassir Yaseen') . ' - Portfolio')</title>
    <meta name="description" content="@yield('meta_description', $settings->summary ?? 'Full Stack Developer Portfolio')">
    
    <!-- SEO Meta Tags -->
    <meta property="og:title" content="@yield('title', ($settings->name ?? 'Mudassir Yaseen') . ' - Portfolio')">
    <meta property="og:description" content="@yield('meta_description', $settings->summary ?? 'Full Stack Developer Portfolio')">
    <meta property="og:type" content="website">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Anti-Flash Dark Mode Script -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- FontAwesome (For category and skill icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles and Scripts via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('js/portfolio.js') }}" defer></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 transition-colors duration-300 min-h-screen flex flex-col">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-100 dark:border-slate-800/60 transition-colors duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <span class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-extrabold text-xl shadow-md shadow-indigo-200 dark:shadow-none transition-transform group-hover:scale-105">
                    M
                </span>
                <span class="font-extrabold text-xl tracking-tight text-slate-900 dark:text-white">
                    Mudassir<span class="text-indigo-600">.</span>
                </span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8 font-medium">
                <a href="{{ route('home') }}#home" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Home</a>
                <a href="{{ route('home') }}#about" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">About</a>
                <a href="{{ route('home') }}#skills" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Skills</a>
                <a href="{{ route('home') }}#experience" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Experience</a>
                <a href="{{ route('home') }}#projects" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Projects</a>
                <a href="{{ route('blog.index') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Blog</a>
                <a href="{{ route('home') }}#contact" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Contact</a>
            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-4">
                <!-- Theme Toggle Vue App -->
                <div id="theme-toggle-app"></div>

                <!-- Mobile Menu Button -->
                <button 
                    id="mobile-menu-btn"
                    class="md:hidden p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-200 focus:outline-none"
                    aria-label="Open Menu"
                >
                    <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 px-4 py-4 space-y-3 transition-colors duration-300">
            <a href="{{ route('home') }}#home" class="block py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold transition-colors">Home</a>
            <a href="{{ route('home') }}#about" class="block py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold transition-colors">About</a>
            <a href="{{ route('home') }}#skills" class="block py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold transition-colors">Skills</a>
            <a href="{{ route('home') }}#experience" class="block py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold transition-colors">Experience</a>
            <a href="{{ route('home') }}#projects" class="block py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold transition-colors">Projects</a>
            <a href="{{ route('blog.index') }}" class="block py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold transition-colors">Blog</a>
            <a href="{{ route('home') }}#contact" class="block py-2 px-3 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold transition-colors">Contact</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-950 border-t border-slate-100 dark:border-slate-800/80 transition-colors duration-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Column 1: Info -->
                <div class="space-y-4 md:col-span-2">
                    <span class="font-extrabold text-xl tracking-tight text-slate-900 dark:text-white">
                        Mudassir<span class="text-indigo-600">.</span>
                    </span>
                    <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm">
                        {{ $settings->tagline ?? 'Full Stack Web Developer specialized in PHP, Laravel, and Vue.js.' }}
                    </p>
                </div>
                
                <!-- Column 2: Navigation -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Links</h4>
                    <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                        <li><a href="{{ route('home') }}#home" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Home</a></li>
                        <li><a href="{{ route('home') }}#about" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">About</a></li>
                        <li><a href="{{ route('home') }}#skills" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Skills</a></li>
                        <li><a href="{{ route('home') }}#projects" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Projects</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact & Admin -->
                <div>
                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white uppercase tracking-wider mb-4">Admin</h4>
                    <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Admin Panel</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Sign In</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-100 dark:border-slate-800/80 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-slate-400 dark:text-slate-500">
                    &copy; {{ date('Y') }} {{ $settings->name ?? 'Mudassir Yaseen' }}. All rights reserved.
                </p>
                <div class="flex gap-4">
                    @if($settings->github_url)
                        <a href="https://{{ str_replace('https://', '', $settings->github_url) }}" target="_blank" rel="noopener" class="text-slate-400 hover:text-slate-600 dark:hover:text-white transition-colors" aria-label="GitHub">
                            <i class="fab fa-github text-lg"></i>
                        </a>
                    @endif
                    @if($settings->linkedin_url)
                        <a href="https://{{ str_replace('https://', '', $settings->linkedin_url) }}" target="_blank" rel="noopener" class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" aria-label="LinkedIn">
                            <i class="fab fa-linkedin text-lg"></i>
                        </a>
                    @endif
                    @if($settings->email)
                        <a href="mailto:{{ $settings->email }}" class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" aria-label="Email">
                            <i class="fas fa-envelope text-lg"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
            // Close menu when clicked a link
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.classList.add('hidden');
                });
            });
        }
    </script>
</body>
</html>
