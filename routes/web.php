<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\TeacherController as FrontendTeacherController;
use App\Http\Controllers\Frontend\ActivityController as FrontendActivityController;
use App\Http\Controllers\Frontend\GalleryController as FrontendGalleryController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\PPDBController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\ArticleController;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\Admin\SchoolStatisticController;

// ===========================
// FRONTEND ROUTES (PUBLIC)
// ===========================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/teachers', [FrontendTeacherController::class, 'index'])->name('teachers');
Route::get('/activities', [FrontendActivityController::class, 'index'])->name('activities');
Route::get('/gallery', [FrontendGalleryController::class, 'index'])->name('gallery');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Berita Routes
Route::get('/berita', [PostController::class, 'index'])->name('posts.index');
Route::get('/berita/{slug}', [PostController::class, 'show'])->name('posts.show');

// Artikel Routes
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// PPDB Routes
Route::get('/ppdb', [PPDBController::class, 'index'])->name('ppdb');
Route::post('/ppdb', [PPDBController::class, 'store'])->name('ppdb.store');
Route::get('/ppdb/download', [PPDBController::class, 'downloadFormulir'])->name('ppdb.download');

// ===========================
// AUTH ROUTES
// ===========================
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset
Route::get('/forgot-password', [PasswordResetController::class, 'showResetForm'])->name('password.forgot')->middleware('guest');
Route::post('/forgot-password', [PasswordResetController::class, 'resetPassword'])->name('password.update')->middleware('throttle:3,1');

// ===========================
// ADMIN AUTH ROUTES
// ===========================
Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// ===========================
// ADMIN ROUTES (PROTECTED)
// ===========================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // School Profile
    Route::get('/profile', [SchoolProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [SchoolProfileController::class, 'update'])->name('profile.update');
    
    // Sliders
    Route::resource('sliders', SliderController::class);
    
    // Activities
    Route::resource('activities', ActivityController::class);
    
    // Teachers
    Route::resource('teachers', TeacherController::class);
    
    // Galleries
    Route::resource('galleries', GalleryController::class);
    
    // School Statistics
    Route::get('/statistics', [SchoolStatisticController::class, 'edit'])->name('statistics.edit');
    Route::put('/statistics', [SchoolStatisticController::class, 'update'])->name('statistics.update');
});