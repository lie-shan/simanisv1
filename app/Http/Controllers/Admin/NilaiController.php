<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Nilai;
use App\Models\Santri;
use App\Models\Setting;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        $nilaiGrouped = Nilai::with(['santri', 'mataPelajaran'])->latest()->get()->groupBy('santri_id');

        $mapelList = MataPelajaran::pluck('nama_mapel', 'id')->values();
        $santriList = Santri::orderBy('nama')->get(['id', 'nama', 'no_registrasi', 'kelas']);

        $records = $nilaiGrouped->map(function ($items, $santriId) {
            $first = $items->first();
            $nilaiMapel = $items->first()->nilai_mapel ?? [];
            $scores = array_values($nilaiMapel);
            $rataRata = count($scores) > 0 ? round(array_sum($scores) / count($scores), 2) : 0;
            $status = $rataRata >= 70 ? 'Lulus' : 'Tidak Lulus';

            return (object) [
                'id' => $first->id,
                'nama_santri' => $first->santri->nama ?? 'Santri #'.$santriId,
                'no_registrasi' => $first->santri->no_registrasi ?? '-',
                'kelas' => $first->kelas ?? '-',
                'semester' => $first->semester,
                'tahun_ajaran' => $first->tahun_ajaran,
                'nilai_mapel' => $nilaiMapel,
                'rata_rata' => $rataRata,
                'status' => $status,
            ];
        })->values();

        $rataRataKeseluruhan = $records->avg('rata_rata') ?: 0;
        $nilaiTertinggi = $records->max('rata_rata') ?: 0;
        $nilaiTerendah = $records->min('rata_rata') ?: 0;
        $totalLulus = $records->where('status', 'Lulus')->count();
        $totalTidakLulus = $records->where('status', 'Tidak Lulus')->count();

        $tahunAjaran = Setting::getValue('academic_year', '2025/2026');
        $semester = Setting::getValue('academic_semester', 'Ganjil');

        return view('admin.nilai', compact('records', 'mapelList', 'rataRataKeseluruhan', 'nilaiTertinggi', 'nilaiTerendah', 'totalLulus', 'totalTidakLulus', 'santriList', 'tahunAjaran', 'semester'));
    }

    public function export()
    {
        $records = Nilai::with(['santri', 'mataPelajaran'])->latest()->get()->groupBy('santri_id');

        $mapelList = MataPelajaran::pluck('nama_mapel', 'id')->values();

        $records = $records->map(function ($items, $santriId) {
            $first = $items->first();
            $nilaiMapel = $items->first()->nilai_mapel ?? [];
            $scores = array_values($nilaiMapel);
            $rataRata = count($scores) > 0 ? round(array_sum($scores) / count($scores), 2) : 0;
            $status = $rataRata >= 70 ? 'Lulus' : 'Tidak Lulus';

            return (object) [
                'id' => $first->id,
                'nama_santri' => $first->santri->nama ?? 'Santri #'.$santriId,
                'no_registrasi' => $first->santri->no_registrasi ?? '-',
                'kelas' => $first->kelas ?? '-',
                'semester' => $first->semester,
                'tahun_ajaran' => $first->tahun_ajaran,
                'nilai_mapel' => $nilaiMapel,
                'rata_rata' => $rataRata,
                'status' => $status,
            ];
        })->values();

        $rataRataKeseluruhan = $records->avg('rata_rata') ?: 0;
        $nilaiTertinggi = $records->max('rata_rata') ?: 0;
        $nilaiTerendah = $records->min('rata_rata') ?: 0;
        $totalLulus = $records->where('status', 'Lulus')->count();
        $totalTidakLulus = $records->where('status', 'Tidak Lulus')->count();

        return view('admin.nilai-print', compact('records', 'mapelList', 'rataRataKeseluruhan', 'nilaiTertinggi', 'nilaiTerendah', 'totalLulus', 'totalTidakLulus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_santri' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'semester' => 'required|string|max:20',
            'tahun_ajaran' => 'required|string|max:20',
            'nilai_mapel' => 'required|array',
            'keterangan' => 'nullable|string',
        ]);

        $scores = array_values($request->nilai_mapel);
        $rataRata = count($scores) > 0 ? round(array_sum($scores) / count($scores), 2) : 0;
        $status = $rataRata >= 70 ? 'Lulus' : ($rataRata >= 50 ? 'Cadangan' : 'Tidak Lulus');

        $nilai = Nilai::create([
            'nama_santri' => $request->nama_santri,
            'nis' => $request->no_registrasi ?: null,
            'kelas' => $request->kelas,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_mapel' => $request->nilai_mapel,
            'rata_rata' => $rataRata,
            'status' => $status,
            'keterangan' => $request->keterangan,
            'santri_id' => $request->santri_id ?: null,
        ]);

        return response()->json(['success' => true, 'data' => $nilai]);
    }

    public function edit(Nilai $nilai)
    {
        $nilai->load('santri', 'mataPelajaran');
        return response()->json([
            'id' => $nilai->id,
            'nama_santri' => $nilai->santri->nama ?? $nilai->nama_santri,
            'no_registrasi' => $nilai->santri->no_registrasi ?? $nilai->nis,
            'kelas' => $nilai->kelas,
            'semester' => $nilai->semester,
            'tahun_ajaran' => $nilai->tahun_ajaran,
            'nilai_mapel' => $nilai->nilai_mapel,
            'rata_rata' => $nilai->rata_rata,
            'status' => $nilai->status,
            'keterangan' => $nilai->keterangan,
            'santri_id' => $nilai->santri_id,
        ]);
    }

    public function update(Request $request, Nilai $nilai)
    {
        $request->validate([
            'nama_santri' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'semester' => 'required|string|max:20',
            'tahun_ajaran' => 'required|string|max:20',
            'nilai_mapel' => 'required|array',
            'keterangan' => 'nullable|string',
        ]);

        $scores = array_values($request->nilai_mapel);
        $rataRata = count($scores) > 0 ? round(array_sum($scores) / count($scores), 2) : 0;
        $status = $rataRata >= 70 ? 'Lulus' : ($rataRata >= 50 ? 'Cadangan' : 'Tidak Lulus');

        $nilai->update([
            'nama_santri' => $request->nama_santri,
            'nis' => $request->no_registrasi ?: null,
            'kelas' => $request->kelas,
            'semester' => $request->semester,
            'tahun_ajaran' => $request->tahun_ajaran,
            'nilai_mapel' => $request->nilai_mapel,
            'rata_rata' => $rataRata,
            'status' => $status,
            'keterangan' => $request->keterangan,
            'santri_id' => $request->santri_id ?: null,
        ]);

        return response()->json(['success' => true, 'data' => $nilai]);
    }

    public function destroy(Request $request, Nilai $nilai)
    {
        $nilai->delete();
        return response()->json(['success' => true]);
    }

    public function rapor($id)
    {
        $santri = Nilai::with('santri', 'mataPelajaran')->findOrFail($id);
        $mapelList = MataPelajaran::pluck('nama_mapel', 'id')->values();
        return view('admin.nilai-rapor', compact('santri', 'mapelList'));
    }
}
