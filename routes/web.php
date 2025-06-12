<?php

use Illuminate\Support\Facades\Route;

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