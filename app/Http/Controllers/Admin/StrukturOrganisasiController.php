<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StrukturOrganisasiRequest;
use App\Models\TmSotk;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $items = TmSotk::orderBy('tahun', 'desc')->paginate(10);

        return view('admin.struktur-organisasi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.struktur-organisasi.create');
    }

    public function store(StrukturOrganisasiRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('sotk', 'public');
        }

        if ($request->boolean('is_current')) {
            TmSotk::where('is_current', true)->update(['is_current' => false]);
        }

        TmSotk::create($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data Struktur Organisasi berhasil ditambahkan.');
    }

    public function edit(TmSotk $strukturOrganisasi)
    {
        return view('admin.struktur-organisasi.edit', compact('strukturOrganisasi'));
    }

    public function update(StrukturOrganisasiRequest $request, TmSotk $strukturOrganisasi)
    {
        $data = $request->validated();

        if ($request->hasFile('gambar')) {
            if ($strukturOrganisasi->gambar) {
                Storage::disk('public')->delete($strukturOrganisasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('sotk', 'public');
        }

        if ($request->boolean('is_current')) {
            TmSotk::where('is_current', true)
                ->where('id', '!=', $strukturOrganisasi->id)
                ->update(['is_current' => false]);
        }

        $strukturOrganisasi->update($data);

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data Struktur Organisasi berhasil diperbarui.');
    }

    public function destroy(TmSotk $strukturOrganisasi)
    {
        if ($strukturOrganisasi->gambar) {
            Storage::disk('public')->delete($strukturOrganisasi->gambar);
        }

        $strukturOrganisasi->delete();

        return redirect()->route('admin.struktur-organisasi.index')
            ->with('success', 'Data Struktur Organisasi berhasil dihapus.');
    }
}
