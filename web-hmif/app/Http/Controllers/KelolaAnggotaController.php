<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class KelolaAnggotaController extends Controller
{
    public function index()
    {
        $anggota = User::orderBy('created_at', 'desc')
            ->where('role', '!=', 'superadmin')
            ->get([
                'id',
                'nim',
                'nama',
                'prodi',
                'angkatan',
                'jabatan',
                'status',
                'role'
            ]);

        return Inertia::render('Admin/KelolaData', [
            'anggota' => $anggota,
            'currentUser' => Auth::user(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->jabatan = $request->jabatan;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.kelola-data')->with('success', 'Data anggota diupdate!');
    }

    public function destroy(User $anggota)
    {
        $user = Auth::user();
        if ($user->id === $anggota->id) {
            abort(403, 'Tidak bisa menghapus akun sendiri!');
        }

        if (
            ($user->role === 'superadmin') ||
            ($user->role === 'admin' && $anggota->role === 'user')
        ) {
            $anggota->delete();
            return redirect()->route('admin.kelola-data')->with('success', 'Anggota dihapus');
        }
        abort(403, 'Akses tidak diizinkan!');
    }
}
