<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmCategory;
use App\Models\TmNews;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriBeritaController extends Controller
{
    public function index()
    {
        $categories = TmCategory::withCount('news')->latest()->get();

        $totalKategori = TmCategory::count();
        $totalArtikel = TmNews::count();
        $artikelHariIni = TmNews::whereDate('created_at', today())->count();
        $artikelMingguIni = TmNews::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        return view('admin.kategori.index', compact('categories', 'totalKategori', 'totalArtikel', 'artikelHariIni', 'artikelMingguIni'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tm_categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        TmCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(TmCategory $kategori)
    {
        $totalArtikel = $kategori->news()->count();
        $artikelPublished = $kategori->news()->where('status', 1)->count();
        $artikelDraft = $kategori->news()->where('status', 0)->count();
        
        // Asumsi jika tidak ada status 2, kita set pending = 0 atau bisa menggunakan logika lain jika ada.
        $artikelPending = 0; 
        
        $latestArticles = $kategori->news()->with('author')->latest()->take(5)->get();

        return view('admin.kategori.show', compact('kategori', 'totalArtikel', 'artikelPublished', 'artikelDraft', 'artikelPending', 'latestArticles'));
    }

    public function update(Request $request, TmCategory $kategori)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tm_categories,name,' . $kategori->id,
            'description' => 'nullable|string|max:500',
        ]);

        $kategori->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(TmCategory $kategori)
    {
        if ($kategori->news()->count() > 0) {
            return redirect()->route('admin.kategori.index')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki artikel terkait.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
