@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section id="home" class="relative min-h-[calc(100vh-80px)] flex items-center overflow-hidden py-16 md:py-24">
    <!-- Gradient background blur decorative shapes -->
    <div class="absolute top-1/4 left-1/10 w-72 h-72 bg-indigo-400/20 dark:bg-indigo-500/10 rounded-full blur-3xl -z-10 animate-pulse"></div>
    <div class="absolute bottom-1/4 right-1/10 w-96 h-96 bg-purple-400/20 dark:bg-purple-500/10 rounded-full blur-3xl -z-10 animate-pulse duration-5000"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
            
            <!-- Hero Content (7 cols on lg) -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-800/40">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-ping"></span>
                    Available for Freelance & Full-Time Roles
                </span>

                <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold text-slate-900 dark:text-white leading-tight">
                    Hi, I'm <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-400 dark:to-purple-400">{{ $settings->name ?? 'Mudassir Yaseen' }}</span><br>
                    <span id="typed-text" class="text-indigo-600 dark:text-indigo-400"></span><span class="animate-pulse text-indigo-600 dark:text-indigo-400">|</span>
                </h1>

                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    {{ $settings->tagline ?? 'Full Stack Web Developer specialized in PHP, Laravel, and Vue.js.' }}
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                    <a 
                        href="#contact" 
                        class="px-8 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-center shadow-lg shadow-indigo-100 dark:shadow-none hover:scale-105 active:scale-95 transition-all duration-200"
                    >
                        Contact Me
                    </a>
                    <a 
                        href="{{ route('cv.download') }}" 
                        class="px-8 py-4 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-slate-200 font-bold text-center hover:bg-slate-50 dark:hover:bg-slate-700 hover:scale-105 active:scale-95 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download CV
                    </a>
                </div>

                <!-- Social links -->
                <div class="flex justify-center lg:justify-start gap-6 pt-4 text-slate-500 dark:text-slate-400">
                    @if($settings->github_url)
                        <a href="https://{{ str_replace('https://', '', $settings->github_url) }}" target="_blank" rel="noopener" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" aria-label="GitHub">
                            <i class="fab fa-github text-2xl"></i>
                        </a>
                    @endif
                    @if($settings->linkedin_url)
                        <a href="https://{{ str_replace('https://', '', $settings->linkedin_url) }}" target="_blank" rel="noopener" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" aria-label="LinkedIn">
                            <i class="fab fa-linkedin text-2xl"></i>
                        </a>
                    @endif
                    @if($settings->email)
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $settings->email }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" aria-label="Email">
                            <i class="fas fa-envelope text-2xl"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Profile Photo/Avatar container (5 cols on lg) -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-64 h-64 sm:w-80 sm:h-80 md:w-96 md:h-96 rounded-full p-4 bg-white dark:bg-slate-800 shadow-2xl border border-slate-100 dark:border-slate-700/50">
                    <div class="w-full h-full rounded-full overflow-hidden bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-slate-700 dark:to-slate-800 flex items-center justify-center">
                        @if($settings->profile_photo)
                            <img src="{{ asset('storage/' . $settings->profile_photo) }}" alt="{{ $settings->name }}" class="w-full h-full object-cover">
                        @else
                            <!-- Custom Placeholder Graphic -->
                            <svg class="w-3/5 h-3/5 text-indigo-500/80 dark:text-indigo-400/60" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </div>
                    <!-- Absolute decorative badge -->
                    <div class="absolute bottom-6 right-6 bg-white dark:bg-slate-800 py-3 px-5 rounded-2xl shadow-xl flex items-center gap-3 border border-slate-100 dark:border-slate-700/50">
                        <span class="flex h-3 w-3 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </span>
                        <div class="text-left">
                            <p class="text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Status</p>
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Active</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 md:py-28 bg-white dark:bg-slate-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">About Me</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">My Journey & Background</p>
            <div class="w-16 h-1 bg-indigo-600 dark:bg-indigo-400 mx-auto rounded-full mt-2"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            <!-- Summary Column -->
            <div class="lg:col-span-7 space-y-6">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Who is Mudassir Yaseen?</h3>
                <p class="text-slate-600 dark:text-slate-400 leading-relaxed">
                    {{ $settings->summary }}
                </p>

                <!-- Interests Block -->
                <div class="space-y-3 pt-4">
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white">Personal Interests</h4>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach(['Open-Source Contribution', 'Coding Challenges', 'Tech Blogging', 'Photography', 'Traveling'] as $interest)
                            <span class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-sm font-semibold bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/50">
                                <i class="fas fa-heart text-indigo-500 text-xs"></i>
                                {{ $interest }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Side Cards Column (Education Snapshot & Languages) -->
            <div class="lg:col-span-5 space-y-8">
                <!-- Education Snapshot Card -->
                <div class="bg-gradient-to-br from-indigo-600 to-purple-600 text-white p-8 rounded-3xl shadow-xl space-y-4">
                    <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center text-xl">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs uppercase tracking-widest text-indigo-100 font-bold">Featured Education</p>
                        <h4 class="text-xl font-bold">B.Sc. (Hons) in Physics</h4>
                        <p class="text-sm text-indigo-50">The Islamia University of Bahawalpur</p>
                    </div>
                    <p class="text-sm text-indigo-100 leading-relaxed">
                        Currently studying (2022–2026) with a current CGPA of 3.18/4.00. Combining scientific analytical thinking with modern software development techniques.
                    </p>
                </div>

                <!-- Languages Card -->
                <div class="bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-700/50 p-8 rounded-3xl space-y-4">
                    <h4 class="text-lg font-bold text-slate-900 dark:text-white">Languages Spoken</h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <p class="text-sm font-bold text-slate-800 dark:text-white">English</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Professional (Fluent)</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Urdu</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Native Speaker</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Saraiki</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Mother Tongue</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Punjabi</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Regional Speaker</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-20 md:py-28 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Technical Skills</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">My Tech Stack & Expertise</p>
            <div class="w-16 h-1 bg-indigo-600 dark:bg-indigo-400 mx-auto rounded-full mt-2"></div>
        </div>

        <!-- Skills grid grouped by category -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($skills as $category => $categorySkills)
                <div class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-md border border-slate-100 dark:border-slate-700/50 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg">
                                @if($category === 'Front-End')
                                    <i class="fas fa-laptop-code"></i>
                                @elseif($category === 'Back-End')
                                    <i class="fas fa-server"></i>
                                @elseif($category === 'Database')
                                    <i class="fas fa-database"></i>
                                @elseif($category === 'Tools & Workflow')
                                    <i class="fas fa-tools"></i>
                                @else
                                    <i class="fas fa-brain"></i>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $category }}</h3>
                        </div>

                        <!-- Vue Skill progress bars root -->
                        <div class="skills-list-app" data-skills="{{ json_encode($categorySkills) }}">
                            <!-- Fallback for SSR / Search Engines -->
                            <div class="space-y-4">
                                @foreach($categorySkills as $skill)
                                    <div class="space-y-1">
                                        <div class="flex justify-between text-sm">
                                            <span>{{ $skill->name }}</span>
                                            <span>{{ $skill->proficiency }}%</span>
                                        </div>
                                        <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                                            <div class="bg-indigo-600 h-full" style="width: {{ $skill->proficiency }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Experience & Education Combined Timeline -->
<section id="experience" class="py-20 md:py-28 bg-white dark:bg-slate-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Experience Timeline Column -->
            <div class="space-y-10">
                <div class="space-y-3">
                    <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Work History</h2>
                    <p class="text-3xl font-extrabold text-slate-900 dark:text-white">Experience Timeline</p>
                    <div class="w-12 h-1 bg-indigo-600 dark:bg-indigo-400 rounded-full mt-2"></div>
                </div>

                <div class="relative border-l border-slate-200 dark:border-slate-800/80 pl-6 ml-2 space-y-12">
                    @foreach($experiences as $exp)
                        <div class="relative">
                            <!-- Bullet Icon -->
                            <span class="absolute -left-[31px] top-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-indigo-600 dark:bg-indigo-500 ring-4 ring-white dark:ring-slate-950"></span>
                            
                            <div class="space-y-2">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300">
                                    {{ $exp->start_date }} – {{ $exp->end_date }}
                                </span>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $exp->role }}</h3>
                                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $exp->company }}</p>
                                
                                @if(is_array($exp->description))
                                    <ul class="list-disc list-inside text-sm text-slate-600 dark:text-slate-400 space-y-1.5 pt-2 leading-relaxed">
                                        @foreach($exp->description as $bullet)
                                            <li>{{ $bullet }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Education Timeline Column -->
            <div class="space-y-10">
                <div class="space-y-3">
                    <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Academic</h2>
                    <p class="text-3xl font-extrabold text-slate-900 dark:text-white">Education History</p>
                    <div class="w-12 h-1 bg-indigo-600 dark:bg-indigo-400 rounded-full mt-2"></div>
                </div>

                <div class="relative border-l border-slate-200 dark:border-slate-800/80 pl-6 ml-2 space-y-12">
                    @foreach($education as $edu)
                        <div class="relative">
                            <!-- Bullet Icon -->
                            <span class="absolute -left-[31px] top-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-purple-600 dark:bg-purple-500 ring-4 ring-white dark:ring-slate-950"></span>
                            
                            <div class="space-y-2">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300">
                                    {{ $edu->start_year }} – {{ $edu->end_year }}
                                </span>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $edu->degree }}</h3>
                                <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $edu->institute }}</p>
                                @if($edu->grade)
                                    <p class="text-xs text-indigo-600 dark:text-indigo-400 font-bold bg-indigo-50 dark:bg-indigo-900/20 px-2 py-1 rounded inline-block">
                                        Grade / GPA: {{ $edu->grade }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-20 md:py-28 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">My Portfolio</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Recent Projects Done</p>
            <div class="w-16 h-1 bg-indigo-600 dark:bg-indigo-400 mx-auto rounded-full mt-2"></div>
        </div>

        <!-- Vue Projects Filter Grid -->
        <div id="projects-filter-app" data-projects="{{ json_encode($projects) }}" data-tags="{{ json_encode($techTags) }}">
            <!-- Fallback static projects list -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow overflow-hidden border border-slate-100 dark:border-slate-700/50 flex flex-col h-full">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="object-cover w-full h-48">
                        @else
                            <div class="h-48 bg-indigo-50 dark:bg-slate-900 flex items-center justify-center text-indigo-400 font-bold">
                                {{ $project->title }}
                            </div>
                        @endif
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">{{ $project->title }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400 flex-grow mb-4">{{ $project->description }}</p>
                            <div class="flex gap-2">
                                @if($project->live_url)
                                    <a href="{{ $project->live_url }}" target="_blank" class="text-indigo-600 text-sm font-semibold">Live Link</a>
                                @endif
                                @if($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="text-slate-600 text-sm font-semibold">GitHub</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

<!-- Testimonials Section -->
@if(count($testimonials) > 0)
<section class="py-20 md:py-28 bg-white dark:bg-slate-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Recommendations</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">What Clients & Managers Say</p>
            <div class="w-16 h-1 bg-indigo-600 dark:bg-indigo-400 mx-auto rounded-full mt-2"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-slate-50 dark:bg-slate-800/40 p-8 rounded-3xl border border-slate-100 dark:border-slate-700/50 flex flex-col justify-between">
                    <div class="space-y-4">
                        <i class="fas fa-quote-left text-4xl text-indigo-600/30 dark:text-indigo-400/20"></i>
                        <p class="text-slate-600 dark:text-slate-400 italic leading-relaxed text-sm md:text-base">
                            "{{ $testimonial->message }}"
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-4 border-t border-slate-100 dark:border-slate-700/50 mt-6 pt-6">
                        <div class="w-12 h-12 rounded-full overflow-hidden bg-slate-200 dark:bg-slate-700 flex items-center justify-center font-bold text-white text-lg">
                            @if($testimonial->photo)
                                <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($testimonial->name, 0, 1) }}
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white">{{ $testimonial->name }}</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $testimonial->position }} at {{ $testimonial->company }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

<!-- Blog Section -->
<section id="blog" class="py-20 md:py-28 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">My Writing</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Recent Blog Posts</p>
            <div class="w-16 h-1 bg-indigo-600 dark:bg-indigo-400 mx-auto rounded-full mt-2"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $post)
                <article class="bg-white dark:bg-slate-800 rounded-3xl shadow overflow-hidden border border-slate-100 dark:border-slate-700/50 flex flex-col h-full group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="relative overflow-hidden aspect-video bg-slate-100 dark:bg-slate-900">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-slate-800 dark:to-slate-900 text-indigo-400/60 font-bold text-5xl">
                                <i class="fas fa-file-alt"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 mb-2 block uppercase tracking-widest">
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $post->title }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6 flex-grow leading-relaxed line-clamp-3">
                            {{ strip_tags($post->content) }}
                        </p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                            Read Full Article
                            <i class="fas fa-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 px-6 py-3 border border-indigo-600 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-400 dark:hover:text-slate-950 font-semibold rounded-xl transition-all duration-200">
                Browse All Posts
                <i class="fas fa-book-open"></i>
            </a>
        </div>

    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 md:py-28 bg-white dark:bg-slate-950 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h2 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">Get In Touch</h2>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Let's Discuss Your Next Project</p>
            <div class="w-16 h-1 bg-indigo-600 dark:bg-indigo-400 mx-auto rounded-full mt-2"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Contact info card (5 cols) -->
            <div class="lg:col-span-5 space-y-8 bg-slate-50 dark:bg-slate-800/40 p-8 md:p-10 rounded-3xl border border-slate-100 dark:border-slate-700/50">
                <div class="space-y-2">
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Contact Info</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Feel free to reach out via phone, email, or social media networks.</p>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Email Address</p>
                            <a href="mailto:{{ $settings->email }}" class="text-slate-800 dark:text-white font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors break-all">
                                {{ $settings->email }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Phone Call</p>
                            <a href="tel:{{ str_replace(' ', '', $settings->phone) }}" class="text-slate-800 dark:text-white font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                {{ $settings->phone }}
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Location</p>
                            <p class="text-slate-800 dark:text-white font-semibold">Rahim Yar Khan, Punjab, Pakistan</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-lg flex-shrink-0">
                            <i class="fab fa-github"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">GitHub Profile</p>
                            <a href="https://{{ str_replace('https://', '', $settings->github_url) }}" target="_blank" rel="noopener" class="text-slate-800 dark:text-white font-semibold hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                {{ $settings->github_url }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vue AJAX Contact Form (7 cols) -->
            <div class="lg:col-span-7">
                <div id="contact-form-app" data-submit-url="{{ route('contact.submit') }}">
                    <!-- Static Fallback Form -->
                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 bg-white dark:bg-slate-800 p-8 rounded-3xl border border-slate-100 dark:border-slate-700/50">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Your Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Your Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Subject</label>
                            <input type="text" name="subject" required class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white">
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Message</label>
                            <textarea name="message" rows="5" required class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white"></textarea>
                        </div>
                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl">Send Message</button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Typing effect script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const words = ["Full Stack Web Developer", "Laravel Developer", "Vue.js Developer"];
        let i = 0;
        let timer;
        const typedTextSpan = document.getElementById('typed-text');
        
        function typingEffect() {
            if (!typedTextSpan) return;
            let word = words[i].split("");
            var loopTyping = function() {
                if (word.length > 0) {
                    typedTextSpan.innerHTML += word.shift();
                } else {
                    setTimeout(deletingEffect, 2500);
                    return false;
                }
                timer = setTimeout(loopTyping, 80);
            };
            loopTyping();
        }

        function deletingEffect() {
            if (!typedTextSpan) return;
            let word = words[i].split("");
            var loopDeleting = function() {
                if (word.length > 0) {
                    word.pop();
                    typedTextSpan.innerHTML = word.join("");
                } else {
                    if (words.length > (i + 1)) {
                        i++;
                    } else {
                        i = 0;
                    }
                    setTimeout(typingEffect, 500);
                    return false;
                }
                timer = setTimeout(loopDeleting, 40);
            };
            loopDeleting();
        }

        typingEffect();
    });
</script>
@endsection
