<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'nim' => 'required|numeric|unique:users,nim',
            'prodi' => 'required|string',
            'angkatan' => 'required|string',
            'alasan' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'telepon' => 'required|string',
            'password' => 'required|string|min:6',
            'foto' => 'required|image|max:10240', // Maksimal 10MB
            'terms' => 'accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        // Simpan file
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/foto', 'public');
        }

        // Simpan user
        $user = User::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'alasan' => $request->alasan,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password),
            'foto' => $fotoPath,
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil.',
            'data' => $user
        ], 201);
    }
}
