<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LowonganRequest;
use App\Models\TmLowongan;
use Illuminate\Support\Facades\Storage;

class LowonganController extends Controller
{
    public function index()
    {
        $items = TmLowongan::orderByRaw("FIELD(status,'buka','tutup')")
            ->orderBy('tanggal_tutup')
            ->latest()
            ->get();

        return view('admin.lowongan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.lowongan.create');
    }

    public function store(LowonganRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public');
        }

        TmLowongan::create($data);

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function edit(TmLowongan $lowongan)
    {
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(LowonganRequest $request, TmLowongan $lowongan)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($lowongan->gambar) {
                Storage::disk('public')->delete($lowongan->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public');
        }

        $lowongan->update($data);

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil diperbarui.');
    }

    public function destroy(TmLowongan $lowongan)
    {
        if ($lowongan->gambar) {
            Storage::disk('public')->delete($lowongan->gambar);
        }

        $lowongan->delete();

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus.');
    }
}
