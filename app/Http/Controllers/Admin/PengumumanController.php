<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->get();
        $totalPublished = Pengumuman::where('status', 'Publikasikan')->count();
        $totalDraft = Pengumuman::where('status', 'Draft')->count();

        return view('admin.pengumuman', compact('pengumuman', 'totalPublished', 'totalDraft'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'status' => 'required|in:Draft,Publikasikan',
        ]);

        $data['user_id'] = auth()->id();
        if (empty($data['penulis'])) {
            $data['penulis'] = auth()->user()->name;
        }

        Pengumuman::create($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return response()->json($pengumuman);
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'status' => 'required|in:Draft,Publikasikan',
        ]);

        if (empty($data['penulis'])) {
            $data['penulis'] = auth()->user()->name;
        }

        $pengumuman->update($data);

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil diupdate');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dihapus');
    }
}
