<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Santri;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();
        $mapelList = MataPelajaran::orderBy('nama_mapel')->pluck('nama_mapel');
        $tanggal = $request->tanggal ?? now()->toDateString();
        $kelasDipilih = $request->kelas;

        if ($kelasDipilih) {
            $santri = Santri::where('kelas', $kelasDipilih)
                ->where('status', 'Aktif')
                ->orderBy('nama')
                ->get();
            $absensiHarian = Absensi::whereIn('santri_id', $santri->pluck('id'))
                ->where('tanggal', $tanggal)
                ->get()
                ->keyBy('santri_id');
        } else {
            $santri = collect();
            $absensiHarian = collect();
        }

        $stats = $this->getStats($tanggal);
        $tab = $request->tab ?? 'manual';

        $qrKelasList = Kelas::orderBy('nama_kelas')->get();
        $qrKelas = $request->kelas ?? ($qrKelasList->first()->nama_kelas ?? '');
        $qrSantri = Santri::where('kelas', $qrKelas)->where('status', 'Aktif')->orderBy('nama')->get();

        return view('admin.absensi', compact(
            'kelasList', 'mapelList', 'santri', 'absensiHarian', 'tanggal', 'kelasDipilih',
            'stats', 'tab', 'qrKelasList', 'qrKelas', 'qrSantri'
        ));
    }

    public function filter(Request $request)
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();
        $mapelList = MataPelajaran::orderBy('nama_mapel')->pluck('nama_mapel');
        $tanggal = $request->tanggal ?? now()->toDateString();
        $kelasDipilih = $request->kelas;

        $santri = Santri::where('kelas', $kelasDipilih)
            ->where('status', 'Aktif')
            ->orderBy('nama')
            ->get();

        $absensiHarian = Absensi::whereIn('santri_id', $santri->pluck('id'))
            ->where('tanggal', $tanggal)
            ->get()
            ->keyBy('santri_id');

        $stats = $this->getStats($tanggal);

        $qrKelasList = Kelas::orderBy('nama_kelas')->get();
        $qrKelas = $request->kelas ?? ($qrKelasList->first()->nama_kelas ?? '');
        $qrSantri = Santri::where('kelas', $qrKelas)->where('status', 'Aktif')->orderBy('nama')->get();

        return view('admin.absensi', compact(
            'kelasList', 'mapelList', 'santri', 'absensiHarian', 'tanggal', 'kelasDipilih',
            'stats', 'qrKelasList', 'qrKelas', 'qrSantri'
        ) + ['tab' => 'manual']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelas' => 'required|string|max:10',
            'mapel' => 'nullable|string|max:100',
            'absensi' => 'required|array',
            'absensi.*.status' => 'required|in:hadir,izin,sakit,alpha',
            'absensi.*.keterangan' => 'nullable|string|max:255',
        ]);

        $tanggal = $request->tanggal;
        $kelas = $request->kelas;

        $namaSantri = Santri::whereIn('id', array_keys($request->absensi))->pluck('nama', 'id');

        $grouped = ['hadir' => [], 'izin' => [], 'sakit' => [], 'alpha' => []];

        foreach ($request->absensi as $santriId => $data) {
            Absensi::updateOrCreate(
                ['santri_id' => $santriId, 'tanggal' => $tanggal],
                ['mapel' => $request->mapel, 'status' => $data['status'], 'keterangan' => $data['keterangan'] ?? null]
            );
            if (isset($namaSantri[$santriId])) {
                $grouped[$data['status']][] = $namaSantri[$santriId];
            }
        }

        $tglFormat = \Carbon\Carbon::parse($tanggal)->locale('id')->isoFormat('D MMMM YYYY');

        $total = count($request->absensi);
        $hadir = count($grouped['hadir']);
        $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;

        $emojiH = "\xE2\x9C\x85"; $emojiI = "\xF0\x9F\x93\xA9"; $emojiS = "\xF0\x9F\xA4\x92"; $emojiA = "\xE2\x9D\x8C";
        $labelMap = ['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpha' => 'Alpa'];
        $emojiMap = ['hadir' => $emojiH, 'izin' => $emojiI, 'sakit' => $emojiS, 'alpha' => $emojiA];
        $line = str_repeat('=', 28);

        $msg = "\xF0\x9F\x8E\x93 LAPORAN ABSENSI KELAS \xF0\x9F\x8E\x93\n";
        $msg .= "$line\n";
        $msg .= "\xF0\x9F\x8F\xA2 Kelas     : $kelas\n";
        if ($request->mapel) {
            $msg .= "\xF0\x9F\x93\x9A Mapel     : {$request->mapel}\n";
        }
        $msg .= "\xF0\x9F\x93\x85 Tanggal   : $tglFormat\n";
        $msg .= "\xF0\x9F\x93\x88 Kehadiran : {$persen}%\n";
        $msg .= "$line\n";

        foreach ($labelMap as $key => $label) {
            $list = $grouped[$key];
            if (count($list) > 0) {
                $msg .= "{$emojiMap[$key]} {$label} (" . count($list) . " Santri):\n";
                foreach ($list as $nama) {
                    $msg .= "  - $nama\n";
                }
                $msg .= "\n";
            }
        }

        $msg .= "$line\n";
        $msg .= "Laporan ini dikirim secara otomatis melalui sistem.";

        $phone = Setting::getValue('contact_phone', '');
        $phoneClean = preg_replace('/[^0-9]/', '', $phone);
        if (str_starts_with($phoneClean, '0')) {
            $phoneClean = '62' . substr($phoneClean, 1);
        }
        $waUrl = 'https://wa.me/' . $phoneClean . '?text=' . rawurlencode($msg);

        $fonnteKey = Setting::getValue('fonnte_api_key', '');
        $waTerkirim = false;
        if ($fonnteKey && $phoneClean) {
            try {
                $res = Http::timeout(10)
                    ->withBody(json_encode(['target' => $phoneClean, 'message' => $msg, 'countryCode' => '62']), 'application/json')
                    ->withHeaders(['Authorization' => $fonnteKey])
                    ->post('https://api.fonnte.com/send')
                    ->json();
                $waTerkirim = ($res['status'] ?? false) === true;
            } catch (\Exception $e) {
                // silent — fallback ke wa.me
            }
        }

        return redirect()->route('admin.absensi', ['kelas' => $kelas, 'tanggal' => $tanggal])
            ->with('success', 'Absensi berhasil disimpan')
            ->with('wa_url', $waUrl)
            ->with('wa_terkirim', $waTerkirim);
    }

    public function qr($santriId)
    {
        $tanggal = now()->toDateString();
        $santri = Santri::findOrFail($santriId);

        Absensi::updateOrCreate(
            ['santri_id' => $santriId, 'tanggal' => $tanggal],
            ['status' => 'hadir', 'keterangan' => 'Absen via QR']
        );

        return redirect()->route('admin.absensi')
            ->with('success', 'Absensi ' . $santri->nama . ' berhasil via QR');
    }

    public function recap(Request $request)
    {
        $kelasList = Kelas::orderBy('nama_kelas')->get();
        $tanggalAwal = $request->tanggal_awal ?? now()->startOfMonth()->toDateString();
        $tanggalAkhir = $request->tanggal_akhir ?? now()->toDateString();
        $kelasDipilih = $request->kelas;

        $query = Absensi::with('santri')
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);

        if ($kelasDipilih) {
            $query->whereHas('santri', function ($q) use ($kelasDipilih) {
                $q->where('kelas', $kelasDipilih);
            });
        }

        $absensi = $query->orderBy('tanggal', 'desc')->orderBy('santri_id')->get();

        $stats = $this->getStats(now()->toDateString());

        $qrKelasList = Kelas::orderBy('nama_kelas')->get();
        $qrKelas = $request->kelas ?? ($qrKelasList->first()->nama_kelas ?? '');
        $qrSantri = Santri::where('kelas', $qrKelas)->where('status', 'Aktif')->orderBy('nama')->get();

        $tanggal = now()->toDateString();
        $santri = collect();
        $absensiHarian = collect();

        return view('admin.absensi', compact(
            'kelasList', 'absensi', 'tanggalAwal', 'tanggalAkhir',
            'kelasDipilih', 'stats', 'qrKelasList', 'qrKelas', 'qrSantri',
            'tanggal', 'santri', 'absensiHarian'
        ) + ['tab' => 'recap']);
    }

    private function getStats($tanggal)
    {
        $totalSantriAktif = Santri::where('status', 'Aktif')->count();
        $absensiToday = Absensi::where('tanggal', $tanggal);

        return [
            'total' => $totalSantriAktif,
            'hadir' => (clone $absensiToday)->where('status', 'hadir')->count(),
            'izin' => (clone $absensiToday)->where('status', 'izin')->count(),
            'sakit' => (clone $absensiToday)->where('status', 'sakit')->count(),
            'alpha' => (clone $absensiToday)->where('status', 'alpha')->count(),
            'belum_absen' => $totalSantriAktif - (clone $absensiToday)->count(),
        ];
    }
}
