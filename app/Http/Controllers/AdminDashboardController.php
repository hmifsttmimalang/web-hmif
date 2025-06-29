<?php

namespace App\Http\Controllers;

use App\Models\RegistrationPeriod;
use App\Models\User;
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

        $activePeriod = RegistrationPeriod::where('is_active', true)
            ->orderByDesc('start_at')
            ->first();

        $totalPendaftar = User::where('role', 'user')
            ->where('status', 'Baru')
            ->when($activePeriod, function ($query) use ($activePeriod) {
                $query->whereBetween('created_at', [
                    $activePeriod->start_at,
                    $activePeriod->end_at,
                ]);
            })
            ->count();

        $pendaftar24Jam = User::where('role', 'user')
            ->where('status', 'Baru')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        $totalAnggota = User::where('role', '!=', 'superadmin')->count();

        return Inertia::render('Admin/Dashboard', [
            'pendaftarBaru' => $pendaftarBaru,
            'totalPendaftar' => $totalPendaftar,
            'totalAnggota' => $totalAnggota,
            'pendaftar24Jam' => $pendaftar24Jam,
            'periodeAktif' => $activePeriod
                ? [
                    'start_at' => $activePeriod->start_at->toIso8601String(),
                    'end_at' => $activePeriod->end_at->toIso8601String(),
                ]
                : null,
        ]);
    }
}
