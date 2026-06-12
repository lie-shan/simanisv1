<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranPekani;
use Illuminate\Http\Request;

class PekaniController extends Controller
{
    public function index()
    {
        $pendaftar = PendaftaranPekani::latest()->get();

        $totalPendaftar = $pendaftar->count();
        $diterima = $pendaftar->where('status', 'Diterima')->count();
        $ditolak = $pendaftar->where('status', 'Ditolak')->count();

        return view('admin.pekani', compact('pendaftar', 'totalPendaftar', 'diterima', 'ditolak'));
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
            $validated['foto'] = $request->file('foto')->store('pekani-foto', 'public');
        }

        $prefix = 'PPKNI-';
        $lastNo = PendaftaranPekani::where('no_pendaftaran', 'like', $prefix . now()->format('dmY') . '%')->max('no_pendaftaran');
        $lastNum = $lastNo ? (int) substr($lastNo, -3) : 0;
        $validated['no_pendaftaran'] = $prefix . now()->format('dmY') . str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);

        $pendaftaran = PendaftaranPekani::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $pendaftaran]);
        }

        return redirect()->route('admin.pekani')->with('success', 'Pendaftar berhasil ditambahkan.');
    }

    public function edit(PendaftaranPekani $pendaftaranPekani)
    {
        return response()->json($pendaftaranPekani);
    }

    public function update(Request $request, PendaftaranPekani $pendaftaranPekani)
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
            $validated['foto'] = $request->file('foto')->store('pekani-foto', 'public');
        }

        $pendaftaranPekani->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $pendaftaranPekani]);
        }

        return redirect()->route('admin.pekani')->with('success', 'Pendaftar berhasil diupdate.');
    }

    public function destroy(PendaftaranPekani $pendaftaranPekani)
    {
        $pendaftaranPekani->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.pekani')->with('success', 'Pendaftar berhasil dihapus.');
    }

    public function export()
    {
        $pendaftar = PendaftaranPekani::latest()->get();

        $totalPendaftar = $pendaftar->count();
        $diterima = $pendaftar->where('status', 'Diterima')->count();
        $ditolak = $pendaftar->where('status', 'Ditolak')->count();

        return view('admin.pekani-print', compact('pendaftar', 'totalPendaftar', 'diterima', 'ditolak'));
    }
}
