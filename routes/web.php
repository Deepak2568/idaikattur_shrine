<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Route::get('/schedule', function () {
    return view('shrine.schedule');
});

Route::view('/priest', 'shrine.priest');
Route::view('/contact', 'shrine.contact');
Route::view('/videos', 'shrine.mass_videos');
Route::view('/about', 'shrine.about');
Route::view('/gallery', 'shrine.gallery');
Route::view('/comments', 'shrine.comments');
Route::view('/terms', 'shrine.terms')->name('terms');
Route::view('/privacy', 'shrine.privacy')->name('privacy');


Route::get('/matrimony', function (Request $request) {
    if (Auth::guard('customer')->check()) {
        return redirect()->route('dashboard');
    }
    return view('shrine.matrimony');
})->name('matrimony');

// crud
Route::post('/contact',[ContactController::class,'store'])->name('contact');

// Register
Route::post('/register',[RegisterController::class,'register'])->name('register');

Route::post('/login-check', [LoginController::class, 'login'])->name('login.check');
Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard')->middleware('auth:customer');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Profile routes
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth:customer');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth:customer');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth:customer');
Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete')->middleware('auth:customer');

// AJAX routes
Route::get('/profile/{id}', [LoginController::class, 'viewProfile'])->name('profile.view')->middleware('auth:customer');
Route::post('/send-interest/{id}', [LoginController::class, 'sendInterest'])->name('send.interest')->middleware('auth:customer');

Route::get('/admin-settings',[AdminController::class,'index'])->name('admin');
Route::put('/update/{id}',[AdminController::class,'update']);
Route::delete('/delete/{id}',[AdminController::class,'destroy']);