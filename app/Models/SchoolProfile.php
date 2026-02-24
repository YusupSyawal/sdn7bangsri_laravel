<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'school_name',
        'welcome_message',
        'vision',
        'mission',
        'values',
        'approach',
        'address',
        'phone',
        'email',
        'school_hours',
        'location_image',
        'google_maps_url'
    ];
}