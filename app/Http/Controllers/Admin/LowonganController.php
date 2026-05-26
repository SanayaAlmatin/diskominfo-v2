<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LowonganRequest;
use App\Models\TmLowongan;
use App\Models\TmJenisLowongan;
use Illuminate\Support\Facades\Storage;

class LowonganController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // Update expired kegiatan to 'tutup'
        TmLowongan::where('status', 'buka')
            ->whereNotNull('tanggal_tutup')
            ->whereDate('tanggal_tutup', '<', now()->startOfDay())
            ->update(['status' => 'tutup']);

        $query = TmLowongan::with('jenis_lowongan')
            ->orderByRaw("FIELD(status,'buka','tutup')")
            ->orderBy('tanggal_tutup')
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('posisi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        $items = $query->paginate(10);

        $totalLowongan = TmLowongan::count();
        $totalBuka = TmLowongan::where('status', 'buka')->count();
        $totalTutup = TmLowongan::where('status', 'tutup')->count();

        return view('admin.lowongan.index', compact('items', 'totalLowongan', 'totalBuka', 'totalTutup'));
    }

    public function create()
    {
        $jenisList = TmJenisLowongan::orderBy('nama')->get();
        return view('admin.lowongan.create', compact('jenisList'));
    }

    public function store(LowonganRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('lowongan', 'public');
        }

        TmLowongan::create($data);

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function edit(TmLowongan $lowongan)
    {
        $jenisList = TmJenisLowongan::orderBy('nama')->get();
        return view('admin.lowongan.edit', compact('lowongan', 'jenisList'));
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
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(TmLowongan $lowongan)
    {
        if ($lowongan->gambar) {
            Storage::disk('public')->delete($lowongan->gambar);
        }

        $lowongan->delete();

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
