<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PendaftaranController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register', [
            'title' => 'Pendaftaran Anggota Baru',
            'description' => 'Silakan isi formulir pendaftaran untuk menjadi anggota HMIF.',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // USERS table
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'username' => 'nullable|string|max:255|unique:users,username',
            'nim' => 'required|string|max:20|unique:users,nim',
            'prodi' => 'required|string|max:100',
            'angkatan' => 'required|string|max:10',
            'telepon' => 'required|string|max:20',
            'instagram' => 'nullable|string|max:100|unique:users,instagram',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'foto' => 'required|image|max:5120|mimes:jpeg,jpg',
            'terms' => 'accepted',

            // MEMBER_REGISTRATIONS table
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',

            'motivasi' => 'required|string',
            'harapan' => 'required|string',
            'bagi_waktu' => 'required|string',
            'kontribusi' => 'required|string|in:Ya,Tidak,Masih mempertimbangkan',

            'minat' => 'required|array|min:1',
            'minat_lainnya' => 'nullable|string|max:255',
            'pengalaman_organisasi' => 'required|string',
            'divisi' => 'required|string|max:100',

            'link_portofolio' => 'nullable|url',
            'file_portofolio' => 'nullable|file|max:10240',
            'skill' => 'nullable|string|max:255',

            'ide' => 'required|string',
            'solusi' => 'required|string',
        ]);

        // Konversi nomor WA jika pakai awalan 08
        $telepon = $validated['telepon'];
        if (Str::startsWith($telepon, '08')) {
            $telepon = '62' . substr($telepon, 1);
        }

        $validated['username'] = $validated['username'] ?? explode('@', $validated['email'])[0];

        // Simpan foto profil
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto', 'public');
        }

        // Simpan user
        $user = User::create([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'angkatan' => $validated['angkatan'],
            'telepon' => $telepon,
            'instagram' => $validated['instagram'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'foto' => $validated['foto'],
            'password' => Hash::make($validated['password']),
        ]);

        // Simpan file portofolio jika ada
        $filePorto = null;
        if ($request->hasFile('file_portofolio')) {
            $filePorto = $request->file('file_portofolio')->store('portofolio', 'public');
        }

        // Simpan member registration
        $user->memberRegistration()->create([
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'agama' => $validated['agama'],
            'alamat' => $validated['alamat'],
            'motivasi' => $validated['motivasi'],
            'harapan' => $validated['harapan'],
            'bagi_waktu' => $validated['bagi_waktu'],
            'kontribusi' => $validated['kontribusi'],
            'minat' => json_encode($validated['minat']),
            'minat_lainnya' => $validated['minat_lainnya'] ?? null,
            'pengalaman_organisasi' => $validated['pengalaman_organisasi'],
            'divisi' => $validated['divisi'],
            'link_portofolio' => $validated['link_portofolio'] ?? null,
            'file_portofolio' => $filePorto,
            'skill' => $validated['skill'] ?? null,
            'ide' => $validated['ide'],
            'solusi' => $validated['solusi'],
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->nama . '!');
    }
}
