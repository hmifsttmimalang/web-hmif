<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PendaftaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'currentUser' => Auth::user(),
    ]);
});

// Route::get('/posts', function () {
//     return Inertia::render('BlogPost');
// });

Route::get('/unauthorized', function () {
    return Inertia::render('Unauthorized');
})->name('unauthorized');

Route::get('/register/belum-dibuka', function () {
    return Inertia::render('Auth/PendaftaranBelumDibuka');
})->name('register.belum-dibuka');

Route::get('/register/ditutup', function () {
    return Inertia::render('Auth/PendaftaranDitutup');
})->name('register.ditutup');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/register', [PendaftaranController::class, 'create'])->middleware('check.registration.period')->name('register');
Route::post('/register', [PendaftaranController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/dashboard/edit-profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/dashboard/edit-profil/update', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/admin.php';
