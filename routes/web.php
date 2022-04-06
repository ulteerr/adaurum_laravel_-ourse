<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home.index');

Route::get('/contact', function () {
    return 'Contact';
})->name('home.contact');


Route::get('/posts/{id}', function ($id) {
    return 'Blog post 1' . $id;
})->where([
    'id'=>'[0-9]+'
])->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from' . $daysAgo . 'days ago';
})->name('posts.recent.index');
