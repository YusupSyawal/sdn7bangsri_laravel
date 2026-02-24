<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SchoolProfile;

class PostController extends Controller
{
    /**
     * Display a listing of posts
     */
    public function index()
    {
        $profile = SchoolProfile::first();
        $posts = Post::active()
            ->published()
            ->latest()
            ->paginate(9);

        return view('frontend.posts.index', compact('profile', 'posts'));
    }

    /**
     * Display the specified post
     */
    public function show($slug)
    {
        $profile = SchoolProfile::first();
        $post = Post::active()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedPosts = Post::active()
            ->published()
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.posts.show', compact('profile', 'post', 'relatedPosts'));
    }
}
