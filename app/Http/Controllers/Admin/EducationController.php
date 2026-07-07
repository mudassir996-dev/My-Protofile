<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of education records.
     */
    public function index()
    {
        $education = Education::orderBy('start_year', 'desc')->get();
        return view('admin.education.index', compact('education'));
    }

    /**
     * Show the form for creating a new education record.
     */
    public function create()
    {
        return view('admin.education.create');
    }

    /**
     * Store a newly created education record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'institute' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_year' => 'required|string|max:4',
            'end_year' => 'required|string|max:255', // e.g. "2026" or "Present"
            'grade' => 'nullable|string|max:255',
        ]);

        Education::create($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record created successfully!');
    }

    /**
     * Show the form for editing the specified education record.
     */
    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    /**
     * Update the specified education record in storage.
     */
    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'institute' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'start_year' => 'required|string|max:4',
            'end_year' => 'required|string|max:255',
            'grade' => 'nullable|string|max:255',
        ]);

        $education->update($validated);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record updated successfully!');
    }

    /**
     * Remove the specified education record from storage.
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record deleted successfully!');
    }
}
