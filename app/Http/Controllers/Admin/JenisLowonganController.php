<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmJenisLowongan;
use Illuminate\Http\Request;

class JenisLowonganController extends Controller
{
    public function index()
    {
        $items = TmJenisLowongan::orderBy('nama')->paginate(10);
        return view('admin.jenis_lowongan.index', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'warna' => 'required|string|max:50',
        ]);

        TmJenisLowongan::create($request->only('nama', 'warna'));

        return redirect()->route('admin.jenis-lowongan.index')
            ->with('success', 'Jenis kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, TmJenisLowongan $jenisLowongan)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'warna' => 'required|string|max:50',
        ]);

        $jenisLowongan->update($request->only('nama', 'warna'));

        return redirect()->route('admin.jenis-lowongan.index')
            ->with('success', 'Jenis kegiatan berhasil diperbarui.');
    }

    public function destroy(TmJenisLowongan $jenisLowongan)
    {
        if ($jenisLowongan->lowongan()->count() > 0) {
            return redirect()->route('admin.jenis-lowongan.index')
                ->with('error', 'Jenis kegiatan ini tidak dapat dihapus karena sedang digunakan oleh kegiatan.');
        }

        $jenisLowongan->delete();

        return redirect()->route('admin.jenis-lowongan.index')
            ->with('success', 'Jenis kegiatan berhasil dihapus.');
    }
}
