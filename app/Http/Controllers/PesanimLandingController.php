<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PesanimLandingController extends Controller
{
    public function create()
    {
        return view('pesanim');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'required|string|max:50',
            'tgl_lahir' => 'required|date',
            'ortu' => 'required|string|max:100',
            'ibu' => 'required|string|max:100',
            'no_hp' => 'required|string|max:20',
            'kampung' => 'required|string|max:200',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pendaftaran-foto', 'public');
        }

        $parsed = $this->parseAlamat($validated['kampung'] ?? '');
        $validated['kampung'] = $parsed['kampung'];
        $validated['rt_rw'] = $parsed['rt_rw'];
        $validated['desa'] = $parsed['desa'];
        $validated['kecamatan'] = $parsed['kecamatan'];
        $validated['kabupaten'] = $parsed['kabupaten'];
        $validated['kode_pos'] = $parsed['kode_pos'];

        $existing = Pendaftaran::where('nama', $validated['nama'])
            ->where('tmp_lahir', $validated['tmp_lahir'])
            ->where('tgl_lahir', $validated['tgl_lahir'])
            ->first();

        if ($existing) {
            return redirect()->route('pesanim')
                ->with('error', 'Data anda sudah ada! No. Pendaftaran: ' . $existing->no_pendaftaran);
        }

        $prefix = 'PSBNI-';
        $lastNo = Pendaftaran::where('no_pendaftaran', 'like', $prefix . now()->format('dmY') . '%')->max('no_pendaftaran');
        $lastNum = $lastNo ? (int) substr($lastNo, -3) : 0;
        $validated['no_pendaftaran'] = $prefix . now()->format('dmY') . str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);

        $pendaftaran = Pendaftaran::create($validated);

        return redirect()->route('pesanim')
            ->with('success', 'Pendaftaran berhasil! No. Pendaftaran: ' . $pendaftaran->no_pendaftaran);
    }

    private function parseAlamat(string $alamat): array
    {
        $result = [
            'kampung' => $alamat,
            'rt_rw' => '',
            'desa' => '',
            'kecamatan' => '',
            'kabupaten' => '',
            'kode_pos' => '',
        ];

        if (empty(trim($alamat))) return $result;

        $sisa = $alamat;

        if (preg_match('/\b(\d{5})\b/', $sisa, $m)) {
            $result['kode_pos'] = $m[1];
            $sisa = str_replace($m[0], '', $sisa);
        }

        if (preg_match('/RT\s*(\d+)\s*\/?\s*RW\s*(\d+)/i', $sisa, $m)) {
            $result['rt_rw'] = $m[1] . '/' . $m[2];
            $sisa = str_replace($m[0], '', $sisa);
        }

        foreach ([
            ['label' => 'kabupaten', 'pola' => '/(?:Kabupaten|Kab\.?|Kota)\s+([^,;]+)/i'],
            ['label' => 'kecamatan', 'pola' => '/(?:Kecamatan|Kec\.?)\s+([^,;]+)/i'],
            ['label' => 'desa', 'pola' => '/(?:Desa|Ds\.?|Kelurahan|Kel\.?)\s+([^,;]+)/i'],
        ] as $item) {
            if (preg_match($item['pola'], $sisa, $m)) {
                $result[$item['label']] = trim($m[1]);
                $sisa = str_replace($m[0], '', $sisa);
            }
        }

        $sisa = preg_replace('/[,;]+/', ' ', $sisa);
        $sisa = preg_replace('/\s+/', ' ', $sisa);
        $result['kampung'] = trim($sisa);

        return $result;
    }
}
