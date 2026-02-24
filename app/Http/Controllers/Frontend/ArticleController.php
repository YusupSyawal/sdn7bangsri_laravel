<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\SchoolProfile;

class ArticleController extends Controller
{
    /**
     * Display a listing of articles
     */
    public function index()
    {
        $profile = SchoolProfile::first();
        $articles = Article::active()
            ->latest()
            ->paginate(9);

        return view('frontend.articles.index', compact('profile', 'articles'));
    }

    /**
     * Display the specified article
     */
    public function show($slug)
    {
        $profile = SchoolProfile::first();
        $article = Article::active()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedArticles = Article::active()
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.articles.show', compact('profile', 'article', 'relatedArticles'));
    }
}
