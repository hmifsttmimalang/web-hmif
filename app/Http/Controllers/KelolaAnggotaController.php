<?php

namespace App\Http\Controllers;

use App\Imports\AnggotaImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
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

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv|max:2048',
        ]);

        try {
            Excel::import(new AnggotaImport, $request->file('file'));
            return back()->with('success', 'Import data anggota berhasil!');
        } catch (\Exception $e) {
            return back()->withErrors(['import' => 'Import gagal: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $loginUser = Auth::user();

        $user->jabatan = $request->jabatan;
        $user->status = $request->status;

        if (in_array($request->status, ['Demisioner', 'Nonaktif'])) {
            $user->jabatan = null;
        }

        if ($request->status == 'Aktif') {
            $user->jabatan = 'Anggota';
        }

        if ($loginUser->role === 'superadmin' && $request->has('role')) {
            $user->role = $request->role;
        }

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
