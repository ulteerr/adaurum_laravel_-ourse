<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home.index', []);
//})->name('home.index');
//
//Route::get('/contact', function () {
//    return view('home.contact');
//})->name('home.contact');
Route::view('/', 'home.index')->name('home.index');
Route::view('/', 'home.contact')->name('home.contact');
$posts = [
    1 => [
        'title' => 'Intro to laravel',
        'content' => 'This is a short to laravel',
        'is_new' => true,
        'has_comments' => true,
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false,
    ],
    3 => [
        'title' => 'Intro to Golang',
        'content' => 'This is a short intro to Golang',
        'is_new' => false,
    ],
];
Route::get('/posts', function () use($posts){
   return view('posts.index', ['posts'=>$posts]);
});
Route::get('/posts/{id}', function ($id) use($posts){

    abort_if(!isset($posts[$id]), 404);
    return view('posts.show', ['posts' => $posts[$id]]);
});

Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from' . $daysAgo . 'days ago';
})->name('posts.recent.index');
