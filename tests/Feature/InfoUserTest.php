<?php

use App\Models\User;
use App\Models\MemberRegistration;
use Illuminate\Support\Carbon;

it('can display info user page with recent new users', function () {
    // Login sebagai admin
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);

    // Buat 3 user baru dalam 2 bulan terakhir
    User::factory()
        ->count(3)
        ->has(MemberRegistration::factory())
        ->create([
            'role' => 'user',
            'status' => 'Baru',
            'created_at' => now()->subWeeks(1),
        ]);

    // Buat user lama (tidak muncul)
    User::factory()
        ->has(MemberRegistration::factory())
        ->create([
            'role' => 'user',
            'status' => 'Baru',
            'created_at' => now()->subMonths(3),
        ]);

    // Buat user non-user role (tidak muncul)
    User::factory()->create([
        'role' => 'admin',
        'status' => 'Baru',
    ]);

    $response = $this->get(route('admin.kelola-data.info-user'));

    $response->assertStatus(200);
    $response->assertInertia(
        fn($page) =>
        $page->component('Admin/InfoUser')
            ->has('userBaruList', 3) // hanya 3 yang sesuai
    );
});
