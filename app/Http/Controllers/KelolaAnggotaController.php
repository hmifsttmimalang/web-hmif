<?php

namespace App\Http\Controllers;

use App\Exports\AnggotaExport;
use App\Imports\AnggotaImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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

    public function export(): BinaryFileResponse
    {
        return Excel::download(new AnggotaExport, 'data_anggota.xlsx');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $loginUser = Auth::user();
        $previousStatus = $user->status;
        $newStatus = $request->status;

        $user->status = $newStatus;

        if (
            $previousStatus === 'Baru' &&
            $newStatus === 'Aktif' &&
            empty($request->jabatan)
        ) {
            $user->jabatan = 'Anggota';
        }

        if (
            in_array($loginUser->role, ['admin', 'superadmin']) &&
            $request->filled('jabatan')
        ) {
            $user->jabatan = $request->jabatan;
        }

        if (in_array($newStatus, ['Demisioner', 'Nonaktif'])) {
            $user->jabatan = null;

            if ($user->role !== 'superadmin') {
                $user->role = 'user';
            }
        }

        if (
            $loginUser->role === 'superadmin' &&
            $request->filled('role')
        ) {
            $requestedRole = $request->role;

            if (
                $requestedRole === 'admin' &&
                $user->status === 'Aktif' &&
                $user->jabatan === 'Anggota'
            ) {
                return back()->with('error', 'Tidak bisa menjadikan anggota biasa sebagai admin. Ubah jabatannya terlebih dahulu.');
            }

            $user->role = $requestedRole;
        }

        $user->save();

        return redirect()
            ->route('admin.kelola-data')
            ->with('success', 'Data anggota diupdate!');
    }

    public function destroy(User $anggota)
    {
        $user = Auth::user();
        if ($user->id === $anggota->id) {
            abort(403, 'Tidak bisa menghapus akun sendiri!');
        }

        if (in_array($anggota->email, ['hmifsttmimalang@gmail.com', 'backupadmin@hmif.com'])) {
            abort(403, 'Tidak boleh hapus akun inti!');
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
