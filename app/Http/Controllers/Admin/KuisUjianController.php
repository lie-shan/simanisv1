<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JawabanKuis;
use App\Models\KuisUjian;
use App\Models\MataPelajaran;
use App\Models\SoalKuis;
use Illuminate\Http\Request;

class KuisUjianController extends Controller
{
    public function index()
    {
        $records = KuisUjian::with(['kelasRelasi', 'mataPelajaranRelasi'])->orderBy('tanggal', 'desc')->get();
        $mapelList = MataPelajaran::where('status', 'Aktif')->orderBy('nama_mapel')->get();

        $totalRecord = $records->count();
        $totalKuis = $records->where('jenis', 'Kuis')->count();
        $totalUjian = $records->where('jenis', 'Ujian')->count();
        $selesai = $records->where('status', 'Selesai')->count();

        return view('admin.kuis-ujian', compact('records', 'totalRecord', 'totalKuis', 'totalUjian', 'selesai', 'mapelList'));
    }

    public function export()
    {
        $records = KuisUjian::with(['kelasRelasi', 'mataPelajaranRelasi'])->orderBy('tanggal', 'desc')->get();

        $totalRecord = $records->count();
        $totalKuis = $records->where('jenis', 'Kuis')->count();
        $totalUjian = $records->where('jenis', 'Ujian')->count();
        $selesai = $records->where('status', 'Selesai')->count();

        return view('admin.kuis-ujian-print', compact('records', 'totalRecord', 'totalKuis', 'totalUjian', 'selesai'));
    }

    private function mapSoal($soalList)
    {
        return $soalList->map(function ($s) {
            $item = [
                'id' => $s->id,
                'soal' => $s->pertanyaan,
                'tipe' => $s->tipe ?? 'pg',
                'a' => $s->pilihan_a,
                'b' => $s->pilihan_b,
                'c' => $s->pilihan_c,
                'd' => $s->pilihan_d,
                'kunci' => $s->jawaban_benar,
                'jawaban' => $s->jawaban_essay,
            ];
            return (object) $item;
        })->values();
    }

    public function soal($id)
    {
        $record = KuisUjian::with(['kelasRelasi', 'mataPelajaranRelasi'])->findOrFail($id);
        $soalList = $this->mapSoal(SoalKuis::where('kuis_ujian_id', $id)->get());
        return view('admin.kuis-ujian-soal', compact('record', 'soalList'));
    }

    public function kerjakan($id)
    {
        $record = KuisUjian::with(['kelasRelasi', 'mataPelajaranRelasi'])->findOrFail($id);
        $soalList = $this->mapSoal(SoalKuis::where('kuis_ujian_id', $id)->get());
        return view('admin.kuis-ujian-kerjakan', compact('record', 'soalList'));
    }

    public function koreksi($id)
    {
        $record = KuisUjian::with(['kelasRelasi', 'mataPelajaranRelasi'])->findOrFail($id);
        $soalList = $this->mapSoal(SoalKuis::where('kuis_ujian_id', $id)->get());
        $jawabanList = JawabanKuis::where('kuis_ujian_id', $id)->get();
        $siswaList = $jawabanList->map(function ($j, $i) {
            return (object) ['id' => $j->id, 'nama' => 'Pengumpulan #' . ($i + 1), 'nis' => '-'];
        })->values()->toArray();
        $jawabanSiswa = $jawabanList->map(function ($j) use ($soalList) {
            return $soalList->map(function ($s) use ($j, $soalList) {
                $jawabanArr = $j->jawaban ?? [];
                $nilaiArr = $j->nilai ?? [];
                $soalId = $s->id;
                $key = array_search($soalId, array_column($soalList->toArray(), 'id'));
                $jawaban = $jawabanArr[$key] ?? null;
                $nilai = $nilaiArr[$key] ?? null;
                return ['soal_id' => $soalId, 'jawaban' => $jawaban, 'nilai' => $nilai];
            })->toArray();
        })->toArray();
        $essayCount = $soalList->filter(fn($s) => ($s->tipe ?? 'pg') === 'essay')->count();
        return view('admin.kuis-ujian-koreksi', compact('record', 'soalList', 'siswaList', 'essayCount', 'jawabanSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|string|in:Kuis,Ujian',
            'kelas' => 'nullable|string|max:50',
            'mapel' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'durasi' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'status' => 'required|string|in:Akan Datang,Sedang Berlangsung,Selesai',
        ]);

        $record = KuisUjian::create($request->only(['judul', 'jenis', 'kelas', 'mapel', 'tanggal', 'durasi', 'keterangan', 'status']));

        return response()->json(['success' => true, 'data' => $record]);
    }

    public function edit(KuisUjian $kuisUjian)
    {
        return response()->json($kuisUjian);
    }

    public function update(Request $request, KuisUjian $kuisUjian)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'jenis' => 'required|string|in:Kuis,Ujian',
            'kelas' => 'nullable|string|max:50',
            'mapel' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'durasi' => 'nullable|numeric',
            'keterangan' => 'nullable|string',
            'status' => 'required|string|in:Akan Datang,Sedang Berlangsung,Selesai',
        ]);

        $kuisUjian->update($request->only(['judul', 'jenis', 'kelas', 'mapel', 'tanggal', 'durasi', 'keterangan', 'status']));

        return response()->json(['success' => true, 'data' => $kuisUjian]);
    }

    public function destroy(Request $request, KuisUjian $kuisUjian)
    {
        $kuisUjian->delete();
        return response()->json(['success' => true]);
    }

    public function storeSoal(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|in:pg,essay',
            'pilihan_a' => 'required_if:tipe,pg|nullable|string',
            'pilihan_b' => 'required_if:tipe,pg|nullable|string',
            'pilihan_c' => 'nullable|string',
            'pilihan_d' => 'nullable|string',
            'jawaban_benar' => 'required_if:tipe,pg|nullable|string',
            'jawaban_essay' => 'required_if:tipe,essay|nullable|string',
        ]);

        $soal = SoalKuis::create([
            'kuis_ujian_id' => $id,
            'pertanyaan' => $request->pertanyaan,
            'tipe' => $request->tipe,
            'pilihan_a' => $request->tipe === 'pg' ? $request->pilihan_a : null,
            'pilihan_b' => $request->tipe === 'pg' ? $request->pilihan_b : null,
            'pilihan_c' => $request->tipe === 'pg' ? $request->pilihan_c : null,
            'pilihan_d' => $request->tipe === 'pg' ? $request->pilihan_d : null,
            'jawaban_benar' => $request->tipe === 'pg' ? $request->jawaban_benar : null,
            'jawaban_essay' => $request->tipe === 'essay' ? $request->jawaban_essay : null,
        ]);

        return response()->json(['success' => true, 'data' => $soal]);
    }

    public function updateSoal(Request $request, SoalKuis $soalKuis)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|in:pg,essay',
            'pilihan_a' => 'required_if:tipe,pg|nullable|string',
            'pilihan_b' => 'required_if:tipe,pg|nullable|string',
            'pilihan_c' => 'nullable|string',
            'pilihan_d' => 'nullable|string',
            'jawaban_benar' => 'required_if:tipe,pg|nullable|string',
            'jawaban_essay' => 'required_if:tipe,essay|nullable|string',
        ]);

        $soalKuis->update([
            'pertanyaan' => $request->pertanyaan,
            'tipe' => $request->tipe,
            'pilihan_a' => $request->tipe === 'pg' ? $request->pilihan_a : null,
            'pilihan_b' => $request->tipe === 'pg' ? $request->pilihan_b : null,
            'pilihan_c' => $request->tipe === 'pg' ? $request->pilihan_c : null,
            'pilihan_d' => $request->tipe === 'pg' ? $request->pilihan_d : null,
            'jawaban_benar' => $request->tipe === 'pg' ? $request->jawaban_benar : null,
            'jawaban_essay' => $request->tipe === 'essay' ? $request->jawaban_essay : null,
        ]);

        return response()->json(['success' => true, 'data' => $soalKuis]);
    }

    public function destroySoal(Request $request, SoalKuis $soalKuis)
    {
        $soalKuis->delete();
        return response()->json(['success' => true]);
    }

    public function submitJawaban(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'required|array',
        ]);

        $record = JawabanKuis::create([
            'kuis_ujian_id' => $id,
            'jawaban' => $request->jawaban,
        ]);

        return response()->json(['success' => true, 'data' => $record]);
    }

    public function simpanKoreksi(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|array',
            'siswa_id' => 'required|integer|exists:jawaban_kuis,id',
        ]);

        $jawaban = JawabanKuis::findOrFail($request->siswa_id);
        $jawaban->update([
            'nilai' => $request->nilai,
        ]);

        return response()->json(['success' => true]);
    }
}
