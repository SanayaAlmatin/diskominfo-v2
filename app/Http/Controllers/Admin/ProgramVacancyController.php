<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProgramVacancyRequest;
use App\Models\TmInfoBanner;
use Illuminate\Support\Facades\Storage;

class ProgramVacancyController extends Controller
{
    public function index()
    {
        $items = TmInfoBanner::orderBy('created_at', 'desc')->get();

        return view('admin.program-vacancy.index', compact('items'));
    }

    public function create()
    {
        return view('admin.program-vacancy.create');
    }

    public function store(ProgramVacancyRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        TmInfoBanner::create($data);

        return redirect()->route('admin.program-vacancy.index')
            ->with('success', 'Item carousel berhasil ditambahkan.');
    }

    public function edit(TmInfoBanner $programVacancy)
    {
        return view('admin.program-vacancy.edit', compact('programVacancy'));
    }

    public function update(ProgramVacancyRequest $request, TmInfoBanner $programVacancy)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($programVacancy->image) {
                Storage::disk('public')->delete($programVacancy->image);
            }
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $programVacancy->update($data);

        return redirect()->route('admin.program-vacancy.index')
            ->with('success', 'Item carousel berhasil diperbarui.');
    }

    public function destroy(TmInfoBanner $programVacancy)
    {
        if ($programVacancy->image) {
            Storage::disk('public')->delete($programVacancy->image);
        }

        $programVacancy->delete();

        return redirect()->route('admin.program-vacancy.index')
            ->with('success', 'Item carousel berhasil dihapus.');
    }
}
