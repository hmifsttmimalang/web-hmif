<?php

use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\AdminAnggotaController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/register', [PendaftaranController::class, 'create'])->name('register');
Route::post('/register', [PendaftaranController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/dashboard/edit-profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/dashboard/edit-profil/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'admin', 'superadmin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // kelola data anggota
    Route::get('/admin/kelola-data', [KelolaAnggotaController::class, 'index'])->name('admin.kelola-data');
    Route::post('/admin/anggota/import', [KelolaAnggotaController::class, 'import'])->name('admin.anggota.import');
    Route::patch('/admin/anggota/{id}', [KelolaAnggotaController::class, 'update'])->name('admin.anggota.update');
    Route::delete('/admin/anggota/{anggota}', [KelolaAnggotaController::class, 'destroy'])->name('admin.anggota.destroy');

    // anggota
    Route::get('/admin/anggota', [AdminAnggotaController::class, 'index'])->name('admin.kelola-data.anggota');
    Route::get('/admin/anggota/pdf', [AdminAnggotaController::class, 'cetakPdf'])->name('anggota.cetak-pdf');
    Route::get('/admin/anggota/cetak-baru', [AdminAnggotaController::class, 'cetakAnggotaBaru'])->name('anggota.cetakBaru');
    Route::get('/admin/anggota/{id}/kartu', [AdminAnggotaController::class, 'cetakKartu'])->name('anggota.cetak-kartu');
    Route::get('/admin/anggota/{id}', [AdminAnggotaController::class, 'show'])->name('admin.kelola-data.detail-anggota');

    // info anggota baru
    Route::get('/admin/info-user', [InfoUserController::class, 'index'])->name('admin.kelola-data.info-user');
});
