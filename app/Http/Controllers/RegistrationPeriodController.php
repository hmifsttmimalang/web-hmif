<?php

namespace App\Http\Controllers;

use App\Models\RegistrationPeriod;
use Illuminate\Http\Request;
use Inertia\Inertia;


class RegistrationPeriodController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/PeriodePendaftaran', [
            'periods' => RegistrationPeriod::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
        ]);

        RegistrationPeriod::create([
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'is_active' => true,
        ]);

        return redirect()->route('admin.periode.index')->with('success', 'Periode pendaftaran ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'start_at' => 'required|date',
            'end_at' => 'required|date|after:start_at',
            'is_active' => 'required|boolean',
        ]);

        $periode = RegistrationPeriod::findOrFail($id);
        $periode->update($request->only('start_at', 'end_at', 'is_active'));

        return back()->with('success', 'Periode berhasil diperbarui.');
    }

    public function destroy($id)
    {
        RegistrationPeriod::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Periode dihapus.');
    }
}
