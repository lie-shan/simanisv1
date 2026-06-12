<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::orderBy('kode_mapel')->get();

        $totalMapel = $mapel->count();
        $aktif = $mapel->where('status', 'Aktif')->count();
        $nonaktif = $mapel->where('status', 'Tidak Aktif')->count();

        return view('admin.mata-pelajaran', compact('mapel', 'totalMapel', 'aktif', 'nonaktif'));
    }

    public function export()
    {
        $mapel = MataPelajaran::orderBy('kode_mapel')->get();

        $totalMapel = $mapel->count();
        $aktif = $mapel->where('status', 'Aktif')->count();
        $nonaktif = $mapel->where('status', 'Tidak Aktif')->count();

        return view('admin.mata-pelajaran-print', compact('mapel', 'totalMapel', 'aktif', 'nonaktif'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:50|unique:mata_pelajaran,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $mapel = MataPelajaran::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $mapel]);
        }

        return redirect()->route('admin.mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil ditambahkan.');
    }

    public function edit(MataPelajaran $mataPelajaran)
    {
        return response()->json($mataPelajaran);
    }

    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:50|unique:mata_pelajaran,kode_mapel,' . $mataPelajaran->id,
            'nama_mapel' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $mataPelajaran->update($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $mataPelajaran]);
        }

        return redirect()->route('admin.mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Request $request, MataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.mata-pelajaran.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
