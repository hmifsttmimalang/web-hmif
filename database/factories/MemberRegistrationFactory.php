<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class MemberRegistrationFactory extends Factory
{
    public function definition(): array
    {
        $genderCode = $this->faker->randomElement(['L', 'P']);
        $genderCode === 'L' ? 'male' : 'female';

        $minatOptions = [
            'Public Speaking',
            'Menulis',
            'Desain Grafis',
            'Editing Foto/Video',
            'Coding / Programming',
        ];

        // Acak beberapa minat utama
        $minatDipilih = $this->faker->optional()->randomElements($minatOptions, rand(1, 3));

        $includeLainnya = $this->faker->boolean(30);
        if ($includeLainnya) {
            $minatDipilih[] = 'Lainnya';
        }

        return [
            'user_id' => User::factory(),

            // info tambahan
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-18 years'),
            'jenis_kelamin' => $genderCode,
            'agama' => $this->faker->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu']),
            'alamat' => $this->faker->address,

            // motivasi
            'motivasi' => $this->faker->paragraph(2),
            'harapan' => $this->faker->sentence(),
            'bagi_waktu' => $this->faker->sentence(),
            'kontribusi' => $this->faker->randomElement(['Ya', 'Tidak', 'Masih mempertimbangkan']),

            // minat & bakat
            'minat' => json_encode($minatDipilih),
            'minat_lainnya' => $includeLainnya ? $this->faker->words(2, true) : null,
            'pengalaman_organisasi' => $this->faker->paragraph(),
            'divisi' => $this->faker->randomElement([
                'Riset dan Teknologi (Ristek)',
                'Humas',
                'Media dan Dokumentasi (Medkom)',
                'Minat Bakat',
                'Acara dan Kepanitiaan',
                'Keuangan dan Dana Usaha',
                'Tata Usaha',
            ]),

            // portfolio
            'link_portofolio' => $this->faker->optional()->url(),
            'file_portofolio' => $this->faker->optional()->filePath(),
            'skill' => $this->faker->optional()->words(3, true),

            // studi kasus
            'ide' => $this->faker->paragraph(2),
            'solusi' => $this->faker->paragraph(2),
        ];
    }
}
