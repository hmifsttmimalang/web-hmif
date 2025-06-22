<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PendaftaranController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Home', [
        'currentUser' => Auth::user(),
    ]);
});

Route::get('/posts', function () {
    return Inertia::render('BlogPost');
});

Route::get('/login', function () {
    return Inertia::render('auth/Login');
})->name('login');

Route::get('/register', function () {
    return Inertia::render('auth/Register');
})->name('register');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/edit-profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/dashboard/edit-profil/update', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
