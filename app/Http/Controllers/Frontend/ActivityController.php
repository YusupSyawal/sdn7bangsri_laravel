<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::active()->get();
        return view('frontend.activities', compact('activities'));
    }
}