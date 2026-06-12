<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\HafalanTahsin;
use App\Models\Santri;
use Illuminate\Http\Request;

class HafalanTahsinController extends Controller
{
    public function index()
    {
        $records = HafalanTahsin::with(['santriRelasi', 'kelasRelasi', 'guruRelasi'])->orderBy('tanggal', 'desc')->get();
        $santriList = Santri::orderBy('nama')->get();
        $guruList = Guru::orderBy('nama')->get();

        $totalRecord = $records->count();
        $totalHafalan = $records->where('jenis', 'Hafalan')->count();
        $totalTahsin = $records->where('jenis', 'Tahsin')->count();
        $lancar = $records->where('status', 'Lancar')->count();

        return view('admin.hafalan-tahsin', compact('records', 'totalRecord', 'totalHafalan', 'totalTahsin', 'lancar', 'santriList', 'guruList'));
    }

    public function export()
    {
        $records = HafalanTahsin::with(['santriRelasi', 'kelasRelasi', 'guruRelasi'])->orderBy('tanggal', 'desc')->get();

        $totalRecord = $records->count();
        $totalHafalan = $records->where('jenis', 'Hafalan')->count();
        $totalTahsin = $records->where('jenis', 'Tahsin')->count();
        $lancar = $records->where('status', 'Lancar')->count();

        return view('admin.hafalan-tahsin-print', compact('records', 'totalRecord', 'totalHafalan', 'totalTahsin', 'lancar'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'jenis' => 'required|in:Hafalan,Tahsin',
            'surah' => 'required|string|max:255',
            'ayat' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:Lancar,Kurang Lancar,Belum Lancar',
            'tanggal' => 'required|date',
            'pengajar' => 'nullable|string|max:255',
        ]);

        $data = array_merge($validated, [
            'santri_id' => $request->santri_id ?: null,
            'kelas_id' => $request->kelas_id ?: null,
            'guru_id' => $request->guru_id ?: null,
        ]);

        $record = HafalanTahsin::create($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $record]);
        }

        return redirect()->route('admin.hafalan-tahsin.index')->with('success', 'Record berhasil ditambahkan.');
    }

    public function edit(HafalanTahsin $hafalanTahsin)
    {
        return response()->json($hafalanTahsin);
    }

    public function update(Request $request, HafalanTahsin $hafalanTahsin)
    {
        $validated = $request->validate([
            'santri' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:255',
            'jenis' => 'required|in:Hafalan,Tahsin',
            'surah' => 'required|string|max:255',
            'ayat' => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:Lancar,Kurang Lancar,Belum Lancar',
            'tanggal' => 'required|date',
            'pengajar' => 'nullable|string|max:255',
        ]);

        $data = array_merge($validated, [
            'santri_id' => $request->santri_id ?: null,
            'kelas_id' => $request->kelas_id ?: null,
            'guru_id' => $request->guru_id ?: null,
        ]);

        $hafalanTahsin->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $hafalanTahsin]);
        }

        return redirect()->route('admin.hafalan-tahsin.index')->with('success', 'Record berhasil diperbarui.');
    }

    public function destroy(Request $request, HafalanTahsin $hafalanTahsin)
    {
        $hafalanTahsin->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.hafalan-tahsin.index')->with('success', 'Record berhasil dihapus.');
    }
}
