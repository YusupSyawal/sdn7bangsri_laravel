<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;

class SchoolProfileController extends Controller
{
    /**
     * Display the school profile
     */
    public function show()
    {
        $profile = SchoolProfile::first();

        if (!$profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profil sekolah belum diatur'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }

    /**
     * Update the school profile
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'sometimes|required|max:255',
            'welcome_message' => 'nullable',
            'vision' => 'nullable',
            'mission' => 'nullable',
            'values' => 'nullable',
            'approach' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable|max:50',
            'email' => 'nullable|email|max:255',
            'school_hours' => 'nullable',
        ]);

        $profile = SchoolProfile::first();

        if (!$profile) {
            $profile = SchoolProfile::create($validated);
        } else {
            $profile->update($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'Profil sekolah berhasil diupdate',
            'data' => $profile
        ]);
    }
}
