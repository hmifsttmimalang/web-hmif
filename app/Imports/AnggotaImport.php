<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * @implements ToModel
 * @implements WithHeadingRow
 * @implements WithMapping
 */
class AnggotaImport implements ToModel, WithHeadingRow, WithMapping
{
    public function model(array $row)
    {
        return new User($row);
    }

    /**
     * @param array $row
     * @return array
     */
    public function map($row): array
    {
        $tanggal_lahir = $row['tanggal_lahir'];
        if (is_numeric($tanggal_lahir)) {
            $tanggal_lahir = Date::excelToDateTimeObject($tanggal_lahir)->format('Y-m-d');
        }

        return [
            'nama' => $row['nama'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $row['jenis_kelamin'],
            'agama' => $row['agama'],
            'alamat' => $row['alamat'],
            'nim' => $row['nim'] ?? uniqid(),
            'prodi' => $row['prodi'],
            'angkatan' => $row['angkatan'],
            'foto' => $row['foto'] ?? 'foto/default.jpg',
            'username' => $row['username'] ?? (isset($row['email']) ? explode('@', $row['email'])[0] : null),
            'email' => $row['email'],
            'telepon' => $row['telepon'],
            'password' => Hash::make('password123'),
            'jabatan' => $row['jabatan'] ?? null,
            'status' => $row['status'] ?? 'Aktif',
            'role' => $row['role'] ?? 'user',
        ];
    }
}
