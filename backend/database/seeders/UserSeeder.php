<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin (optional)
        User::factory()->create([
            'nama' => 'Admin HMIF',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'islam',
            'alamat' => 'Jl. Contoh Alamat No. 1, Bandung',
            'nim' => '1234567890',
            'prodi' => 'Teknik Informatika',
            'angkatan' => 2020,
            'alasan' => 'Untuk mengelola organisasi',
            'foto' => 'default.jpg', // Gambar default untuk admin
            'email' => 'admin@hmif.local',
            'telepon' => '081234567890',
            'password' => bcrypt('admin12345'), // Password untuk admin
            'role' => 'admin',
        ]);

        // User random
        User::factory(10)->create();
    }
}
