@extends('layouts.admin')

@section('page_title', 'Manage Experience')

@section('content')
<div class="space-y-6">
    <!-- Actions bar -->
    <div class="flex justify-between items-center">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Experiences List</h2>
        <a href="{{ route('admin.experiences.create') }}" class="px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-colors flex items-center gap-1.5">
            <i class="fas fa-plus text-xs"></i>
            Add Experience
        </a>
    </div>

    <!-- Experiences List Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if(count($experiences) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-bold border-b border-slate-200">
                            <th class="px-6 py-4">Company</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Duration</th>
                            <th class="px-6 py-4">Description Bullets</th>
                            <th class="px-6 py-4 w-40 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($experiences as $exp)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-4 font-bold text-slate-800">
                                    {{ $exp->company }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $exp->role }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-600">
                                    {{ $exp->start_date }} – {{ $exp->end_date }}
                                </td>
                                <td class="px-6 py-4 text-slate-500 text-xs max-w-sm truncate">
                                    @if(is_array($exp->description))
                                        {{ count($exp->description) }} bullets: {{ implode(', ', $exp->description) }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.experiences.edit', $exp) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-indigo-600 hover:border-indigo-200 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this experience record?')" class="inline">
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
                <i class="fas fa-briefcase text-5xl text-slate-200 mb-2"></i>
                <p class="mb-4">No experience items have been added yet.</p>
                <a href="{{ route('admin.experiences.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold inline-block hover:bg-indigo-700">Add First Experience</a>
            </div>
        @endif
    </div>
</div>
@endsection
