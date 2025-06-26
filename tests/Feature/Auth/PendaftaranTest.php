<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MemberRegistration;
use App\Models\RegistrationPeriod;
use Carbon\Carbon;

it('can register a new user successfully', function () {
    Storage::fake('public');

    RegistrationPeriod::create([
        'start_at' => Carbon::now()->subHour(), // Dibuka 1 jam yang lalu
        'end_at' => Carbon::now()->addDay(),    // Masih terbuka
        'is_active' => true,
    ]);

    $foto = UploadedFile::fake()->image('avatar.jpg');
    $portofolio = UploadedFile::fake()->create('porto.pdf', 500, 'application/pdf');

    $response = $this->post(route('register.store'), [
        // User table fields
        'nama' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'username' => 'budi123',
        'nim' => '123456789',
        'prodi' => 'Teknik Informatika',
        'angkatan' => '2022',
        'telepon' => '08123456789',
        'instagram' => 'budi.ig',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'foto' => $foto,
        'terms' => true,

        // MemberRegistration fields
        'tempat_lahir' => 'Surabaya',
        'tanggal_lahir' => '1999-05-20',
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Mawar 123',

        'motivasi' => 'Ingin berkembang',
        'harapan' => 'Menjadi lebih baik',
        'bagi_waktu' => 'Saya bisa bagi waktu',
        'kontribusi' => 'Ya',
        'minat' => ['Desain', 'Fotografi'],
        'minat_lainnya' => null,
        'pengalaman_organisasi' => 'Pernah ikut BEM',
        'divisi' => 'Media',
        'ket_portofolio' => 'Berisi karya saya',
        'link_portofolio' => 'https://example.com/porto',
        'file_portofolio' => $portofolio,
        'skill' => 'Design',
        'ide' => 'Mengembangkan website',
        'solusi' => 'Meningkatkan aspirasi mahasiswa',
    ]);

    $response->assertRedirect(route('login'));

    $this->assertDatabaseHas(User::class, [
        'email' => 'budi@example.com',
        'username' => 'budi123',
    ]);

    $user = User::where('email', 'budi@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->memberRegistration)->not->toBeNull();
    expect($user->memberRegistration->divisi)->toBe('Media');

    Storage::disk('public')->assertExists($user->foto);
    Storage::disk('public')->assertExists($user->memberRegistration->file_portofolio);
});

it('cannot register a new user when registration period has not started', function () {
    Storage::fake('public');

    // Setup: Periode pendaftaran belum dimulai
    RegistrationPeriod::create([
        'start_at' => Carbon::now()->addHour(), // Mulai 1 jam lagi
        'end_at' => Carbon::now()->addDay(),    // Masih terbuka
        'is_active' => true,
    ]);

    $foto = UploadedFile::fake()->image('avatar.jpg');
    $portofolio = UploadedFile::fake()->create('porto.pdf', 500, 'application/pdf');

    $response = $this->post(route('register.store'), [
        // User table fields
        'nama' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'username' => 'budi123',
        'nim' => '123456789',
        'prodi' => 'Teknik Informatika',
        'angkatan' => '2022',
        'telepon' => '08123456789',
        'instagram' => 'budi.ig',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'foto' => $foto,
        'terms' => true,

        // MemberRegistration fields
        'tempat_lahir' => 'Surabaya',
        'tanggal_lahir' => '1999-05-20',
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Mawar 123',

        'motivasi' => 'Ingin berkembang',
        'harapan' => 'Menjadi lebih baik',
        'bagi_waktu' => 'Saya bisa bagi waktu',
        'kontribusi' => 'Ya',
        'minat' => ['Desain', 'Fotografi'],
        'minat_lainnya' => null,
        'pengalaman_organisasi' => 'Pernah ikut BEM',
        'divisi' => 'Media',
        'ket_portofolio' => 'Berisi karya saya',
        'link_portofolio' => 'https://example.com/porto',
        'file_portofolio' => $portofolio,
        'skill' => 'Design',
        'ide' => 'Mengembangkan website',
        'solusi' => 'Meningkatkan aspirasi mahasiswa',
    ]);

    $response->assertForbidden(); // Pastikan ada error, karena belum dimulai

    $this->assertDatabaseMissing(User::class, [
        'email' => 'budi@example.com',
    ]);
});

it('cannot register a new user when registration period has ended', function () {
    Storage::fake('public');

    // Setup: Periode pendaftaran sudah berakhir
    RegistrationPeriod::create([
        'start_at' => Carbon::now()->subDay(), // Mulai kemarin
        'end_at' => Carbon::now()->subHour(),  // Sudah berakhir 1 jam yang lalu
        'is_active' => true,
    ]);

    $foto = UploadedFile::fake()->image('avatar.jpg');
    $portofolio = UploadedFile::fake()->create('porto.pdf', 500, 'application/pdf');

    $response = $this->post(route('register.store'), [
        // User table fields
        'nama' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'username' => 'budi123',
        'nim' => '123456789',
        'prodi' => 'Teknik Informatika',
        'angkatan' => '2022',
        'telepon' => '08123456789',
        'instagram' => 'budi.ig',
        'password' => 'password123',
        'password_confirmation' => 'password123',
        'foto' => $foto,
        'terms' => true,

        // MemberRegistration fields
        'tempat_lahir' => 'Surabaya',
        'tanggal_lahir' => '1999-05-20',
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Mawar 123',

        'motivasi' => 'Ingin berkembang',
        'harapan' => 'Menjadi lebih baik',
        'bagi_waktu' => 'Saya bisa bagi waktu',
        'kontribusi' => 'Ya',
        'minat' => ['Desain', 'Fotografi'],
        'minat_lainnya' => null,
        'pengalaman_organisasi' => 'Pernah ikut BEM',
        'divisi' => 'Media',
        'ket_portofolio' => 'Berisi karya saya',
        'link_portofolio' => 'https://example.com/porto',
        'file_portofolio' => $portofolio,
        'skill' => 'Design',
        'ide' => 'Mengembangkan website',
        'solusi' => 'Meningkatkan aspirasi mahasiswa',
    ]);

    $response->assertForbidden(); // Pastikan ada error, karena periode sudah berakhir

    $this->assertDatabaseMissing(User::class, [
        'email' => 'budi@example.com',
    ]);
});
