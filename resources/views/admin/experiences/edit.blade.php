@extends('layouts.admin')

@section('page_title', 'Edit Experience')

@section('content')
<div class="max-w-2xl bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Edit Experience Form</h2>
        <a href="{{ route('admin.experiences.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Back to Experience
        </a>
    </div>

    <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Company -->
            <div>
                <label for="company" class="block text-sm font-bold text-slate-700 mb-1">Company / Organization</label>
                <input 
                    type="text" 
                    id="company" 
                    name="company" 
                    value="{{ old('company', $experience->company) }}" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-sm font-bold text-slate-700 mb-1">Job Role / Position</label>
                <input 
                    type="text" 
                    id="role" 
                    name="role" 
                    value="{{ old('role', $experience->role) }}" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Start Date -->
            <div>
                <label for="start_date" class="block text-sm font-bold text-slate-700 mb-1">Start Date</label>
                <input 
                    type="text" 
                    id="start_date" 
                    name="start_date" 
                    value="{{ old('start_date', $experience->start_date) }}" 
                    required 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- End Date -->
            <div>
                <label for="end_date" class="block text-sm font-bold text-slate-700 mb-1">End Date</label>
                <input 
                    type="text" 
                    id="end_date" 
                    name="end_date" 
                    value="{{ old('end_date', $experience->end_date) }}" 
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
                <p class="text-xs text-slate-400 mt-1">Leave empty or type "Present" if this is your current job.</p>
            </div>
        </div>

        <!-- Description Bullets -->
        <div>
            <label for="description_bullets" class="block text-sm font-bold text-slate-700 mb-1">Job Description Bullets (One per line)</label>
            <textarea 
                id="description_bullets" 
                name="description_bullets" 
                rows="6" 
                required 
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            >{{ old('description_bullets', $descriptionBulletsString) }}</textarea>
            <p class="text-xs text-slate-400 mt-1">Press Enter to start a new bullet point line. Each line will be shown as a bullet point on the public timeline.</p>
        </div>

        <div class="pt-4 flex gap-4">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-all duration-200 active:scale-95"
            >
                Save Changes
            </button>
            <a 
                href="{{ route('admin.experiences.index') }}" 
                class="px-6 py-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm text-center transition-all duration-200"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
