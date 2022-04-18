<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])
    ->name('home.index')
    ->middleware('auth');

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::resource('posts', PostsController::class);

Auth::routes();

