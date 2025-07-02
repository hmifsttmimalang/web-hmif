<?php

use App\Http\Controllers\AdminAnggotaController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\KelolaAnggotaController;
use App\Http\Controllers\RegistrationPeriodController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin', 'superadmin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // kelola data anggota
    Route::get('/admin/kelola-data', [KelolaAnggotaController::class, 'index'])->name('admin.kelola-data');
    Route::post('/admin/anggota/import', [KelolaAnggotaController::class, 'import'])->name('admin.anggota.import');
    Route::patch('/admin/anggota/{id}', [KelolaAnggotaController::class, 'update'])->name('admin.anggota.update');
    Route::get('/admin/anggota/export', [KelolaAnggotaController::class, 'export'])->name('admin.anggota.export');
    Route::delete('/admin/anggota/{anggota}', [KelolaAnggotaController::class, 'destroy'])->name('admin.anggota.destroy');

    // anggota
    Route::get('/admin/anggota', [AdminAnggotaController::class, 'index'])->name('admin.kelola-data.anggota');
    Route::get('/admin/anggota/pdf', [AdminAnggotaController::class, 'cetakPdf'])->name('anggota.cetak-pdf');
    Route::get('/admin/anggota/cetak-baru', [AdminAnggotaController::class, 'cetakAnggotaBaru'])->name('anggota.cetakBaru');
    Route::get('/admin/anggota/{id}/data-diri', [AdminAnggotaController::class, 'cetakDataDiri'])->name('anggota.cetak-data-diri');
    Route::get('/admin/anggota/{id}', [AdminAnggotaController::class, 'show'])->name('admin.kelola-data.detail-anggota');

    // info anggota baru
    Route::get('/admin/info-user', [InfoUserController::class, 'index'])->name('admin.kelola-data.info-user');

    // pengaturan waktu
    Route::get('/admin/pendaftaran/periode', [RegistrationPeriodController::class, 'index'])->name('admin.periode.index');
    Route::post('/pendaftaran/periode', [RegistrationPeriodController::class, 'store'])->name('admin.periode.store');
    Route::patch('/pendaftaran/periode/{id}', [RegistrationPeriodController::class, 'update'])->name('admin.periode.update');
    Route::delete('/pendaftaran/periode/{id}', [RegistrationPeriodController::class, 'destroy'])->name('admin.periode.destroy');
});
