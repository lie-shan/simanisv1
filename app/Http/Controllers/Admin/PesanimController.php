<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PesanimController extends Controller
{
    public function index()
    {
        $pendaftar = Pendaftaran::latest()->get();

        $totalPendaftar = $pendaftar->count();
        $diterima = $pendaftar->where('status', 'Diterima')->count();
        $ditolak = $pendaftar->where('status', 'Ditolak')->count();

        return view('admin.pesanim', compact('pendaftar', 'totalPendaftar', 'diterima', 'ditolak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'ortu' => 'nullable|string|max:100',
            'ibu' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'kampung' => 'nullable|string|max:100',
            'rt_rw' => 'nullable|string|max:20',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'status' => 'nullable|in:Mendaftar,Diterima,Ditolak',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pendaftaran-foto', 'public');
        }

        $prefix = 'PSBNI-';
        $lastNo = Pendaftaran::where('no_pendaftaran', 'like', $prefix . now()->format('dmY') . '%')->max('no_pendaftaran');
        $lastNum = $lastNo ? (int) substr($lastNo, -3) : 0;
        $validated['no_pendaftaran'] = $prefix . now()->format('dmY') . str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);

        $pendaftaran = Pendaftaran::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $pendaftaran]);
        }

        return redirect()->route('admin.pesanim')->with('success', 'Pendaftar berhasil ditambahkan.');
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        return response()->json($pendaftaran);
    }

    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'ortu' => 'nullable|string|max:100',
            'ibu' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:20',
            'kampung' => 'nullable|string|max:100',
            'rt_rw' => 'nullable|string|max:20',
            'desa' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'status' => 'nullable|in:Mendaftar,Diterima,Ditolak',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pendaftaran-foto', 'public');
        }

        $pendaftaran->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $pendaftaran]);
        }

        return redirect()->route('admin.pesanim')->with('success', 'Pendaftar berhasil diupdate.');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.pesanim')->with('success', 'Pendaftar berhasil dihapus.');
    }

    public function export()
    {
        $pendaftar = Pendaftaran::latest()->get();

        $totalPendaftar = $pendaftar->count();
        $diterima = $pendaftar->where('status', 'Diterima')->count();
        $ditolak = $pendaftar->where('status', 'Ditolak')->count();

        return view('admin.pesanim-print', compact('pendaftar', 'totalPendaftar', 'diterima', 'ditolak'));
    }
}
