<?php

use Illuminate\Support\Facades\Storage;
use App\Models\MemberRegistration;
use App\Models\User;

it('can show anggota index page', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $anggota = User::factory()->count(3)->create(['role' => 'user']);

    $this->actingAs($admin);

    $response = $this->get(route('admin.kelola-data.anggota')); // pastikan route name sesuai
    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) =>
        $page->component('Admin/Anggota')
            ->has('anggota', 4) // admin + 3 anggota jika controller tidak memfilter
    );
});

it('can show detail anggota page', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $anggota = User::factory()->create(['role' => 'user']);

    $this->actingAs($admin);

    $response = $this->get(route('admin.kelola-data.detail-anggota', $anggota->id));
    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) =>
        $page->component('Admin/DetailAnggota')
            ->where('anggota.id', $anggota->id)
    );
});


it('can download pdf of all anggota', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    // Buat 1 user biasa
    $anggota = User::factory()
        ->has(MemberRegistration::factory([
            'alamat' => 'Jl. Contoh'
        ]))
        ->create([
            'role' => 'user'
        ]);

    // Tambahkan relasi memberRegistration
    MemberRegistration::factory()->create([
        'user_id' => $anggota->id,
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '2000-01-01',
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Tes',
    ]);

    $response = $this->get(route('anggota.cetak-pdf'));

    $response->assertStatus(200);
    expect($response->headers->get('content-type'))->toContain('application/pdf');
});

it('can download pdf of new anggota only', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $userWithData = User::factory()->create([
        'role' => 'user',
        'status' => 'Baru',
    ]);

    // Buat relasi memberRegistration
    MemberRegistration::factory()->create([
        'user_id' => $userWithData->id,
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '2000-01-01',
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Tes',
    ]);

    $this->actingAs($admin);

    $response = $this->get(route('anggota.cetakBaru'));
    $response->assertStatus(200);
    expect($response->headers->get('content-type'))->toContain('application/pdf');
});

it('can download kartu anggota PDF', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $anggota = User::factory()->create(['role' => 'user']);

    $this->actingAs($admin);

    $response = $this->get(route('anggota.cetak-kartu', $anggota->id));
    $response->assertStatus(200);
    expect($response->headers->get('content-type'))->toContain('application/pdf');
});
