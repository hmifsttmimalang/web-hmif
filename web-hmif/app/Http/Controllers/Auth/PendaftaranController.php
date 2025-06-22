<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        // Validasi semua field
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nim' => 'required|string|max:20|unique:users,nim',
            'prodi' => 'required|string|max:100',
            'angkatan' => 'required|string|max:10',
            'alasan' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'telepon' => 'required|string|max:20',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => 'accepted',
            'foto' => 'nullable|image|max:5120',
        ]);

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        // Buat user baru
        $user = User::create([
            ...$data,
            'password' => Hash::make($data['password']),
        ]);

        // Optional: langsung login
        Auth::login($user);

        // Redirect ke dashboard atau halaman lain
        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->nama . '!');
    }
}
