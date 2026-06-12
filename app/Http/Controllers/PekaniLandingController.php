<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPekani;
use Illuminate\Http\Request;

class PekaniLandingController extends Controller
{
    public function create()
    {
        return view('pekani');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'jk' => 'required|in:L,P',
            'tmp_lahir' => 'nullable|string|max:50',
            'tgl_lahir' => 'nullable|date',
            'ortu' => 'nullable|string|max:100',
            'ibu' => 'nullable|string|max:100',
            'no_hp' => 'required|string|max:20',
            'kampung' => 'nullable|string|max:200',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pekani-foto', 'public');
        }

        $parsed = $this->parseAlamat($validated['kampung'] ?? '');
        $validated['kampung'] = $parsed['kampung'];
        $validated['rt_rw'] = $parsed['rt_rw'];
        $validated['desa'] = $parsed['desa'];
        $validated['kecamatan'] = $parsed['kecamatan'];
        $validated['kabupaten'] = $parsed['kabupaten'];
        $validated['kode_pos'] = $parsed['kode_pos'];

        $validated['status'] = 'Mendaftar';

        $prefix = 'PPKNI-';
        $lastNo = PendaftaranPekani::where('no_pendaftaran', 'like', $prefix . now()->format('dmY') . '%')->max('no_pendaftaran');
        $lastNum = $lastNo ? (int) substr($lastNo, -3) : 0;
        $validated['no_pendaftaran'] = $prefix . now()->format('dmY') . str_pad($lastNum + 1, 3, '0', STR_PAD_LEFT);

        $pendaftaran = PendaftaranPekani::create($validated);

        return redirect()->route('pekani')
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