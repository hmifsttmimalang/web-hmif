<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Home', [
        'title' => 'Beranda'
    ]);
});

Route::get('/post', function () {
    return Inertia::render('BlogPost', [
        'posts' => [
            ['id' => 1, 'title' => 'Post Satu'],
            ['id' => 2, 'title' => 'Post Dua'],
        ]
    ]);
});
