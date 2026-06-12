<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Santri;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas')->get();
        $totalSantri = Santri::count();
        $totalL = Santri::where('jk', 'L')->count();
        $totalP = Santri::where('jk', 'P')->count();

        $kelasStats = [];
        foreach ($kelas as $k) {
            $count = Santri::where('kelas', $k->nama_kelas)->count();
            $countL = Santri::where('kelas', $k->nama_kelas)->where('jk', 'L')->count();
            $countP = Santri::where('kelas', $k->nama_kelas)->where('jk', 'P')->count();
            $kelasStats[$k->id] = [
                'total' => $count,
                'l' => $countL,
                'p' => $countP,
            ];
        }

        return view('admin.kelas', compact('kelas', 'totalSantri', 'totalL', 'totalP', 'kelasStats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kelas' => 'required|string|max:10|unique:kelas,nama_kelas',
            'wali_kelas' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        Kelas::create($data);

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kelas)
    {
        return response()->json($kelas);
    }

    public function update(Request $request, Kelas $kelas)
    {
        $data = $request->validate([
            'nama_kelas' => 'required|string|max:10|unique:kelas,nama_kelas,' . $kelas->id,
            'wali_kelas' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $kelas->update($data);

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil dihapus');
    }

    public function detail(Kelas $kelas)
    {
        $santri = Santri::where('kelas', $kelas->nama_kelas)->get();
        $guru = $kelas->wali_kelas ? Guru::where('nama', $kelas->wali_kelas)->first() : null;
        return response()->json([
            'kelas' => $kelas,
            'santri' => $santri,
            'guru' => $guru,
            'total' => $santri->count(),
            'l' => $santri->where('jk', 'L')->count(),
            'p' => $santri->where('jk', 'P')->count(),
        ]);
    }
}
