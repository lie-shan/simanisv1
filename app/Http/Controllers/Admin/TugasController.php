<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function index()
    {
        $records = Tugas::with(['kelasRelasi', 'mataPelajaranRelasi'])->orderBy('tanggal_dibuat', 'desc')->get()->map(function ($t) {
            $pengumpul = PengumpulanTugas::where('tugas_id', $t->id)->count();
            $t->setAttribute('total_santri', $pengumpul);
            $t->setAttribute('pengumpul', $pengumpul);
            return $t;
        });

        $totalAktif = $records->where('status', 'Aktif')->count();
        $totalSelesai = $records->where('status', 'Selesai')->count();
        $deadlineHariIni = $records->filter(function ($t) {
            return $t->tanggal_deadline && $t->tanggal_deadline->isToday();
        })->count();

        return view('admin.tugas', compact('records', 'totalAktif', 'totalSelesai', 'deadlineHariIni'));
    }

    public function detail($id)
    {
        $pengumpul = PengumpulanTugas::where('tugas_id', $id)->get()->map(function ($p, $i) {
            return [
                'id' => $p->id,
                'nama' => 'Pengumpulan #' . ($i + 1),
                'status' => $p->created_at ? 'tepat' : 'belum',
                'tipe' => $p->file ? 'upload' : ($p->jawaban ? 'tulis' : '-'),
                'konten' => $p->jawaban ?? $p->file ?? '-',
                'tanggal' => $p->created_at ? $p->created_at->format('Y-m-d') : '-',
            ];
        });

        return response()->json(['success' => true, 'data' => $pengumpul]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'kelas' => 'nullable|string|max:20',
            'mapel' => 'required|string|max:100',
            'tanggal_deadline' => 'required|date',
            'status' => 'nullable|in:Aktif,Selesai',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $validated['tanggal_dibuat'] = now()->format('Y-m-d');

        if ($request->hasFile('file')) {
            $validated['lampiran'] = $request->file('file')->store('tugas-lampiran', 'public');
        }

        $tugas = Tugas::create($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $tugas]);
        }

        return redirect()->route('admin.tugas')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Tugas $tugas)
    {
        return response()->json($tugas);
    }

    public function update(Request $request, Tugas $tugas)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:200',
            'deskripsi' => 'nullable|string',
            'kelas' => 'nullable|string|max:20',
            'mapel' => 'required|string|max:100',
            'tanggal_deadline' => 'required|date',
            'status' => 'nullable|in:Aktif,Selesai',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($tugas->lampiran) {
                Storage::disk('public')->delete($tugas->lampiran);
            }
            $validated['lampiran'] = $request->file('file')->store('tugas-lampiran', 'public');
        } elseif ($request->has('hapus_lampiran')) {
            if ($tugas->lampiran) {
                Storage::disk('public')->delete($tugas->lampiran);
            }
            $validated['lampiran'] = null;
        }

        $tugas->update($validated);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $tugas]);
        }

        return redirect()->route('admin.tugas')->with('success', 'Tugas berhasil diupdate.');
    }

    public function destroy(Tugas $tugas)
    {
        if ($tugas->lampiran) {
            Storage::disk('public')->delete($tugas->lampiran);
        }
        $tugas->delete();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.tugas')->with('success', 'Tugas berhasil dihapus.');
    }

    public function kerjakan($id)
    {
        $record = Tugas::with(['kelasRelasi', 'mataPelajaranRelasi'])->findOrFail($id);
        return view('admin.tugas-kerjakan', compact('record'));
    }

    public function submitJawaban(Request $request, $id)
    {
        $request->validate([
            'jawaban' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $tugas = Tugas::findOrFail($id);

        $data = ['tugas_id' => $id];

        if ($request->filled('jawaban')) {
            $data['jawaban'] = $request->jawaban;
        }

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('tugas-submissions', 'public');
        }

        PengumpulanTugas::create($data);

        return response()->json(['success' => true, 'message' => 'Jawaban berhasil dikumpulkan.']);
    }

    public function export()
    {
        $records = Tugas::with(['kelasRelasi', 'mataPelajaranRelasi'])->orderBy('tanggal_dibuat', 'desc')->get();

        $totalAktif = $records->where('status', 'Aktif')->count();
        $totalSelesai = $records->where('status', 'Selesai')->count();
        $deadlineHariIni = $records->filter(function ($t) {
            return $t->tanggal_deadline && $t->tanggal_deadline->isToday();
        })->count();

        return view('admin.tugas-print', compact('records', 'totalAktif', 'totalSelesai', 'deadlineHariIni'));
    }
}
