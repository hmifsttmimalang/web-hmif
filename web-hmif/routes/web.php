<?php

use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\AdminAnggotaController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\PendaftaranController;
use App\Http\Controllers\KelolaAnggotaController;
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

Route::get('/login', function () {
    return Inertia::render('auth/Login');
})->name('login');

Route::get('/register', [PendaftaranController::class, 'create'])->name('register');

Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/edit-profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/dashboard/edit-profil/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/kelola-data', [KelolaAnggotaController::class, 'index'])->name('admin.kelola-data');
    Route::get('/admin/anggota', [AdminAnggotaController::class, 'index'])->name('admin.kelola-data.anggota');
    Route::get('/admin/anggota/{id}', function () {
        return Inertia::render('Admin/DetailAnggota', [
            'currentUser' => Auth::user(),
        ]);
    })->name('admin.kelola-data.detail-anggota');
    Route::get('/admin/info-user', [InfoUserController::class, 'index'])->name('admin.kelola-data.info-user');
});
