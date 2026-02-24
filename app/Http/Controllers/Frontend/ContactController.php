<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SchoolProfile;

class ContactController extends Controller
{
    public function index()
    {
        $profile = SchoolProfile::first();
        return view('frontend.contact', compact('profile'));
    }
}