<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AplikasiRequest;
use App\Models\TmPortalApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AplikasiController extends Controller
{
    public function index()
    {
        $apps = TmPortalApp::orderBy('sort_order')->orderBy('id', 'desc')->get();
        return view('admin.aplikasi.index', compact('apps'));
    }

    public function create()
    {
        return view('admin.aplikasi.create');
    }

    public function store(AplikasiRequest $request)
    {
        $data = $request->validated();

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->has('tags') && !empty($data['tags'])) {
            $data['tags'] = json_decode($data['tags'], true) ?: [];
        } else {
            $data['tags'] = [];
        }

        if ($request->hasFile('logo_file')) {
            $data['logo_path'] = $request->file('logo_file')->store('aplikasi_logos', 'public');
        }

        TmPortalApp::create($data);

        return redirect()->route('admin.aplikasi.index')->with('success', 'Aplikasi berhasil ditambahkan.');
    }

    public function edit(TmPortalApp $aplikasi)
    {
        return view('admin.aplikasi.edit', compact('aplikasi'));
    }

    public function update(AplikasiRequest $request, TmPortalApp $aplikasi)
    {
        $data = $request->validated();

        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->has('tags') && !empty($data['tags'])) {
            $data['tags'] = json_decode($data['tags'], true) ?: [];
        } else {
            $data['tags'] = [];
        }

        if ($request->hasFile('logo_file')) {
            if ($aplikasi->logo_path && Storage::disk('public')->exists($aplikasi->logo_path)) {
                Storage::disk('public')->delete($aplikasi->logo_path);
            }
            $data['logo_path'] = $request->file('logo_file')->store('aplikasi_logos', 'public');
        }

        $aplikasi->update($data);

        return redirect()->route('admin.aplikasi.index')->with('success', 'Aplikasi berhasil diperbarui.');
    }

    public function destroy(TmPortalApp $aplikasi)
    {
        if ($aplikasi->logo_path && Storage::disk('public')->exists($aplikasi->logo_path)) {
            Storage::disk('public')->delete($aplikasi->logo_path);
        }
        
        $aplikasi->delete();

        return redirect()->route('admin.aplikasi.index')->with('success', 'Aplikasi berhasil dihapus.');
    }

    public function toggleFeatured(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tm_portal_apps,id',
            'field' => 'required|in:is_featured,is_active',
            'value' => 'required|boolean'
        ]);

        $aplikasi = TmPortalApp::find($request->id);
        $aplikasi->{$request->field} = $request->value;
        $aplikasi->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui'
        ]);
    }
}
