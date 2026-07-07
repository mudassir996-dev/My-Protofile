@extends('layouts.admin')

@section('page_title', 'Manage Skills')

@section('content')
<div class="space-y-6">
    <!-- Actions bar -->
    <div class="flex justify-between items-center">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Skills List</h2>
        <a href="{{ route('admin.skills.create') }}" class="px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-colors flex items-center gap-1.5">
            <i class="fas fa-plus text-xs"></i>
            Add Skill
        </a>
    </div>

    <!-- Skills List Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if(count($skills) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-bold border-b border-slate-200">
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Proficiency</th>
                            <th class="px-6 py-4">Icon (Lucide/FA)</th>
                            <th class="px-6 py-4 w-40 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($skills as $skill)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-4 font-bold text-slate-800">
                                    {{ $skill->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700">
                                        {{ $skill->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 w-64">
                                    <div class="flex items-center gap-3">
                                        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
                                            <div class="bg-indigo-600 h-full rounded-full" style="width: {{ $skill->proficiency }}%"></div>
                                        </div>
                                        <span class="font-bold text-slate-700 w-10 text-right">{{ $skill->proficiency }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-400 font-mono text-xs">
                                    {{ $skill->icon ?: 'N/A' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.skills.edit', $skill) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-indigo-600 hover:border-indigo-200 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this skill?')" class="inline">
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
                <i class="fas fa-laptop-code text-5xl text-slate-200 mb-2"></i>
                <p class="mb-4">No skills have been added yet.</p>
                <a href="{{ route('admin.skills.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold inline-block hover:bg-indigo-700">Add First Skill</a>
            </div>
        @endif
    </div>
</div>
@endsection
