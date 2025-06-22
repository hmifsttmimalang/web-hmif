<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return inertia('EditProfil', [
            'currentUser' => Auth::user(),
        ]);
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user) {
            return back()->withErrors(['auth' => 'User tidak ditemukan atau belum login.']);
        }

        $rules = [
            'nama' => 'sometimes|required|string|max:255',
            'tempat_lahir' => 'sometimes|required|string|max:255',
            'tanggal_lahir' => 'sometimes|required|date',
            'jenis_kelamin' => 'sometimes|required|in:L,P',
            'agama' => 'sometimes|required|string|max:255',
            'alamat' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:users,email,' . $user->id,
            'telepon' => 'sometimes|required|string|max:20',
            'foto' => 'nullable|image|max:5120',
        ];

        if ($request->input('password') === null || $request->input('password') === '') {
            $request->request->remove('password');
        }
        if ($request->filled('password')) {
            $rules['password'] = ['confirmed', 'min:8'];
        }

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            if (isset($data['password'])) {
                unset($data['password']);
            }
        }

        if ($request->hasFile('foto')) {
            if ($user->foto && $user->foto !== 'default.jpg') {
                Storage::disk('public')->delete('foto/' . $user->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        if (empty($data['foto'])) {
            unset($data['foto']);
        }

        $allowedFields = [
            'nama',
            'tempat_lahir',
            'tanggal_lahir',
            'jenis_kelamin',
            'agama',
            'alamat',
            'email',
            'telepon',
            'foto',
            'password'
        ];
        $filteredData = array_intersect_key($data, array_flip($allowedFields));

        try {
            $user->fill($filteredData);
            $user->save();
            $user->refresh();

            return back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui profil: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'data' => $filteredData,
            ]);
            return back()->withErrors(['update' => 'Gagal memperbarui profil.']);
        }
    }
}
