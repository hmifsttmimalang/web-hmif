<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class KelolaAnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->get([
                'id',
                'nim',
                'nama',
                'alamat',
                'prodi',
                'angkatan',
            ]);

        return Inertia::render('Admin/KelolaData', [
            'anggota' => $anggota
        ]);
    }
}
