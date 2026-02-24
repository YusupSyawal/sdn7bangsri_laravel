<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\SchoolProfile;
use App\Models\Activity;
use App\Models\Teacher;
use App\Models\SchoolStatistic;
use App\Models\Post;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->get();
        $profile = SchoolProfile::first();
        $activities = Activity::active()->take(4)->get();
        $teachers = Teacher::active()->take(4)->get();
        $statistic = SchoolStatistic::getData();

        // Portal Berita
        $headlinePost = Post::active()->published()->latest()->first();
        $latestPosts = Post::active()->published()->latest()
            ->when($headlinePost, fn($q) => $q->where('id', '!=', $headlinePost->id))
            ->take(5)->get();
        $latestArticles = Article::active()->latest()->take(4)->get();

        return view('frontend.home', compact(
            'sliders', 
            'profile', 
            'activities', 
            'teachers', 
            'statistic',
            'headlinePost',
            'latestPosts',
            'latestArticles'
        ));
    }
}