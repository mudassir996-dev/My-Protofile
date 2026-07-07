<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of experiences.
     */
    public function index()
    {
        $experiences = Experience::all()->sortBy(function ($exp) {
            return $exp->end_date === 'Present' ? 0 : 1;
        });
        return view('admin.experiences.index', compact('experiences'));
    }

    /**
     * Show the form for creating a new experience.
     */
    public function create()
    {
        return view('admin.experiences.create');
    }

    /**
     * Store a newly created experience in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255', // If null, we'll treat as 'Present'
            'description_bullets' => 'required|string', // Textarea where each line is a bullet
        ]);

        $descriptionBullets = array_values(array_filter(array_map('trim', explode("\n", $validated['description_bullets']))));

        Experience::create([
            'company' => $validated['company'],
            'role' => $validated['role'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?: 'Present',
            'description' => $descriptionBullets,
        ]);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience created successfully!');
    }

    /**
     * Show the form for editing the specified experience.
     */
    public function edit(Experience $experience)
    {
        $descriptionBulletsString = is_array($experience->description) ? implode("\n", $experience->description) : '';
        return view('admin.experiences.edit', compact('experience', 'descriptionBulletsString'));
    }

    /**
     * Update the specified experience in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255',
            'description_bullets' => 'required|string',
        ]);

        $descriptionBullets = array_values(array_filter(array_map('trim', explode("\n", $validated['description_bullets']))));

        $experience->update([
            'company' => $validated['company'],
            'role' => $validated['role'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?: 'Present',
            'description' => $descriptionBullets,
        ]);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully!');
    }

    /**
     * Remove the specified experience from storage.
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully!');
    }
}
