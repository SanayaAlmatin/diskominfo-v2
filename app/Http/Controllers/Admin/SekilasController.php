<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SekilasRequest;
use App\Models\TmSejarah;
use Illuminate\Support\Facades\Storage;

class SekilasController extends Controller
{
    public function index()
    {
        $sekilas = TmSejarah::orderBy('id', 'desc')->paginate(10);

        return view('admin.sekilas.index', compact('sekilas'));
    }

    public function create()
    {
        return view('admin.sekilas.create');
    }

    public function store(SekilasRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sekilas', 'public');
        }

        TmSejarah::create($data);

        return redirect()->route('admin.sekilas.index')
            ->with('success', 'Data Sekilas Diskominfo berhasil ditambahkan.');
    }

    public function edit(TmSejarah $sekilas)
    {
        return view('admin.sekilas.edit', compact('sekilas'));
    }

    public function update(SekilasRequest $request, TmSejarah $sekilas)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($sekilas->gambar) {
                Storage::disk('public')->delete($sekilas->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sekilas', 'public');
        }

        $sekilas->update($data);

        return redirect()->route('admin.sekilas.index')
            ->with('success', 'Data Sekilas Diskominfo berhasil diperbarui.');
    }

    public function destroy(TmSejarah $sekilas)
    {
        if ($sekilas->gambar) {
            Storage::disk('public')->delete($sekilas->gambar);
        }

        $sekilas->delete();

        return redirect()->route('admin.sekilas.index')
            ->with('success', 'Data Sekilas Diskominfo berhasil dihapus.');
    }
}
