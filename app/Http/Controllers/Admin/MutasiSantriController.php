<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MutasiSantri;
use App\Models\Santri;
use Illuminate\Http\Request;

class MutasiSantriController extends Controller
{
    public function index()
    {
        $mutasi = MutasiSantri::with('santri')->latest()->get()->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'santri_nama' => $item->santri->nama ?? 'Santri #'.$item->santri_id,
                'kelas_asal' => $item->kelas_asal ?? '-',
                'kelas_tujuan' => $item->kelas_tujuan ?? '-',
                'tgl_mutasi' => $item->tgl_mutasi,
                'alasan' => $item->alasan,
                'keterangan' => $item->keterangan,
            ];
        });

        $totalMutasi = $mutasi->count();
        $mutasiBulanIni = MutasiSantri::whereMonth('tgl_mutasi', now()->month)
            ->whereYear('tgl_mutasi', now()->year)
            ->count();
        $mutasiMasuk = $mutasi->filter(function ($m) { return $m->kelas_tujuan !== 'Keluar'; })->count();
        $mutasiKeluar = $mutasi->where('kelas_tujuan', 'Keluar')->count();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $santri = Santri::where('status', 'Aktif')->orderBy('nama')->get();

        return view('admin.mutasi-santri', compact('mutasi', 'totalMutasi', 'mutasiBulanIni', 'mutasiMasuk', 'mutasiKeluar', 'kelas', 'santri'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'kelas_asal' => 'nullable|string',
            'kelas_tujuan' => 'nullable|string',
            'tgl_mutasi' => 'required|date',
            'alasan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        MutasiSantri::create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $validated]);
        }

        return redirect()->route('admin.mutasi-santri.index')->with('success', 'Data mutasi santri berhasil ditambahkan.');
    }

    public function edit(MutasiSantri $mutasiSantri)
    {
        return response()->json($mutasiSantri);
    }

    public function update(Request $request, MutasiSantri $mutasiSantri)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'kelas_asal' => 'nullable|string',
            'kelas_tujuan' => 'nullable|string',
            'tgl_mutasi' => 'required|date',
            'alasan' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        $mutasiSantri->update($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $mutasiSantri]);
        }

        return redirect()->route('admin.mutasi-santri.index')->with('success', 'Data mutasi santri berhasil diperbarui.');
    }

    public function destroy(Request $request, MutasiSantri $mutasiSantri)
    {
        $mutasiSantri->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.mutasi-santri.index')->with('success', 'Data mutasi santri berhasil dihapus.');
    }
}
