<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Inertia\Inertia;

class InfoUserController extends Controller
{
    public function index()
    {
        $start = now()->subMonths(2);

        $userBaruList = User::with('memberRegistration')
            ->where('created_at', '>=', $start)
            ->where('role', 'user')
            ->where('status', 'Baru')
            ->orderByDesc('created_at')
            ->get([
                'id',
                'nim',
                'nama',
                'prodi',
                'angkatan',
                'status',
            ]);

        return Inertia::render('Admin/InfoUser', [
            'userBaruList' => $userBaruList,
        ]);
    }
}
