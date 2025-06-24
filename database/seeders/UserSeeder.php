<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'nama' => 'Admin',
            'tempat_lahir' => null,
            'tanggal_lahir' => null,
            'jenis_kelamin' => null,
            'agama' => null,
            'alamat' => 'Jl. Candi Panggung Barat No 48, Kota Malang 65142, Jawa Timur',
            'nim' => null,
            'prodi' => null,
            'angkatan' => null,
            'alasan' => null,
            'foto' => 'foto/default.jpg',
            'username' => 'admin',
            'email' => 'hmifsttmimalang@gmail.com',
            'telepon' => null,
            'password' => bcrypt('HmifSttmiMalang2025'),
            'jabatan' => null,
            'status' => 'Aktif',
            'role' => 'superadmin',
        ]);

        User::factory(13)->create();
    }
}
