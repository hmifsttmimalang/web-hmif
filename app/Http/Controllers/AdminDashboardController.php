<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pendaftarBaru = User::with('memberRegistration')
            ->where('role', 'user')
            ->where('status', 'Baru')
            ->latest()
            ->paginate(10, ['id', 'nama', 'nim', 'prodi', 'angkatan', 'status']);

        $totalPendaftar = User::where('role', 'user')
            ->whereBetween('created_at', [
                Carbon::parse('2025-07-07 00:00:00'),
                Carbon::parse('2025-09-02 23:59:59'),
            ])
            ->count();

        $totalAnggota = User::where('role', '!=', 'superadmin')->count();

        return Inertia::render('Admin/Dashboard', [
            'pendaftarBaru' => $pendaftarBaru,
            'totalPendaftar' => $totalPendaftar,
            'totalAnggota' => $totalAnggota,
        ]);
    }
}
