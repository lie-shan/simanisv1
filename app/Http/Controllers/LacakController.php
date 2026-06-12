<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\PendaftaranPekani;
use Illuminate\Http\Request;

class LacakController extends Controller
{
    public function index(Request $request)
    {
        $jenis = $request->query('jenis');
        return view('lacak', compact('jenis'));
    }

    public function cek(Request $request)
    {
        $request->validate([
            'no_pendaftaran' => 'required|string|max:20',
        ]);

        $no = $request->input('no_pendaftaran');
        $jenisFilter = $request->input('jenis_filter');

        $pendaftaran = Pendaftaran::where('no_pendaftaran', $no)->first();
        $pekani = PendaftaranPekani::where('no_pendaftaran', $no)->first();

        $data = $pendaftaran ?? $pekani;
        $jenis = $pendaftaran ? 'PESANIM' : ($pekani ? 'PEKANI' : null);

        if ($jenisFilter && $jenis && $jenis !== $jenisFilter) {
            return view('lacak', compact('jenisFilter', 'no'))
                ->withErrors(['no_pendaftaran' => "Nomor pendaftaran {$no} bukan pendaftaran {$jenisFilter}. Silakan cari nomor {$jenisFilter} yang valid."]);
        }

        if (!$data && $jenisFilter) {
            $prefix = $jenisFilter === 'PESANIM' ? 'PSBNI' : 'PPKNI';
            return view('lacak', compact('jenisFilter', 'no'))
                ->withErrors(['no_pendaftaran' => "Data dengan nomor pendaftaran {$no} tidak ditemukan. Pastikan nomor {$jenisFilter} diawali dengan {$prefix}-"]);
        }

        return view('lacak', compact('data', 'jenis', 'no', 'jenisFilter'));
    }
}
