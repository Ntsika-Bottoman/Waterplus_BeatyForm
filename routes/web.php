<?php

use Illuminate\Support\Facades\Route;
use App\Models\Article;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::view('create', 'create')
->middleware(['auth', 'verified'])
->name('create');

Route::post('/create', function(){
    $article = new Article();
    $article->title = request('title');
    $article->body = request('body');
    $article->save();
    return redirect('/dashboard');
});
