<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $kelas = Kelas::latest()->get();
        $guru = Guru::orderBy('nama')->get();
        $mapel = MataPelajaran::where('status', 'Aktif')->get();

        $kelasTerpilih = request('kelas', $kelas->isNotEmpty() ? $kelas->first()->nama_kelas : null);
        $kelasId = $kelas->where('nama_kelas', $kelasTerpilih)->first()?->id;

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $kategoriMapel = MataPelajaran::whereNotNull('kategori')
            ->select('kategori')
            ->distinct()
            ->where('status', 'Aktif')
            ->get()
            ->pluck('kategori');

        $kategoriColors = [];
        $katPalette = ['#667eea','#f093fb','#4facfe','#43e97b','#fa709a','#a18cd1','#fccb90','#e0c3fc','#84fab0','#a8edea'];
        foreach ($kategoriMapel as $i => $kat) {
            $kategoriColors[$kat] = $katPalette[$i % count($katPalette)];
        }

        $jadwal = [];
        $allJamKe = [];
        if ($kelasId && $kelasTerpilih) {
            $records = Jadwal::with('guru', 'mataPelajaran')
                ->where('kelas_id', $kelasId)
                ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
                ->orderBy('jam_ke')
                ->get();

            foreach ($records as $r) {
                $kat = $r->mataPelajaran->kategori ?? null;
                $jadwal[$r->hari][$r->jam_ke] = [
                    'id' => $r->id,
                    'jam_ke' => $r->jam_ke,
                    'mulai' => $r->jam_mulai,
                    'selesai' => $r->jam_selesai,
                    'mapel' => $r->mataPelajaran->nama_mapel ?? '-',
                    'guru' => $r->guru->nama ?? '-',
                    'warna' => $kat ? ($kategoriColors[$kat] ?? '#667eea') : '#667eea',
                    'kelas' => $kelasTerpilih,
                ];
                $allJamKe[] = $r->jam_ke;
            }
            $allJamKe = array_unique($allJamKe);
            sort($allJamKe);
        }

        $data = [
            'total_mapel' => $mapel->count(),
            'total_guru' => $guru->count(),
            'total_jam' => count($allJamKe) ?: 0,
            'total_kelas' => $kelas->count(),
        ];

        return view('admin.jadwal', compact('data', 'allJamKe', 'hari', 'jadwal', 'kelas', 'kelasTerpilih', 'guru', 'mapel', 'kategoriMapel', 'kategoriColors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mapel' => 'required|string',
            'kelas' => 'required|string',
            'guru' => 'required|string',
            'hari' => 'required|string',
            'jam_ke' => 'nullable|integer',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $mapelModel = MataPelajaran::where('nama_mapel', $request->mapel)->firstOrFail();
        $kelasModel = Kelas::where('nama_kelas', $request->kelas)->firstOrFail();
        $guruModel = Guru::where('nama', $request->guru)->firstOrFail();

        $jamKe = $request->jam_ke;
        if (!$jamKe) {
            $maxJamKe = Jadwal::where('kelas_id', $kelasModel->id)
                ->where('hari', $request->hari)
                ->max('jam_ke');
            $jamKe = $maxJamKe ? $maxJamKe + 1 : 1;
        }

        $jadwal = Jadwal::create([
            'kelas_id' => $kelasModel->id,
            'guru_id' => $guruModel->id,
            'mata_pelajaran_id' => $mapelModel->id,
            'hari' => $request->hari,
            'jam_ke' => $jamKe,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return response()->json(['success' => true, 'data' => $jadwal]);
    }

    public function edit(Jadwal $jadwal)
    {
        $jadwal->load('mataPelajaran', 'kelas', 'guru');
        return response()->json([
            'id' => $jadwal->id,
            'mapel' => $jadwal->mataPelajaran->nama_mapel,
            'kelas' => $jadwal->kelas->nama_kelas,
            'guru' => $jadwal->guru->nama,
            'hari' => $jadwal->hari,
            'jam_ke' => $jadwal->jam_ke,
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
        ]);
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'mapel' => 'required|string',
            'kelas' => 'required|string',
            'guru' => 'required|string',
            'hari' => 'required|string',
            'jam_ke' => 'nullable|integer',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $mapelModel = MataPelajaran::where('nama_mapel', $request->mapel)->firstOrFail();
        $kelasModel = Kelas::where('nama_kelas', $request->kelas)->firstOrFail();
        $guruModel = Guru::where('nama', $request->guru)->firstOrFail();

        $jamKe = $request->jam_ke;
        if (!$jamKe) {
            $maxJamKe = Jadwal::where('kelas_id', $kelasModel->id)
                ->where('hari', $request->hari)
                ->where('id', '!=', $jadwal->id)
                ->max('jam_ke');
            $jamKe = $maxJamKe ? $maxJamKe + 1 : 1;
        }

        $jadwal->update([
            'kelas_id' => $kelasModel->id,
            'guru_id' => $guruModel->id,
            'mata_pelajaran_id' => $mapelModel->id,
            'hari' => $request->hari,
            'jam_ke' => $jamKe,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);

        return response()->json(['success' => true, 'data' => $jadwal]);
    }

    public function destroy(Request $request, Jadwal $jadwal)
    {
        $jadwal->delete();
        return response()->json(['success' => true]);
    }
}
