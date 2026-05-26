<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AplikasiRequest;
use App\Models\TmPortalApp;
use App\Models\TmPortalAppCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AplikasiController extends Controller
{
    public function index(Request $request)
    {
        $query = TmPortalApp::orderBy('sort_order')->orderBy('id', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $apps = $query->paginate(10);
        return view('admin.aplikasi.index', compact('apps'));
    }

    public function create()
    {
        $categories = TmPortalAppCategory::orderBy('name')->get();
        return view('admin.aplikasi.create', compact('categories'));
    }

    public function store(AplikasiRequest $request)
    {
        $data = $request->validated();

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
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
        $categories = TmPortalAppCategory::orderBy('name')->get();
        return view('admin.aplikasi.edit', compact('aplikasi', 'categories'));
    }

    public function update(AplikasiRequest $request, TmPortalApp $aplikasi)
    {
        $data = $request->validated();

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
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

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tm_portal_app_categories,name',
            'icon_material' => 'nullable|string|max:255',
            'color_class' => 'nullable|string|max:255',
        ]);

        $category = TmPortalAppCategory::create([
            'name' => $request->name,
            'icon_material' => $request->icon_material ?? 'apps',
            'color_class' => $request->color_class ?? 'text-gray-600 bg-gray-50 border-gray-200',
        ]);

        return response()->json([
            'success' => true,
            'category' => $category,
            'message' => 'Kategori berhasil ditambahkan'
        ]);
    }
}
