<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfrastrukturTikRequest;
use App\Models\TmTikStats;

class InfrastrukturTikController extends Controller
{
    public function index()
    {
        $items = TmTikStats::orderBy('kategori')->orderBy('sort_order')->get();

        return view('admin.infrastruktur-tik.index', compact('items'));
    }

    public function create()
    {
        return view('admin.infrastruktur-tik.create');
    }

    public function store(InfrastrukturTikRequest $request)
    {
        TmTikStats::create($request->validated());

        return redirect()->route('admin.infrastruktur-tik.index')
            ->with('success', 'Data Infrastruktur TIK berhasil ditambahkan.');
    }

    public function edit(TmTikStats $infrastrukturTik)
    {
        return view('admin.infrastruktur-tik.edit', compact('infrastrukturTik'));
    }

    public function update(InfrastrukturTikRequest $request, TmTikStats $infrastrukturTik)
    {
        $infrastrukturTik->update($request->validated());

        return redirect()->route('admin.infrastruktur-tik.index')
            ->with('success', 'Data Infrastruktur TIK berhasil diperbarui.');
    }

    public function destroy(TmTikStats $infrastrukturTik)
    {
        $infrastrukturTik->delete();

        return redirect()->route('admin.infrastruktur-tik.index')
            ->with('success', 'Data Infrastruktur TIK berhasil dihapus.');
    }
}
