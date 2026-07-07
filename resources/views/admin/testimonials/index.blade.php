@extends('layouts.admin')

@section('page_title', 'Manage Testimonials')

@section('content')
<div class="space-y-6">
    <!-- Actions bar -->
    <div class="flex justify-between items-center">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Testimonials List</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-colors flex items-center gap-1.5">
            <i class="fas fa-plus text-xs"></i>
            Add Testimonial
        </a>
    </div>

    <!-- Testimonials List Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if(count($testimonials) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-bold border-b border-slate-200">
                            <th class="px-6 py-4 w-20">Photo</th>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Position & Company</th>
                            <th class="px-6 py-4">Message Snippet</th>
                            <th class="px-6 py-4 w-40 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($testimonials as $testimonial)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center font-bold text-slate-500 text-sm">
                                        @if($testimonial->photo)
                                            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Client" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($testimonial->name, 0, 1) }}
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-800">
                                    {{ $testimonial->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $testimonial->position }} at {{ $testimonial->company }}
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs max-w-xs truncate">
                                    "{{ $testimonial->message }}"
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-indigo-600 hover:border-indigo-200 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg border border-slate-200 bg-white text-slate-400 hover:text-red-600 hover:border-red-200 transition-colors" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16 text-slate-400 font-medium">
                <i class="fas fa-comment-dots text-5xl text-slate-200 mb-2"></i>
                <p class="mb-4">No testimonials have been added yet.</p>
                <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold inline-block hover:bg-indigo-700">Add First Testimonial</a>
            </div>
        @endif
    </div>
</div>
@endsection
