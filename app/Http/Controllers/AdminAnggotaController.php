<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminAnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::with('memberRegistration')
            ->orderBy('nama')
            ->where('role', '!=', 'superadmin')
            ->where('status', 'Aktif')
            ->get([
                'id',
                'nim',
                'nama',
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
        $anggota = User::with('memberRegistration')->findOrFail($id);

        return inertia('Admin/DetailAnggota', [
            'anggota' => $anggota,
        ]);
    }

    public function cetakPdf()
    {
        $anggota = User::with('memberRegistration')
            ->where('role', '!=', 'superadmin')
            ->orderBy('nama')
            ->get();

        $pdf = PDF::loadView('pdf.anggota_table', compact('anggota'));
        return $pdf->download('data_anggota.pdf');
    }

    public function cetakAnggotaBaru()
    {
        $anggotaBaru = User::with('memberRegistration')
            ->where('role', 'user')
            ->where('status', 'Baru')
            ->orderBy('nama')
            ->get();

        $pdf = PDF::loadView('pdf.anggota_baru', compact('anggotaBaru'));
        return $pdf->download('anggota_baru.pdf');
    }

    public function cetakDataDiri($id)
    {
        $anggota = User::with('memberRegistration')->findOrFail($id);
        $pdf = PDF::loadView('pdf.data_diri_anggota', compact('anggota'));
        $nama = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $anggota->nama));
        $tanggal = now()->format('Ymd');
        return $pdf->download("data_diri_{$nama}_{$tanggal}.pdf");
    }
}
