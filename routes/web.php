<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PriestController;
use App\Http\Controllers\DeployController;
use App\Http\Controllers\DonationController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::post('/ci-deploy', DeployController::class)->name('ci.deploy');

// Serve public-disk files without relying on public/storage symlink (shared hosting).
Route::get('/media/{path}', function (string $path) {
    $path = str_replace('\\', '/', $path);
    $path = ltrim($path, '/');
    if ($path === '' || str_contains($path, '..')) {
        abort(404);
    }

    $base = realpath(storage_path('app/public'));
    $full = realpath(storage_path('app/public/'.$path));

    abort_unless($base && $full && str_starts_with($full, $base) && is_file($full), 404);

    return response()->file($full, [
        'Cache-Control' => 'public, max-age=604800',
    ]);
})->where('path', '.*')->name('media');

// Shared hosting: docroot is app root, so /css/* 404s while /public/css/* works.
// This route keeps asset('css/...') working when the request hits Laravel.
Route::get('/css/shrine-theme.css', function () {
    $path = public_path('css/shrine-theme.css');
    abort_unless(is_file($path), 404);

    return response()->file($path, [
        'Content-Type' => 'text/css; charset=UTF-8',
        'Cache-Control' => 'public, max-age=604800',
    ]);
});

Route::get('/', function () {
    return view('home');
});

Route::get('/schedule', function () {
    return view('shrine.schedule');
});

Route::view('/mass-offerings', 'shrine.mass_offerings');

Route::get('/priest', [PriestController::class, 'index'])->name('priest.index');
Route::post('/priest', [PriestController::class, 'store'])->name('priest.store');
Route::get('/priest/{id}/edit', [PriestController::class, 'edit'])->name('priest.edit');
Route::put('/priest/{id}', [PriestController::class, 'update'])->name('priest.update');
Route::delete('/priest/{id}', [PriestController::class, 'destroy'])->name('priest.destroy');
Route::view('/contact', 'shrine.contact');
Route::get('/donate', [DonationController::class, 'index'])->name('donate');
Route::post('/donate', [DonationController::class, 'store'])->name('donate.store');
Route::view('/videos', 'shrine.mass_videos');
Route::view('/about', 'shrine.about');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
Route::get('/gallery/folder/{folderName}', [GalleryController::class, 'getImagesByFolder'])->name('gallery.folder');
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
Route::put('/deactivate/{id}',[AdminController::class,'deactivate']);
Route::delete('/delete/{id}',[AdminController::class,'destroy']);


Route::get('/home-settings', [AdminController::class, 'homeSettings'])->name('settings.home');
Route::post('/home-save', [AdminController::class, 'homeSettingsSave'])->name('settings.home.save');
Route::put('/home-update/{id}', [AdminController::class, 'homeSettingsUpdate'])->name('settings.home.update');
Route::get('/home-edit/{id}', [AdminController::class, 'homeSettingsEdit'])->name('settings.home.edit');
Route::delete('/home-delete/{id}', [AdminController::class, 'homeSettingsDelete'])->name('settings.home.delete');
