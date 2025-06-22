<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminAnggotaController extends Controller
{
    public function index()
    {
        // Hanya user biasa, urutkan nama
        $anggota = User::orderBy('nama')->get([
            'nim',
            'nama',
            'alamat',
            'prodi',
            'angkatan'
        ]);
        // NOTE: kalau kolom jabatan dan status belum ada di tabel, tambahkan di migration/model.

        return Inertia::render('Admin/Anggota', [
            'anggota' => $anggota,
        ]);
    }
    public function show($id)
    {
        $anggota = User::find($id); // atau pakai findOrFail
        return inertia('Admin/DetailAnggota', [
            'anggota' => $anggota
        ]);
    }
}
