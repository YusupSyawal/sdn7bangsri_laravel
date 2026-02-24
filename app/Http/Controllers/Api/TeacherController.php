<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of teachers
     */
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Filter by active status
        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        // Filter by subject
        if ($request->filled('subject')) {
            $query->where('subject', 'like', '%' . $request->subject . '%');
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('specialty', 'like', '%' . $request->search . '%');
            });
        }

        $teachers = $query->latest()->paginate($request->per_page ?? 10);

        // Transform photo URL
        $teachers->getCollection()->transform(function ($teacher) {
            if ($teacher->photo) {
                $teacher->photo_url = asset('storage/' . $teacher->photo);
            }
            return $teacher;
        });

        return response()->json([
            'success' => true,
            'data' => $teachers
        ]);
    }

    /**
     * Store a newly created teacher
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'subject' => 'nullable|max:255',
            'specialty' => 'nullable|max:255',
            'experience' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $teacher = Teacher::create($validated);
        $teacher->photo_url = $teacher->photo ? asset('storage/' . $teacher->photo) : null;

        return response()->json([
            'success' => true,
            'message' => 'Guru berhasil ditambahkan',
            'data' => $teacher
        ], 201);
    }

    /**
     * Display the specified teacher
     */
    public function show(Teacher $teacher)
    {
        $teacher->photo_url = $teacher->photo ? asset('storage/' . $teacher->photo) : null;

        return response()->json([
            'success' => true,
            'data' => $teacher
        ]);
    }

    /**
     * Update the specified teacher
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|max:255',
            'subject' => 'nullable|max:255',
            'specialty' => 'nullable|max:255',
            'experience' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('photo')) {
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        if ($request->has('is_active')) {
            $validated['is_active'] = $request->boolean('is_active');
        }

        $teacher->update($validated);
        $teacher->refresh();
        $teacher->photo_url = $teacher->photo ? asset('storage/' . $teacher->photo) : null;

        return response()->json([
            'success' => true,
            'message' => 'Guru berhasil diupdate',
            'data' => $teacher
        ]);
    }

    /**
     * Remove the specified teacher
     */
    public function destroy(Teacher $teacher)
    {
        if ($teacher->photo) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guru berhasil dihapus'
        ]);
    }
}
