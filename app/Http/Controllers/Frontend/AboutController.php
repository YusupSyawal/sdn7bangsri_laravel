<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;

class AboutController extends Controller
{
    public function index()
    {
        $profile = SchoolProfile::first();
        return view('frontend.about', compact('profile'));
    }
}