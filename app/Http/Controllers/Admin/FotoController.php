<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FotoRequest;
use App\Models\TmFoto;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = TmFoto::orderBy('sort_order')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        }

        $items = $query->paginate(10);

        $totalFoto = TmFoto::count();
        $totalAktif = TmFoto::where('is_active', true)->count();
        $totalKategori = TmFoto::whereNotNull('category')->distinct('category')->count('category');

        return view('admin.foto.index', compact('items', 'totalFoto', 'totalAktif', 'totalKategori'));
    }

    public function create()
    {
        $categories = TmFoto::whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('admin.foto.create', compact('categories'));
    }

    public function store(FotoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            $data['image_path'] = $request->file('image_path')->store('foto', 'public');
        }

        TmFoto::create($data);

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(TmFoto $foto)
    {
        $categories = TmFoto::whereNotNull('category')
            ->distinct()
            ->pluck('category');

        return view('admin.foto.edit', compact('foto', 'categories'));
    }

    public function update(FotoRequest $request, TmFoto $foto)
    {
        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            if ($foto->image_path) {
                Storage::disk('public')->delete($foto->image_path);
            }
            $data['image_path'] = $request->file('image_path')->store('foto', 'public');
        } else {
            unset($data['image_path']);
        }

        $foto->update($data);

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(TmFoto $foto)
    {
        if ($foto->image_path) {
            Storage::disk('public')->delete($foto->image_path);
        }

        $foto->delete();

        return redirect()->route('admin.foto.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}
