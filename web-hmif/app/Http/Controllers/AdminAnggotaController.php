<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminAnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::orderBy('nama')
            ->where('role', '!=', 'superadmin')
            ->get([
                'nim',
                'nama',
                'alamat',
                'prodi',
                'angkatan',
                'jabatan',
                'status',
            ]);

        return Inertia::render('Admin/Anggota', [
            'anggota' => $anggota,
        ]);
    }
    public function show($id)
    {
        $anggota = User::find($id);
        return inertia('Admin/DetailAnggota', [
            'anggota' => $anggota
        ]);
    }
}
