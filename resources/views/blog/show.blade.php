@extends('layouts.app')

@section('title', $post->title . ' - Blog')
@section('meta_description', Str::limit(strip_tags($post->content), 150))

@section('content')
<article class="py-16 md:py-24 bg-slate-50 dark:bg-slate-900 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        
        <!-- Back Button -->
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 mb-8 transition-colors">
            <i class="fas fa-arrow-left text-xs"></i>
            Back to Articles
        </a>

        <!-- Article Container -->
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-slate-100 dark:border-slate-700/50 overflow-hidden">
            
            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="aspect-video w-full relative overflow-hidden">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                </div>
            @endif

            <!-- Body -->
            <div class="p-6 md:p-12 space-y-6">
                <!-- Meta -->
                <div class="flex items-center gap-4 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-widest">
                    <span>Published</span>
                    <span>•</span>
                    <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight">
                    {{ $post->title }}
                </h1>

                <!-- Content -->
                <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed space-y-6 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                    {!! $post->content !!}
                </div>
            </div>
            
        </div>

        <!-- Share/Footer section -->
        <div class="mt-8 flex justify-between items-center bg-white dark:bg-slate-800 p-6 rounded-2xl border border-slate-100 dark:border-slate-700/50 shadow-md">
            <span class="text-sm font-bold text-slate-800 dark:text-white">Written by Mudassir Yaseen</span>
            <div class="flex gap-3">
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-750 flex items-center justify-center text-slate-500 hover:text-indigo-500 transition-colors">
                    <i class="fab fa-twitter text-sm"></i>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-750 flex items-center justify-center text-slate-500 hover:text-indigo-500 transition-colors">
                    <i class="fab fa-linkedin-in text-sm"></i>
                </a>
            </div>
        </div>

    </div>
</article>
@endsection
