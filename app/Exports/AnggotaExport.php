<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class AnggotaExport implements FromCollection, WithHeadings, WithMapping, WithDrawings
{
    private $index = 2; // mulai dari baris ke-2 (karena baris 1 itu header)

    public function collection()
    {
        return User::where('role', '!=', 'superadmin')->get();
    }

    public function headings(): array
    {
        return ['NIM', 'Nama', 'Prodi', 'Angkatan', 'Jabatan', 'Email', 'Status', 'Foto'];
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
            '',
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $baris = 2;

        $anggotaList = $this->collection();

        foreach ($anggotaList as $anggota) {
            if (!$anggota->foto || !file_exists(storage_path('app/public/' . $anggota->foto))) {
                $baris++;
                continue;
            }

            $drawing = new Drawing();
            $drawing->setName($anggota->nama);
            $drawing->setDescription('Foto Anggota');
            $drawing->setPath(storage_path('app/public/' . $anggota->foto));
            $drawing->setHeight(50);
            $drawing->setCoordinates('G' . $baris);
            $drawings[] = $drawing;

            $baris++;
        }

        return $drawings;
    }
}
