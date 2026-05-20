<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FotoRequest;
use App\Models\TmFoto;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function index()
    {
        $items = TmFoto::orderBy('sort_order')->latest()->get();

        return view('admin.foto.index', compact('items'));
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
