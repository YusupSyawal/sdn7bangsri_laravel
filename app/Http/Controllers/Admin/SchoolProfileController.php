<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function edit()
    {
        $profile = SchoolProfile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|max:255',
            'welcome_message' => 'nullable',
            'vision' => 'nullable',
            'mission' => 'nullable',
            'values' => 'nullable',
            'approach' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable|max:20',
            'email' => 'nullable|email',
            'school_hours' => 'nullable',
            'location_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'google_maps_url' => 'nullable|url'
        ]);

        $profile = SchoolProfile::first();

        if ($request->hasFile('location_image')) {
            // Delete old image
            if ($profile->location_image) {
                Storage::disk('public')->delete($profile->location_image);
            }
            $validated['location_image'] = $request->file('location_image')->store('school', 'public');
        }

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil sekolah berhasil diupdate');
    }
}