<?php

namespace App\Imports;

use App\Models\MemberRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AnggotaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tanggal_lahir = $row['tanggal_lahir'];
            if (is_numeric($tanggal_lahir)) {
                $tanggal_lahir = Date::excelToDateTimeObject($tanggal_lahir)->format('Y-m-d');
            }

            $telepon = $row['telepon'] ?? null;

            if ($telepon) {
                $telepon = preg_replace('/\D/', '', $telepon);

                if (str_starts_with($telepon, '0')) {
                    $telepon = '62' . substr($telepon, 1);
                } elseif (str_starts_with($telepon, '+62')) {
                    $telepon = substr($telepon, 1);
                }

                $telepon = 'https://wa.me/' . $telepon;
            }

            $user = User::create([
                'nama' => $row['nama'],
                'nim' => $row['nim'] ?? uniqid(),
                'prodi' => $row['prodi'],
                'angkatan' => $row['angkatan'],
                'foto' => $row['foto'] ?? 'foto/default.jpg',
                'username' => $row['username'] ?? (isset($row['email']) ? explode('@', $row['email'])[0] : null),
                'email' => $row['email'],
                'telepon' => $telepon,
                'password' => Hash::make('password123'),
                'jabatan' => $row['jabatan'] ?? null,
                'status' => $row['status'] ?? 'Aktif',
                'role' => $row['role'] ?? 'user',
            ]);

            if ($user && $user->id) {
                MemberRegistration::create([
                    'user_id' => $user->id,
                    'tempat_lahir' => $row['tempat_lahir'] ?? null,
                    'tanggal_lahir' => $tanggal_lahir ?? null,
                    'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
                    'agama' => $row['agama'] ?? null,
                    'alamat' => $row['alamat'] ?? null,
                    'motivasi' => $row['motivasi'] ?? null,
                    'harapan' => $row['harapan'] ?? null,
                    'bagi_waktu' => $row['bagi_waktu'] ?? null,
                    'kontribusi' => $row['kontribusi'] ?? null,
                    'minat' => empty($row['minat'])
                        ? null
                        : array_map('trim', explode(',', $row['minat'])),
                    'minat_lainnya' => $row['minat_lainnya'] ?? null,
                    'pengalaman_organisasi' => $row['pengalaman_organisasi'] ?? null,
                    'divisi' => $row['divisi'] ?? null,
                    'ket_portofolio' => $row['ket_portofolio'] ?? null,
                    'link_portofolio' => $row['link_portofolio'] ?? null,
                    'file_portofolio' => $row['file_portofolio'] ?? null,
                    'skill' => $row['skill'] ?? null,
                    'ide' => $row['ide'] ?? null,
                    'solusi' => $row['solusi'] ?? null,
                ]);
            }
        }
    }
}
