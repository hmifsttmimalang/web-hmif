<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $gender = 'male';
        $prodi = $this->faker->randomElement([
            'Teknik Informatika',
            'Teknik Sipil',
            'Digital Arsitektur',
            'Manajemen Bisnis',
            'Manajemen Keuangan',
            'Manajemen Perkantoran',
            'Manajemen Komunikasi',
            'Multimedia Broadcasting',
            'Desain Grafis'
        ]);

        $email = $this->faker->unique()->safeEmail();
        $username = explode('@', $email)[0];

        return [
            'nama' => $this->faker->name($gender),
            'nim' => $this->faker->unique()->numerify('######'),
            'prodi' => $prodi,
            'angkatan' => (string) $this->faker->numberBetween(2022, 2025),
            'telepon' => 'https://wa.me/62' . $this->faker->numerify('812#######'),
            'instagram' => $this->faker->unique()->userName(),
            'email' => $email,
            'email_verified_at' => now(),
            'foto' => 'foto/default.jpg',
            'username' => $username,
            'password' => Hash::make('password'),
            'role' => 'user',
            'jabatan' => null,
            'status' => $this->faker->randomElement(['Baru', 'Aktif', 'Demisioner', 'Nonaktif']),
            'remember_token' => Str::random(10),
        ];
    }
}
