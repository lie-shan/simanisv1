<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Santri;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::with('santri')->latest()->get();
        $santriList = Santri::where('status', 'Aktif')->orderBy('nama')->get();

        $totalPemasukan = $pembayaran->where('tipe', 'masuk')->sum('jumlah');
        $totalPengeluaran = $pembayaran->where('tipe', 'keluar')->sum('jumlah');
        $sisa = $totalPemasukan - $totalPengeluaran;

        $jenisList = [
            'Pendaftaran', 'Paskil', 'Infaq', 'Lainnya',
        ];

        $jenisPengeluaran = [
            'ATK', 'Listrik', 'Air', 'Konsumsi', 'Transport', 'Perawatan', 'Lainnya',
        ];

        return view('admin.pembayaran', compact(
            'pembayaran', 'santriList', 'totalPemasukan',
            'totalPengeluaran', 'sisa', 'jenisList', 'jenisPengeluaran'
        ));
    }

    public function store(Request $request)
    {
        $rules = [
            'tipe' => 'required|in:masuk,keluar',
            'jenis_pembayaran' => 'required|string|max:50',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'metode' => 'required|string|max:50',
            'keterangan' => 'nullable|string|max:255',
        ];

        if ($request->tipe === 'masuk') {
            $rules['santri_id'] = 'required|exists:santri,id';
            $rules['status'] = 'required|in:Lunas,Belum Lunas';
        } else {
            $rules['santri_id'] = 'nullable|exists:santri,id';
            $rules['status'] = 'required|in:Lunas';
        }

        $data = $request->validate($rules);

        $data['no_transaksi'] = $this->generateNoTransaksi();

        Pembayaran::create($data);

        return redirect()->route('admin.pembayaran')->with('success', 'Pembayaran berhasil dicatat');
    }

    public function edit(Pembayaran $pembayaran)
    {
        $pembayaran->load('santri');
        return response()->json($pembayaran);
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $rules = [
            'tipe' => 'required|in:masuk,keluar',
            'jenis_pembayaran' => 'required|string|max:50',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_bayar' => 'required|date',
            'metode' => 'required|string|max:50',
            'keterangan' => 'nullable|string|max:255',
        ];

        if ($request->tipe === 'masuk') {
            $rules['santri_id'] = 'required|exists:santri,id';
            $rules['status'] = 'required|in:Lunas,Belum Lunas';
        } else {
            $rules['santri_id'] = 'nullable|exists:santri,id';
            $rules['status'] = 'required|in:Lunas';
        }

        $data = $request->validate($rules);

        $pembayaran->update($data);

        return redirect()->route('admin.pembayaran')->with('success', 'Pembayaran berhasil diupdate');
    }

    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('admin.pembayaran')->with('success', 'Pembayaran berhasil dihapus');
    }

    public function export()
    {
        $pembayaran = Pembayaran::with('santri')->orderBy('created_at', 'desc')->get();

        $totalPemasukan = $pembayaran->where('tipe', 'masuk')->sum('jumlah');
        $totalPengeluaran = $pembayaran->where('tipe', 'keluar')->sum('jumlah');
        $sisa = $totalPemasukan - $totalPengeluaran;

        return view('admin.pembayaran-print', compact(
            'pembayaran', 'totalPemasukan', 'totalPengeluaran', 'sisa'
        ));
    }

    private function generateNoTransaksi(): string
    {
        do {
            $noTransaksi = 'TRX-' . mt_rand(1000000000, 9999999999);
        } while (Pembayaran::where('no_transaksi', $noTransaksi)->exists());

        return $noTransaksi;
    }
}
