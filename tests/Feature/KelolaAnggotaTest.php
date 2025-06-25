<?php

use App\Models\User;

it('can display anggota list for admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user1 = User::factory()->create(['role' => 'user']);
    $user2 = User::factory()->create(['role' => 'user']);

    $this->actingAs($admin);

    $response = $this->get(route('admin.kelola-data'));

    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) =>
        $page->component('Admin/KelolaData')
            ->has('anggota')
            ->where('currentUser.id', $admin->id)
    );
});

it('admin can update anggota jabatan and status', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $anggota = User::factory()->create(['role' => 'user']);

    $this->actingAs($admin);

    $response = $this->patch(route('admin.anggota.update', $anggota->id), [
        'jabatan' => 'Koordinator',
        'status' => 'Aktif',
    ]);

    $response->assertRedirect();
    $anggota->refresh();

    expect($anggota->jabatan)->toBe('Koordinator');
    expect($anggota->status)->toBe('Aktif');
});

it('superadmin can update user role', function () {
    $superadmin = User::factory()->create(['role' => 'superadmin']);
    $anggota = User::factory()->create(['role' => 'user']);

    $this->actingAs($superadmin);

    $response = $this->patch(route('admin.anggota.update', $anggota->id), [
        'jabatan' => 'Ketua Divisi',
        'status' => 'Aktif',
        'role' => 'admin',
    ]);

    $response->assertRedirect();
    $anggota->refresh();

    expect($anggota->role)->toBe('admin');
});


it('admin can delete anggota', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $anggota = User::factory()->create(['role' => 'user']);

    $this->actingAs($admin);
    $response = $this->delete(route('admin.anggota.destroy', $anggota));

    $response->assertRedirect();
    $this->assertModelMissing($anggota);
});

it('user cannot delete themselves', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin);
    $response = $this->delete(route('admin.anggota.destroy', $admin));

    $response->assertStatus(403);
});
