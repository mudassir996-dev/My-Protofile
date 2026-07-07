<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Portfolio</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles and Scripts via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-300 flex flex-col justify-between flex-shrink-0">
        <div>
            <!-- Branding -->
            <div class="h-20 flex items-center px-6 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-indigo-600 flex items-center justify-center text-white font-extrabold text-lg">
                        A
                    </span>
                    <span class="font-extrabold text-lg tracking-tight text-white">
                        AdminPanel
                    </span>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-chart-line w-5 text-center"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.settings.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-cogs w-5 text-center"></i>
                    Settings
                </a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-folder-open w-5 text-center"></i>
                    Projects
                </a>
                <a href="{{ route('admin.skills.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.skills.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-laptop-code w-5 text-center"></i>
                    Skills
                </a>
                <a href="{{ route('admin.experiences.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.experiences.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-briefcase w-5 text-center"></i>
                    Experience
                </a>
                <a href="{{ route('admin.education.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.education.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-graduation-cap w-5 text-center"></i>
                    Education
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-comment-dots w-5 text-center"></i>
                    Testimonials
                </a>
                <a href="{{ route('admin.blogs.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.blogs.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-newspaper w-5 text-center"></i>
                    Blog Posts
                </a>
                <a href="{{ route('admin.messages.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-indigo-600 text-white hover:bg-indigo-700' : '' }}">
                    <i class="fas fa-envelope w-5 text-center"></i>
                    Messages
                </a>
            </nav>
        </div>

        <!-- Logout & Account Settings -->
        <div class="p-4 border-t border-slate-800 space-y-1">
            <div class="px-4 py-1 text-xs font-semibold uppercase tracking-wider text-slate-500">User</div>
            <div class="px-4 py-1 font-bold text-sm text-white mb-2">{{ Auth::user()->name }}</div>
            <a href="{{ route('profile.edit') }}" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-slate-400 hover:bg-slate-800 hover:text-white transition-colors text-sm font-semibold mb-1">
                <i class="fas fa-user-cog"></i>
                Account Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-lg text-red-400 hover:bg-red-950/30 hover:text-red-300 transition-colors text-left text-sm font-semibold">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Header -->
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 flex-shrink-0">
            <h1 class="text-xl font-bold text-slate-800">@yield('page_title', 'Dashboard')</h1>
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm flex items-center gap-1.5 transition-colors">
                    <i class="fas fa-external-link-alt text-xs"></i>
                    View Site
                </a>
            </div>
        </header>

        <!-- Main Body -->
        <main class="flex-grow p-8 overflow-y-auto">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-semibold flex items-center gap-2 shadow-sm">
                    <i class="fas fa-exclamation-circle text-red-600 text-lg"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800 text-sm font-semibold shadow-sm space-y-1">
                    <div class="flex items-center gap-2 font-bold mb-1">
                        <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                        Please resolve the errors below:
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-xs text-red-700 pl-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
