<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VisiMisiRequest;
use App\Models\TmVisiMisi;

class VisiMisiController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = TmVisiMisi::orderBy('tipe')->orderBy('sort_order');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('konten', 'like', "%{$search}%");
        }

        $items = $query->paginate(10);

        return view('admin.visi-misi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.visi-misi.create');
    }

    public function store(VisiMisiRequest $request)
    {
        TmVisiMisi::create($request->validated());

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data Visi & Misi berhasil ditambahkan.');
    }

    public function edit(TmVisiMisi $visiMisi)
    {
        return view('admin.visi-misi.edit', compact('visiMisi'));
    }

    public function update(VisiMisiRequest $request, TmVisiMisi $visiMisi)
    {
        $visiMisi->update($request->validated());

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data Visi & Misi berhasil diperbarui.');
    }

    public function destroy(TmVisiMisi $visiMisi)
    {
        $visiMisi->delete();

        return redirect()->route('admin.visi-misi.index')
            ->with('success', 'Data Visi & Misi berhasil dihapus.');
    }
}
