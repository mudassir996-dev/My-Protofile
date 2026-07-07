@extends('layouts.admin')

@section('page_title', 'Add Education')

@section('content')
<div class="max-w-xl bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">New Education Record</h2>
        <a href="{{ route('admin.education.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-700 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Back to Education
        </a>
    </div>

    <form action="{{ route('admin.education.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Institute -->
        <div>
            <label for="institute" class="block text-sm font-bold text-slate-700 mb-1">Institute / School Name</label>
            <input 
                type="text" 
                id="institute" 
                name="institute" 
                value="{{ old('institute') }}" 
                required 
                placeholder="e.g. The Islamia University of Bahawalpur"
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <!-- Degree -->
        <div>
            <label for="degree" class="block text-sm font-bold text-slate-700 mb-1">Degree / Certification</label>
            <input 
                type="text" 
                id="degree" 
                name="degree" 
                value="{{ old('degree') }}" 
                required 
                placeholder="e.g. BSc (Hons) Physics"
                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Start Year -->
            <div>
                <label for="start_year" class="block text-sm font-bold text-slate-700 mb-1">Start Year</label>
                <input 
                    type="text" 
                    id="start_year" 
                    name="start_year" 
                    value="{{ old('start_year') }}" 
                    required 
                    placeholder="e.g. 2022"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- End Year -->
            <div>
                <label for="end_year" class="block text-sm font-bold text-slate-700 mb-1">End Year</label>
                <input 
                    type="text" 
                    id="end_year" 
                    name="end_year" 
                    value="{{ old('end_year') }}" 
                    required 
                    placeholder="e.g. 2026, Present"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>

            <!-- Grade -->
            <div class="md:col-span-2">
                <label for="grade" class="block text-sm font-bold text-slate-700 mb-1">Grade / CGPA (optional)</label>
                <input 
                    type="text" 
                    id="grade" 
                    name="grade" 
                    value="{{ old('grade') }}" 
                    placeholder="e.g. CGPA 3.18/4.00, 74.54%"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>
        </div>

        <div class="pt-4 flex gap-4">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-all duration-200 active:scale-95"
            >
                Add Record
            </button>
            <a 
                href="{{ route('admin.education.index') }}" 
                class="px-6 py-3 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm text-center transition-all duration-200"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
