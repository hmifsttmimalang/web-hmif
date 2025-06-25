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

        // 13 User biasa
        MemberRegistration::factory()
            ->count(13)
            ->create();
    }
}
