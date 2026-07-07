@extends('layouts.app')

@section('title', 'Blog - ' . ($settings->name ?? 'Mudassir Yaseen'))

@section('content')
<section class="py-16 md:py-24 bg-slate-50 dark:bg-slate-900 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
            <h1 class="text-base font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">My Blog</h1>
            <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white">Articles & Insights</p>
            <div class="w-16 h-1 bg-indigo-600 dark:bg-indigo-400 mx-auto rounded-full mt-2"></div>
        </div>

        @if(count($posts) > 0)
            <!-- Blog Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
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
                            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-2 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                {{ $post->title }}
                            </h2>
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

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700/50 p-8 shadow-sm">
                <i class="fas fa-newspaper text-6xl text-slate-300 dark:text-slate-600 mb-4"></i>
                <h3 class="text-xl font-bold text-slate-800 dark:text-white mb-2">No Blog Posts Yet</h3>
                <p class="text-slate-500 dark:text-slate-400 max-w-sm mx-auto mb-6">Check back later! I will be publishing my technical articles and insights here soon.</p>
                <a href="{{ route('home') }}" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl inline-block">Return Home</a>
            </div>
        @endif

    </div>
</section>
@endsection
