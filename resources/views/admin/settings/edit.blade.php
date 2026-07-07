@extends('layouts.admin')

@section('page_title', 'Site Settings')

@section('content')
<div class="max-w-4xl bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $setting->name) }}" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-slate-700 mb-1">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $setting->email) }}" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Tagline -->
            <div class="md:col-span-2">
                <label for="tagline" class="block text-sm font-bold text-slate-700 mb-1">Tagline</label>
                <input 
                    type="text" 
                    id="tagline" 
                    name="tagline" 
                    value="{{ old('tagline', $setting->tagline) }}" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Summary -->
            <div class="md:col-span-2">
                <label for="summary" class="block text-sm font-bold text-slate-700 mb-1">Professional Summary</label>
                <textarea 
                    id="summary" 
                    name="summary" 
                    rows="5" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                >{{ old('summary', $setting->summary) }}</textarea>
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-bold text-slate-700 mb-1">Phone Number</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone', $setting->phone) }}" 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- GitHub URL -->
            <div>
                <label for="github_url" class="block text-sm font-bold text-slate-700 mb-1">GitHub Username/URL</label>
                <input 
                    type="text" 
                    id="github_url" 
                    name="github_url" 
                    value="{{ old('github_url', $setting->github_url) }}" 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- LinkedIn URL -->
            <div>
                <label for="linkedin_url" class="block text-sm font-bold text-slate-700 mb-1">LinkedIn Username/URL</label>
                <input 
                    type="text" 
                    id="linkedin_url" 
                    name="linkedin_url" 
                    value="{{ old('linkedin_url', $setting->linkedin_url) }}" 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>
        </div>

        <hr class="border-slate-200">

        <!-- File uploads group -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Profile Photo Upload -->
            <div class="space-y-3">
                <label class="block text-sm font-bold text-slate-700">Profile Photo</label>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-slate-100 border border-slate-200 flex-shrink-0 flex items-center justify-center">
                        @if($setting->profile_photo)
                            <img src="{{ asset('storage/' . $setting->profile_photo) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <i class="fas fa-user text-2xl text-slate-300"></i>
                        @endif
                    </div>
                    <div class="flex-grow">
                        <input 
                            type="file" 
                            name="profile_photo" 
                            accept="image/*" 
                            class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
                        />
                        <p class="text-xs text-slate-400 mt-1">PNG, JPG, or WEBP up to 2MB.</p>
                    </div>
                </div>
            </div>

            <!-- CV Upload -->
            <div class="space-y-3">
                <label class="block text-sm font-bold text-slate-700">Resume / CV File</label>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 border border-indigo-100 flex-shrink-0 flex items-center justify-center text-xl">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="flex-grow">
                        <input 
                            type="file" 
                            name="cv" 
                            accept=".pdf" 
                            class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
                        />
                        @if($setting->cv_path)
                            <div class="mt-1">
                                <a href="{{ route('cv.download') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                                    <i class="fas fa-download text-[10px]"></i> Current CV File
                                </a>
                            </div>
                        @else
                            <p class="text-xs text-slate-400 mt-1">Upload a PDF file (Max 10MB).</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-4">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-all duration-200 active:scale-95"
            >
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
