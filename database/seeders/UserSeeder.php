<?php

namespace Database\Seeders;

use App\Models\MemberRegistration;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Superuser
        User::factory()->create([
            'nama' => 'Admin',
            'nim' => null,
            'prodi' => null,
            'angkatan' => null,
            'telepon' => null,
            'instagram' => null,
            'email' => 'hmifsttmimalang@gmail.com',
            'email_verified_at' => now(),
            'foto' => 'foto/default.jpg',
            'username' => 'admin',
            'password' => Hash::make('HmifSttmiMalang2025'),
            'jabatan' => null,
            'status' => 'Aktif',
            'role' => 'superadmin',
        ]);

        User::factory()->create([
            'nama' => 'Backup Admin',
            'nim' => null,
            'prodi' => null,
            'angkatan' => null,
            'telepon' => null,
            'instagram' => null,
            'email' => 'backupadmin@hmif.com',
            'email_verified_at' => now(),
            'foto' => 'foto/default.jpg',
            'username' => 'adminbackup',
            'password' => Hash::make('BackupSuperSecureHmifSttmiMalang2025'),
            'jabatan' => null,
            'status' => 'Aktif',
            'role' => 'superadmin',
        ]);
    }
}
