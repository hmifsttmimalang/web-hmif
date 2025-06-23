<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pendaftarBaru = User::where('role', 'user')
            ->where('status', 'Baru')
            // ->whereBetween('created_at', [
            //     Carbon::parse('2025-07-07 00:00:00'),
            //     Carbon::parse('2025-09-02 23:59:59')
            // ])
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['nim', 'nama', 'alamat', 'prodi', 'angkatan']);

        $totalPendaftar = User::whereBetween('created_at', [
            Carbon::parse('2025-07-07 00:00:00'),
            Carbon::parse('2025-09-02 23:59:59')
        ])->count();

        $totalAnggota = User::all()->count();

        return Inertia::render('Admin/Dashboard', [
            'pendaftarBaru' => $pendaftarBaru,
            'totalPendaftar' => $totalPendaftar,
            'totalAnggota' => $totalAnggota,
        ]);
    }
}
