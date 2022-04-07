<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
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
//    dd(request()->all());
    dd((int)request()->query('page', 1));
   return view('posts.index', ['posts'=>$posts]);
});
Route::get('/posts/{id}', function ($id) use($posts){

Route::get('/single', AboutController::class);
Route::resource('posts', PostsController::class)->only(['index', 'show', 'create', 'store']);

Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from' . $daysAgo . 'days ago';
})->name('posts.recent.index')->middleware('auth');



Route::prefix('/fun')->name('fun.')->group(function () use($posts){
    Route::get('/fun/responses', function () use($posts){
        return response($posts, 201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE', 'Piotr Jura', 3600);
    })->name('responses');
    Route::get('/fun/redirect', function (){
        return redirect('/contact');
    });
    Route::get('/fun/back', function (){
        return back();
    })->name('back');
    Route::get('/fun/named-route', function (){
        return redirect()->route('posts.show', ['id'=>1]);
    })->name('named-route');
    Route::get('/fun/away', function (){
        return redirect()->away('https://www.google.com/');
    })->name('away');
    Route::get('/fun/json', function () use($posts){
        return response()->json($posts);
    })->name('json');
    Route::get('/fun/download', function () use($posts){
        return response()->download(public_path('/daniel.jpg'), 'face.jpg');
    })->name('download');
});
