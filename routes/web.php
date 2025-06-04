<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});