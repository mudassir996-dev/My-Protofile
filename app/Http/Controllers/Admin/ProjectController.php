<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index()
    {
        $projects = Project::orderBy('order', 'asc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack_input' => 'required|string', // Comma separated tags
            'image' => 'nullable|image|max:2048',
            'live_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'order' => 'required|integer',
        ]);

        $techStack = array_map('trim', explode(',', $validated['tech_stack_input']));
        
        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'tech_stack' => $techStack,
            'live_url' => $validated['live_url'],
            'github_url' => $validated['github_url'],
            'order' => $validated['order'],
            'slug' => Str::slug($validated['title']),
        ];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $data['image'] = $path;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project)
    {
        // Join tags back to a comma-separated string for editing
        $techStackString = is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : '';
        return view('admin.projects.edit', compact('project', 'techStackString'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tech_stack_input' => 'required|string', // Comma separated tags
            'image' => 'nullable|image|max:2048',
            'live_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'order' => 'required|integer',
        ]);

        $techStack = array_map('trim', explode(',', $validated['tech_stack_input']));

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'tech_stack' => $techStack,
            'live_url' => $validated['live_url'],
            'github_url' => $validated['github_url'],
            'order' => $validated['order'],
            'slug' => Str::slug($validated['title']),
        ];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $path = $request->file('image')->store('projects', 'public');
            $data['image'] = $path;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}
