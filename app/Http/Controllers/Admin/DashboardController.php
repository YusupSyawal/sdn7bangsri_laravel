<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Activity;
use App\Models\Teacher;
use App\Models\Gallery;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'sliders' => Slider::count(),
            'activities' => Activity::count(),
            'teachers' => Teacher::count(),
            'galleries' => Gallery::count(),
        ];

        return view('admin.layout.dashboard', compact('stats'));
    }
}