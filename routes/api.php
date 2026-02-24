<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SchoolProfileController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public Routes (tanpa authentication)
Route::prefix('v1')->group(function () {
    
    // Auth
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    
    // Public data (read-only)
    Route::get('/activities', [ActivityController::class, 'index']);
    Route::get('/activities/{activity}', [ActivityController::class, 'show']);
    
    Route::get('/galleries', [GalleryController::class, 'index']);
    Route::get('/galleries/{gallery}', [GalleryController::class, 'show']);
    
    Route::get('/teachers', [TeacherController::class, 'index']);
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show']);
    
    Route::get('/sliders', [SliderController::class, 'index']);
    Route::get('/sliders/{slider}', [SliderController::class, 'show']);
    
    Route::get('/school-profile', [SchoolProfileController::class, 'show']);
    
    // Protected Routes (dengan authentication)
    Route::middleware('auth:sanctum')->group(function () {
        
        // Auth
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
        
        // Activities CRUD
        Route::post('/activities', [ActivityController::class, 'store']);
        Route::put('/activities/{activity}', [ActivityController::class, 'update']);
        Route::post('/activities/{activity}', [ActivityController::class, 'update']); // untuk form-data dengan _method=PUT
        Route::delete('/activities/{activity}', [ActivityController::class, 'destroy']);
        
        // Galleries CRUD
        Route::post('/galleries', [GalleryController::class, 'store']);
        Route::put('/galleries/{gallery}', [GalleryController::class, 'update']);
        Route::post('/galleries/{gallery}', [GalleryController::class, 'update']);
        Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy']);
        
        // Teachers CRUD
        Route::post('/teachers', [TeacherController::class, 'store']);
        Route::put('/teachers/{teacher}', [TeacherController::class, 'update']);
        Route::post('/teachers/{teacher}', [TeacherController::class, 'update']);
        Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy']);
        
        // Sliders CRUD
        Route::post('/sliders', [SliderController::class, 'store']);
        Route::put('/sliders/{slider}', [SliderController::class, 'update']);
        Route::post('/sliders/{slider}', [SliderController::class, 'update']);
        Route::delete('/sliders/{slider}', [SliderController::class, 'destroy']);
        
        // School Profile
        Route::put('/school-profile', [SchoolProfileController::class, 'update']);
    });
});
