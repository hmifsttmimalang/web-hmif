<?php

use App\Models\User;

it('can display admin dashboard with pendaftar, total pendaftar, dan total anggota', function () {
    $admin = User::factory()->create(['role' => 'superadmin']);

    $this->actingAs($admin);

    // 5 pendaftar dalam rentang waktu
    User::factory()->count(5)->create([
        'role' => 'user',
        'status' => 'Baru',
        'created_at' => '2025-07-10',
    ]);

    // 1 user di luar periode
    User::factory()->create([
        'role' => 'user',
        'status' => 'Aktif',
        'created_at' => '2024-01-01',
    ]);

    $response = $this->get(route('admin.dashboard'));

    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) =>
        $page->component('Admin/Dashboard')
            ->has('pendaftarBaru.data', 5)
            ->where('totalPendaftar', 5)
            ->where('totalAnggota', 6) // 5 user + 1 admin
    );
});
