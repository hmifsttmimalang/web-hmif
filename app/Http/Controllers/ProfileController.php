<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profil dengan data user dan relasinya.
     */
    public function edit()
    {
        $user = User::with('memberRegistration')->findOrFail(Auth::id());

        return inertia('EditProfil', [
            'currentUser' => $user,
        ]);
    }

    /**
     * Perbarui data profil user yang sedang login.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return back()->withErrors(['auth' => 'User tidak ditemukan atau belum login.']);
        }
        
        // Validasi input utama user
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'telepon' => 'required|string|max:100',
            'foto' => 'nullable|image|max:5120',
            'password' => 'nullable|confirmed|min:8',
        ]);

        // Format nomor telepon ke wa.me
        if (!empty($validated['telepon'])) {
            $nomor = preg_replace('/\D/', '', $validated['telepon']);
            if (str_starts_with($nomor, '0')) {
                $nomor = '62' . substr($nomor, 1);
            } elseif (str_starts_with($nomor, '+62')) {
                $nomor = substr($nomor, 1);
            }
            $validated['telepon'] = 'https://wa.me/' . $nomor;
        }
        
        // Hash password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle upload foto profil
        if ($request->hasFile('foto')) {
            if ($user->foto && $user->foto !== 'foto/default.jpg') {
                Storage::disk('public')->delete($user->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto', 'public');
        }
        
        /** @var \App\Models\User $user */
        $user->update($validated);

        // Update ke tabel member_registration (jika bukan superadmin)
        if ($user->role !== 'superadmin') {
            $user->memberRegistration()->updateOrCreate(
                ['user_id' => $user->id],
                $request->only([
                    'tempat_lahir',
                    'tanggal_lahir',
                    'jenis_kelamin',
                    'agama',
                    'alamat',
                ])
            );
        }

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
