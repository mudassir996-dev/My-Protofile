@extends('layouts.admin')

@section('page_title', 'Add Testimonial')

@section('content')
<div class="max-w-2xl bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">New Testimonial Form</h2>
        <a href="{{ route('admin.testimonials.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Back to Testimonials
        </a>
    </div>

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    required 
                    placeholder="e.g. Sarah Connor"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Position -->
            <div>
                <label for="position" class="block text-sm font-bold text-slate-700 mb-1">Position</label>
                <input 
                    type="text" 
                    id="position" 
                    name="position" 
                    value="{{ old('position') }}" 
                    required 
                    placeholder="e.g. Project Lead"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Company -->
            <div>
                <label for="company" class="block text-sm font-bold text-slate-700 mb-1">Company</label>
                <input 
                    type="text" 
                    id="company" 
                    name="company" 
                    value="{{ old('company') }}" 
                    required 
                    placeholder="e.g. Indolike Company"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>
        </div>

        <!-- Message -->
        <div>
            <label for="message" class="block text-sm font-bold text-slate-700 mb-1">Recommendation Message</label>
            <textarea 
                id="message" 
                name="message" 
                rows="5" 
                required 
                placeholder="Mudassir is an exceptional developer..."
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            >{{ old('message') }}</textarea>
        </div>

        <!-- Client Photo -->
        <div>
            <label for="photo" class="block text-sm font-bold text-slate-700 mb-1">Client Photo (optional)</label>
            <input 
                type="file" 
                id="photo" 
                name="photo" 
                accept="image/*" 
                class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer"
            />
            <p class="text-xs text-slate-400 mt-1">PNG, JPG, or WEBP up to 2MB.</p>
        </div>

        <div class="pt-4 flex gap-4">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-all duration-200 active:scale-95"
            >
                Add Testimonial
            </button>
            <a 
                href="{{ route('admin.testimonials.index') }}" 
                class="px-6 py-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm text-center transition-all duration-200"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
