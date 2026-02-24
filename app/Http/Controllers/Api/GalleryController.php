<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

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

        $galleries = $query->latest()->paginate($request->per_page ?? 12);

        // Transform image URL
        $galleries->getCollection()->transform(function ($gallery) {
            if ($gallery->image) {
                $gallery->image_url = asset('storage/' . $gallery->image);
            }
            return $gallery;
        });

        return response()->json([
            'success' => true,
            'data' => $galleries
        ]);
    }

    /**
     * Store a newly created gallery
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'category' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery = Gallery::create($validated);
        $gallery->image_url = $gallery->image ? asset('storage/' . $gallery->image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil ditambahkan',
            'data' => $gallery
        ], 201);
    }

    /**
     * Display the specified gallery
     */
    public function show(Gallery $gallery)
    {
        $gallery->image_url = $gallery->image ? asset('storage/' . $gallery->image) : null;

        return response()->json([
            'success' => true,
            'data' => $gallery
        ]);
    }

    /**
     * Update the specified gallery
     */
    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|max:255',
            'description' => 'nullable',
            'category' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            $validated['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($validated);
        $gallery->refresh();
        $gallery->image_url = $gallery->image ? asset('storage/' . $gallery->image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil diupdate',
            'data' => $gallery
        ]);
    }

    /**
     * Remove the specified gallery
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Galeri berhasil dihapus'
        ]);
    }
}
