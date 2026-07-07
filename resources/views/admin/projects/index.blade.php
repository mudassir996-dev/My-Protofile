@extends('layouts.admin')

@section('page_title', 'Manage Projects')

@section('content')
<div class="space-y-6">
    <!-- Actions bar -->
    <div class="flex justify-between items-center">
        <h2 class="text-sm font-bold text-slate-500 uppercase tracking-widest">Projects List</h2>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2.5 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-sm transition-colors flex items-center gap-1.5">
            <i class="fas fa-plus text-xs"></i>
            Add Project
        </a>
    </div>

    <!-- Projects List Table -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if(count($projects) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase tracking-wider text-xs font-bold border-b border-slate-200">
                            <th class="px-6 py-4 w-20">Thumbnail</th>
                            <th class="px-6 py-4">Title</th>
                            <th class="px-6 py-4">Tech Stack</th>
                            <th class="px-6 py-4 w-20 text-center">Priority</th>
                            <th class="px-6 py-4 w-40 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($projects as $project)
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-6 py-4">
                                    <div class="w-12 h-12 rounded-lg bg-slate-100 border border-slate-200 overflow-hidden flex items-center justify-center text-indigo-500 text-xs">
                                        @if($project->image)
                                            <img src="{{ asset('storage/' . $project->image) }}" alt="Project" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-code text-base"></i>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $project->title }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">slug: {{ $project->slug }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @if(is_array($project->tech_stack))
                                            @foreach($project->tech_stack as $tech)
                                                <span class="px-2 py-0.5 rounded text-[10px] bg-slate-100 text-slate-600 font-semibold">{{ $tech }}</span>
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-slate-700">
                                    {{ $project->order }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="p-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:text-indigo-600 hover:border-indigo-200 transition-colors" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')" class="inline">
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
                <i class="fas fa-folder-open text-5xl text-slate-200 mb-2"></i>
                <p class="mb-4">No projects have been added yet.</p>
                <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-xs font-bold inline-block hover:bg-indigo-700">Add First Project</a>
            </div>
        @endif
    </div>
</div>
@endsection
