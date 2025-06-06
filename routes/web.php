<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Routes
Route::post('/admin/login', [AdminController::class, 'admin_login'])->name('admin.login');
Route::get('/admin/verify', [AdminController::class, 'admin_verify'])->name('admin.verify');
Route::post('/admin/verification/verify', [AdminController::class, 'admin_verification_verify'])->name('admin.verification.verify');
Route::middleware(['auth'])->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'admin_logout'])->name('admin.logout');
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'admin_profile'])->name('admin.profile');
    Route::post('/admin/profile/update', [AdminController::class, 'admin_profile_update'])->name('admin.profile.update');
    Route::post('/admin/password/update', [AdminController::class, 'admin_password_update'])->name('admin.password.update');
    // ** Testimonials Routes **
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('/testimonials', 'all_testimonials')->name('all.testimonials');
        Route::get('/testimonials/create', 'add_testimonial')->name('add.testimonial');
        Route::post('/testimonials/create', 'create_testimonial')->name('create.testimonial');
        Route::get('/testimonials/edit/{id}', 'edit_testimonial')->name('edit.testimonial');
        Route::post('/testimonials/update/{id}', 'update_testimonial')->name('update.testimonial');
        Route::get('/testimonials/delete/{id}', 'delete_testimonial')->name('delete.testimonial');
    });
    // ** Hero Routes **
    Route::controller(HeroController::class)->group(function () {
        Route::get('/heroes', 'get_hero')->name('get.hero');
        Route::post('/heroes/update', 'update_hero')->name('update.hero');
        Route::post('/heroes/update/content', 'update_hero_content')->name('update.hero.content');
    });
});