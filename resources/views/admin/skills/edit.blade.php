@extends('layouts.admin')

@section('page_title', 'Edit Skill')

@section('content')
<div class="max-w-xl bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Edit Skill Form</h2>
        <a href="{{ route('admin.skills.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Back to Skills
        </a>
    </div>

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Skill Name -->
        <div>
            <label for="name" class="block text-sm font-bold text-slate-700 mb-1">Skill Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                value="{{ old('name', $skill->name) }}" 
                required 
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <!-- Category -->
        <div>
            <label for="category" class="block text-sm font-bold text-slate-700 mb-1">Category</label>
            <select 
                id="category" 
                name="category" 
                required 
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            >
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ old('category', $skill->category) == $category ? 'selected' : '' }}>{{ $category }}</option>
                @endforeach
            </select>
        </div>

        <!-- Proficiency -->
        <div>
            <label for="proficiency" class="block text-sm font-bold text-slate-700 mb-1">Proficiency Level (0-100%)</label>
            <div class="flex items-center gap-4">
                <input 
                    type="range" 
                    id="proficiency" 
                    name="proficiency" 
                    min="0" 
                    max="100" 
                    value="{{ old('proficiency', $skill->proficiency) }}" 
                    class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600"
                    oninput="this.nextElementSibling.innerText = this.value + '%'"
                />
                <span class="text-sm font-bold text-slate-700 w-12 text-right">{{ old('proficiency', $skill->proficiency) }}%</span>
            </div>
        </div>

        <!-- Icon Identifier -->
        <div>
            <label for="icon" class="block text-sm font-bold text-slate-700 mb-1">Icon CSS Class / Name (optional)</label>
            <input 
                type="text" 
                id="icon" 
                name="icon" 
                value="{{ old('icon', $skill->icon) }}" 
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <div class="pt-4 flex gap-4">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-all duration-200 active:scale-95"
            >
                Save Changes
            </button>
            <a 
                href="{{ route('admin.skills.index') }}" 
                class="px-6 py-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm text-center transition-all duration-200"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
