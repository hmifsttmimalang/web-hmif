<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->password = 'password123';
    $this->user = User::factory()->create([
        'email' => 'testuser@example.com',
        'username' => 'testuser',
        'password' => Hash::make($this->password),
    ]);
});

it('allows login using email', function () {
    $response = post(route('login'), [
        'login' => 'testuser@example.com',
        'password' => $this->password,
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($this->user);
});

it('allows login using username', function () {
    $response = post(route('login'), [
        'login' => 'testuser',
        'password' => $this->password,
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticatedAs($this->user);
});

it('rejects login with wrong password', function () {
    $response = post(route('login'), [
        'login' => 'testuser',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors('login');
    $this->assertGuest();
});

it('rejects login with unknown username', function () {
    $response = post(route('login'), [
        'login' => 'unknownuser',
        'password' => $this->password,
    ]);

    $response->assertSessionHasErrors('login');
    $this->assertGuest();
});
