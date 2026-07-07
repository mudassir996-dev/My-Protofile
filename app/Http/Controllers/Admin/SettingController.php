<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show the form for editing the settings.
     */
    public function edit()
    {
        $setting = Setting::getSettings();
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update the settings in storage.
     */
    public function update(Request $request)
    {
        $setting = Setting::getSettings();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'summary' => 'required|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'github_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'cv' => 'nullable|file|mimes:pdf|max:10240', // 10MB max CV pdf
            'profile_photo' => 'nullable|image|max:2048', // 2MB max image
        ]);

        $data = [
            'name' => $validated['name'],
            'tagline' => $validated['tagline'],
            'summary' => $validated['summary'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'github_url' => $validated['github_url'],
            'linkedin_url' => $validated['linkedin_url'],
        ];

        // Handle CV upload
        if ($request->hasFile('cv')) {
            if ($setting->cv_path) {
                Storage::disk('public')->delete($setting->cv_path);
            }
            $path = $request->file('cv')->store('cv', 'public');
            $data['cv_path'] = $path;
        }

        // Handle Profile Photo upload
        if ($request->hasFile('profile_photo')) {
            if ($setting->profile_photo) {
                Storage::disk('public')->delete($setting->profile_photo);
            }
            $path = $request->file('profile_photo')->store('profile', 'public');
            $data['profile_photo'] = $path;
        }

        $setting->update($data);

        return redirect()->route('admin.settings.edit')
            ->with('success', 'Settings updated successfully!');
    }
}
