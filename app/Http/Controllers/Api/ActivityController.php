<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities
     */
    public function index(Request $request)
    {
        $query = Activity::query();

        // Filter by active status
        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $activities = $query->latest()->paginate($request->per_page ?? 10);

        // Transform image URL
        $activities->getCollection()->transform(function ($activity) {
            if ($activity->image) {
                $activity->image_url = asset('storage/' . $activity->image);
            }
            return $activity;
        });

        return response()->json([
            'success' => true,
            'data' => $activities
        ]);
    }

    /**
     * Store a newly created activity
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'category' => 'nullable|max:255',
            'date' => 'nullable|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('activities', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);

        $activity = Activity::create($validated);
        $activity->image_url = $activity->image ? asset('storage/' . $activity->image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil ditambahkan',
            'data' => $activity
        ], 201);
    }

    /**
     * Display the specified activity
     */
    public function show(Activity $activity)
    {
        $activity->image_url = $activity->image ? asset('storage/' . $activity->image) : null;

        return response()->json([
            'success' => true,
            'data' => $activity
        ]);
    }

    /**
     * Update the specified activity
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|max:255',
            'description' => 'sometimes|required',
            'category' => 'nullable|max:255',
            'date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($activity->image) {
                Storage::disk('public')->delete($activity->image);
            }
            $validated['image'] = $request->file('image')->store('activities', 'public');
        }

        if ($request->has('is_active')) {
            $validated['is_active'] = $request->boolean('is_active');
        }

        $activity->update($validated);
        $activity->refresh();
        $activity->image_url = $activity->image ? asset('storage/' . $activity->image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil diupdate',
            'data' => $activity
        ]);
    }

    /**
     * Remove the specified activity
     */
    public function destroy(Activity $activity)
    {
        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }

        $activity->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kegiatan berhasil dihapus'
        ]);
    }
}
