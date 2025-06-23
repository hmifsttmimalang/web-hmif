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
            'nim' => '123890',
            'prodi' => 'Teknik Informatika',
            'angkatan' => 2020,
            'alasan' => 'Untuk mengelola organisasi',
            'foto' => 'foto/default.jpg',
            'email' => 'admin@hmif.local',
            'telepon' => '081234567890',
            'password' => bcrypt('admin12345'),
            'jabatan' => null,
            'status' => 'Aktif',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'nama' => 'Super Admin',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'islam',
            'alamat' => 'Jl. Contoh Alamat No. 1, Bandung',
            'nim' => '156780',
            'prodi' => 'Teknik Informatika',
            'angkatan' => 2020,
            'alasan' => 'Untuk mengelola organisasi',
            'foto' => 'foto/default.jpg',
            'email' => 'superadmin@hmif.local',
            'telepon' => '08323734450',
            'password' => bcrypt('superadmin123'),
            'jabatan' => null,
            'status' => 'Aktif',
            'role' => 'superadmin',
        ]);

        User::factory()->create([
            'nama' => 'User HMIF',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'islam',
            'alamat' => 'Jl. Contoh Alamat No. 2, Bandung',
            'nim' => '765421',
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
