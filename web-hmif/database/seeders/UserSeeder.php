<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
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
            'foto' => 'foto/default.jpg', // Gambar default untuk admin
            'email' => 'admin@hmif.local',
            'telepon' => '081234567890',
            'password' => bcrypt('admin12345'), // Password untuk admin
            'jabatan' => null,
            'status' => 'Aktif',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'nama' => 'User HMIF',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'islam',
            'alamat' => 'Jl. Contoh Alamat No. 2, Bandung',
            'nim' => '0987654321',
            'prodi' => 'Teknik Informatika',
            'angkatan' => 2021,
            'alasan' => 'Untuk berpartisipasi dalam organisasi',
            'foto' => 'foto/default.jpg', // Gambar default untuk user
            'email' => 'user@hmif.local',
            'telepon' => '089876543210',
            'password' => bcrypt('user12345'), // Password untuk user
            'jabatan' => null,
            'status' => 'Baru',
            'role' => 'user',
        ]);

        // User random
        User::factory(13)->create();
    }
}
