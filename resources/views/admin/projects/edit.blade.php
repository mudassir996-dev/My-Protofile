@extends('layouts.admin')

@section('page_title', 'Edit Project')

@section('content')
<div class="max-w-3xl bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Edit Project Form</h2>
        <a href="{{ route('admin.projects.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Back to Projects
        </a>
    </div>

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-bold text-slate-700 mb-1">Project Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title', $project->title) }}" 
                required 
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-bold text-slate-700 mb-1">Description</label>
            <textarea 
                id="description" 
                name="description" 
                rows="5" 
                required 
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            >{{ old('description', $project->description) }}</textarea>
        </div>

        <!-- Tech Stack Tags -->
        <div>
            <label for="tech_stack_input" class="block text-sm font-bold text-slate-700 mb-1">Tech Stack (comma-separated)</label>
            <input 
                type="text" 
                id="tech_stack_input" 
                name="tech_stack_input" 
                value="{{ old('tech_stack_input', $techStackString) }}" 
                required 
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
            <p class="text-xs text-slate-400 mt-1">Separate each technology with a comma (e.g. Laravel, Vue.js, CSS3).</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Live URL -->
            <div>
                <label for="live_url" class="block text-sm font-bold text-slate-700 mb-1">Live URL (optional)</label>
                <input 
                    type="url" 
                    id="live_url" 
                    name="live_url" 
                    value="{{ old('live_url', $project->live_url) }}" 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- GitHub URL -->
            <div>
                <label for="github_url" class="block text-sm font-bold text-slate-700 mb-1">GitHub Repo URL (optional)</label>
                <input 
                    type="url" 
                    id="github_url" 
                    name="github_url" 
                    value="{{ old('github_url', $project->github_url) }}" 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Order / Priority -->
            <div>
                <label for="order" class="block text-sm font-bold text-slate-700 mb-1">Order Priority</label>
                <input 
                    type="number" 
                    id="order" 
                    name="order" 
                    value="{{ old('order', $project->order) }}" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
                <p class="text-xs text-slate-400 mt-1">Lower numbers are shown first on the home page.</p>
            </div>

            <!-- Image Upload & Preview -->
            <div>
                <label for="image" class="block text-sm font-bold text-slate-700 mb-1">Project Screenshot</label>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-12 rounded bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center flex-shrink-0">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="Preview" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-image text-slate-300"></i>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <input 
                            type="file" 
                            id="image" 
                            name="image" 
                            accept="image/*" 
                            class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
                        />
                        <p class="text-xs text-slate-400 mt-1">Leave empty to keep current image. PNG, JPG, or WEBP up to 2MB.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4 flex gap-4">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-all duration-200 active:scale-95"
            >
                Save Changes
            </button>
            <a 
                href="{{ route('admin.projects.index') }}" 
                class="px-6 py-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm text-center transition-all duration-200"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
