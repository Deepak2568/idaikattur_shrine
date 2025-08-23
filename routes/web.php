<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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

// crud
Route::post('/contact',[ContactController::class,'store'])->name('contact');