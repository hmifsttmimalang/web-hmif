<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return User::where('role', '!=', 'superadmin')->get();
    }

    public function headings(): array
    {
        return ['NIM', 'Nama', 'Prodi', 'Angkatan', 'Jabatan', 'Email', 'Status', 'Foto (Link)'];
    }

    public function map($anggota): array
    {
        return [
            $anggota->nim,
            $anggota->nama,
            $anggota->prodi,
            $anggota->angkatan,
            $anggota->jabatan ?? '-',
            $anggota->email,
            $anggota->status,
            $anggota->foto_url ?? '-',
        ];
    }
}
