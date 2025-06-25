<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\MemberRegistration;

beforeEach(function () {
    $this->user = User::factory()->create([
        'password' => Hash::make('password123'),
        'role' => 'user',
    ]);

    $this->actingAs($this->user);
});

it('can update user profile without changing password or photo', function () {
    $response = $this->post(route('profile.update'), [
        'nama' => 'User Baru',
        'username' => 'newusername',
        'email' => 'newemail@example.com',
        'telepon' => '081234567890',

        'tempat_lahir' => 'Malang',
        'tanggal_lahir' => '2000-01-01',
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Kebenaran',
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    $this->assertDatabaseHas(User::class, [
        'id' => $this->user->id,
        'nama' => 'User Baru',
        'username' => 'newusername',
        'email' => 'newemail@example.com',
        'telepon' => 'https://wa.me/6281234567890',
    ]);

    $this->assertDatabaseHas(MemberRegistration::class, [
        'user_id' => $this->user->id,
        'tempat_lahir' => 'Malang',
    ]);
});

it('can upload and replace user photo', function () {
    Storage::fake('public');

    $file = UploadedFile::fake()->image('new.jpg', 300, 300);

    $response = $this->post(route('profile.update'), [
        'nama' => 'Foto User',
        'username' => 'fotouser',
        'email' => 'foto@example.com',
        'telepon' => '081111111111',
        'foto' => $file,

        'tempat_lahir' => 'Malang',
        'tanggal_lahir' => '2000-01-01',
        'jenis_kelamin' => 'L',
        'agama' => 'Islam',
        'alamat' => 'Jl. Jalan',
    ]);

    $response->assertRedirect();

    $user = $this->user->fresh();
    expect($user->foto)->not->toBeNull();

    Storage::disk('public')->assertExists($user->foto);
});
