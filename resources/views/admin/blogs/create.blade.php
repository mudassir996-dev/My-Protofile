@extends('layouts.admin')

@section('page_title', 'Create Blog Post')

@section('content')
<!-- Trix Editor Assets -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
<style>
    trix-editor {
        min-height: 350px !important;
        border-color: #cbd5e1 !important;
        border-radius: 0.5rem !important;
        background-color: #fff;
    }
    trix-toolbar .trix-button-row {
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        border-bottom: 0;
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 4px;
    }
    trix-editor {
        border-top-left-radius: 0 !important;
        border-top-right-radius: 0 !important;
    }
</style>

<div class="max-w-4xl bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">New Article Form</h2>
        <a href="{{ route('admin.blogs.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Back to Articles
        </a>
    </div>

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-bold text-slate-700 mb-1">Post Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title') }}" 
                required 
                placeholder="e.g. Getting Started with Laravel MVC"
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <!-- Rich Text Editor (Trix) -->
        <div>
            <label class="block text-sm font-bold text-slate-700 mb-1">Article Content</label>
            <input id="content" type="hidden" name="content" value="{{ old('content') }}">
            <trix-editor input="content" placeholder="Write your blog post content here..."></trix-editor>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center pt-4">
            <!-- Featured Image -->
            <div>
                <label for="featured_image" class="block text-sm font-bold text-slate-700 mb-1">Featured Image</label>
                <input 
                    type="file" 
                    id="featured_image" 
                    name="featured_image" 
                    accept="image/*" 
                    class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
                />
                <p class="text-xs text-slate-400 mt-1">PNG, JPG, or WEBP up to 2MB.</p>
            </div>

            <!-- Published Status -->
            <div class="flex items-center h-full pt-4">
                <label for="is_published" class="inline-flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        id="is_published" 
                        name="is_published" 
                        value="1" 
                        {{ old('is_published') ? 'checked' : '' }} 
                        class="sr-only peer"
                    >
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                    <span class="ms-3 text-sm font-bold text-slate-700">Publish immediately</span>
                </label>
            </div>
        </div>

        <div class="pt-6 flex gap-4">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-all duration-200 active:scale-95"
            >
                Save Post
            </button>
            <a 
                href="{{ route('admin.blogs.index') }}" 
                class="px-6 py-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm text-center transition-all duration-200"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
