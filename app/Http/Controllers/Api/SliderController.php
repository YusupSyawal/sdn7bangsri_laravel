<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of sliders
     */
    public function index(Request $request)
    {
        $query = Slider::query();

        // Filter by active status
        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        // Order
        $query->orderBy('order');

        $sliders = $query->paginate($request->per_page ?? 10);

        // Transform image URL
        $sliders->getCollection()->transform(function ($slider) {
            if ($slider->image) {
                $slider->image_url = asset('storage/' . $slider->image);
            }
            return $slider;
        });

        return response()->json([
            'success' => true,
            'data' => $sliders
        ]);
    }

    /**
     * Store a newly created slider
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $request->order ?? (Slider::max('order') + 1);

        $slider = Slider::create($validated);
        $slider->image_url = $slider->image ? asset('storage/' . $slider->image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Slider berhasil ditambahkan',
            'data' => $slider
        ], 201);
    }

    /**
     * Display the specified slider
     */
    public function show(Slider $slider)
    {
        $slider->image_url = $slider->image ? asset('storage/' . $slider->image) : null;

        return response()->json([
            'success' => true,
            'data' => $slider
        ]);
    }

    /**
     * Update the specified slider
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|max:255',
            'subtitle' => 'nullable|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        if ($request->has('is_active')) {
            $validated['is_active'] = $request->boolean('is_active');
        }

        $slider->update($validated);
        $slider->refresh();
        $slider->image_url = $slider->image ? asset('storage/' . $slider->image) : null;

        return response()->json([
            'success' => true,
            'message' => 'Slider berhasil diupdate',
            'data' => $slider
        ]);
    }

    /**
     * Remove the specified slider
     */
    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return response()->json([
            'success' => true,
            'message' => 'Slider berhasil dihapus'
        ]);
    }
}
