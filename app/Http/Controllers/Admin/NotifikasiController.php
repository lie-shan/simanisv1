<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::latest()->get();
        $totalUnread = Notifikasi::belumDibaca()->count();

        return view('admin.notifikasi', compact('notifikasi', 'totalUnread'));
    }

    public function fetch()
    {
        $notifikasi = Notifikasi::latest()->take(10)->get();
        $totalUnread = Notifikasi::belumDibaca()->count();

        return response()->json([
            'notifikasi' => $notifikasi,
            'totalUnread' => $totalUnread,
        ]);
    }

    public function read($id)
    {
        $notif = Notifikasi::findOrFail($id);
        $notif->update(['dibaca' => true]);

        return response()->json(['success' => true]);
    }

    public function readAll()
    {
        Notifikasi::belumDibaca()->update(['dibaca' => true]);

        return response()->json(['success' => true]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'pesan' => 'nullable|string',
            'icon' => 'required|string|max:50',
            'warna' => 'required|string|max:30',
            'link' => 'nullable|string|max:255',
        ]);

        Notifikasi::create($request->only(['judul', 'pesan', 'icon', 'warna', 'link']));

        return redirect()->route('admin.notifikasi')->with('success', 'Notifikasi berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:200',
            'pesan' => 'nullable|string',
            'icon' => 'required|string|max:50',
            'warna' => 'required|string|max:30',
            'link' => 'nullable|string|max:255',
        ]);

        $notif = Notifikasi::findOrFail($id);
        $notif->update($request->only(['judul', 'pesan', 'icon', 'warna', 'link']));

        return redirect()->route('admin.notifikasi')->with('success', 'Notifikasi berhasil diupdate');
    }

    public function destroy($id)
    {
        Notifikasi::findOrFail($id)->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.notifikasi')->with('success', 'Notifikasi berhasil dihapus');
    }
}
