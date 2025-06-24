<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['L', 'P']);

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
            'nama' => $this->faker->name($gender === 'L' ? 'male' : 'female'),
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date(),
            'jenis_kelamin' => $gender,
            'agama' => $this->faker->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu']),
            'alamat' => $this->faker->address,
            'nim' => $this->faker->unique()->numerify('######'),
            'prodi' => $prodi,
            'angkatan' => $this->faker->year(),
            'alasan' => $this->faker->sentence(),
            'foto' => 'foto/default.jpg',
            'email' => $email,
            'telepon' => $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'username' => $username,
            'password' => Hash::make('password'),
            'jabatan' => null,
            'status' => $this->faker->randomElement(['Baru', 'Aktif', 'Demisioner', 'Nonaktif']),
            'role' => 'user',
            'remember_token' => Str::random(10),
        ];
    }
}
