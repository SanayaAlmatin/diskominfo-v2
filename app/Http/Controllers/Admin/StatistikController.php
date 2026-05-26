<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BidangStatistikRequest;
use App\Models\TmBidangStatistik;
use App\Models\TmFileBidangStatistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        $query = TmBidangStatistik::withCount('files')->orderBy('n_bidang');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('n_bidang', 'like', "%{$search}%");
        }

        $items = $query->paginate(10);

        return view('admin.statistik.index', compact('items'));
    }

    public function create()
    {
        return view('admin.statistik.create');
    }

    public function store(BidangStatistikRequest $request)
    {
        TmBidangStatistik::create(['n_bidang' => $request->validated()['n_bidang']]);

        return redirect()->route('admin.statistik.index')
            ->with('success', 'Bidang statistik berhasil ditambahkan.');
    }

    public function edit(TmBidangStatistik $statistik)
    {
        $bidang = $statistik;
        $files = TmFileBidangStatistik::where('id_bidang', $statistik->id)->get();

        return view('admin.statistik.edit', compact('bidang', 'files'));
    }

    public function update(BidangStatistikRequest $request, TmBidangStatistik $statistik)
    {
        $statistik->update(['n_bidang' => $request->validated()['n_bidang']]);

        return redirect()->route('admin.statistik.edit', $statistik)
            ->with('success', 'Bidang statistik berhasil diperbarui.');
    }

    public function destroy(TmBidangStatistik $statistik)
    {
        foreach ($statistik->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }
        $statistik->files()->delete();
        $statistik->delete();

        return redirect()->route('admin.statistik.index')
            ->with('success', 'Bidang statistik berhasil dihapus.');
    }

    public function storeFile(Request $request, TmBidangStatistik $statistik)
    {
        $request->validate([
            'n_file' => 'required|string|max:150',
            'file_path' => 'required|file|max:10240|mimes:pdf,xlsx,xls,csv,doc,docx',
        ]);

        $uploadedFile = $request->file('file_path');
        $path = $uploadedFile->store('statistik', 'public');

        TmFileBidangStatistik::create([
            'id_bidang' => $statistik->id,
            'deskripsi' => $request->n_file,
            'file' => $path,
            'type' => $uploadedFile->getClientOriginalExtension(),
            'd_entry' => now()->toDateString(),
            'size' => $uploadedFile->getSize(),
        ]);

        return redirect()->route('admin.statistik.edit', $statistik)
            ->with('success', 'File berhasil diunggah.');
    }

    public function destroyFile(TmBidangStatistik $statistik, TmFileBidangStatistik $file)
    {
        Storage::disk('public')->delete($file->file);
        $file->delete();

        return redirect()->route('admin.statistik.edit', $statistik)
            ->with('success', 'File berhasil dihapus.');
    }
}
