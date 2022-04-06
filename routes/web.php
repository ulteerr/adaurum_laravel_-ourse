<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home.index');

Route::get('/contact', function () {
    return 'Contact';
})->name('home.contact');
