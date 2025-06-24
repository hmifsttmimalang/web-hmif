<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminAnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::orderBy('nama')
            ->where('role', '!=', 'superadmin')
            ->get([
                'id',
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

    public function cetakPdf()
    {
        $anggota = User::where('role', '!=', 'superadmin')->orderBy('nama')->get();
        $pdf = PDF::loadView('pdf.anggota_table', compact('anggota'));
        return $pdf->download('data_anggota.pdf');
    }

    public function cetakKartu($id)
    {
        $anggota = User::findOrFail($id);
        $pdf = PDF::loadView('pdf.kartu_anggota', compact('anggota'));
        return $pdf->download("kartu_anggota_{$anggota->nama}.pdf");
    }
}
