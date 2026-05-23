<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BeritaRequest;
use App\Models\TmCategory;
use App\Models\TmNews;
use App\Models\TmTag;
use App\Models\TrNewsImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $items = TmNews::with(['category', 'author', 'tags'])->latest('published_at')->get();
        $categories = TmCategory::all();

        $totalBerita = TmNews::count();
        $totalDraft = TmNews::where('status', 0)->count();
        $totalPublished = TmNews::where('status', 1)->count();
        $totalHeadline = TmNews::where('is_headline', 1)->count();

        return view('admin.berita.index', compact(
            'items', 'categories', 'totalBerita', 'totalDraft', 'totalPublished', 'totalHeadline'
        ));
    }

    public function create()
    {
        $categories = TmCategory::all();
        $tags = TmTag::all();
        return view('admin.berita.create', compact('categories', 'tags'));
    }

    public function store(BeritaRequest $request)
    {
        $data = $request->validated();

        // Upload gambar utama
        if ($request->hasFile('description_image')) {
            $data['description_image'] = $request->file('description_image')->store('berita', 'public');
        }

        // Pastikan slug unik
        $data['slug'] = $this->ensureUniqueSlug($data['slug']);

        // Set author
        $data['author_id'] = auth()->id();

        // Set published_at jika status published dan belum ada
        if ($data['status'] == 1 && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $berita = TmNews::create($data);

        // Sinkronisasi Tags
        if ($request->has('tags')) {
            $berita->tags()->sync($request->tags);
        }

        // Upload Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('berita/gallery', 'public');
                $berita->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(TmNews $berita)
    {
        $berita->load(['category', 'author', 'tags', 'images']);
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(TmNews $berita)
    {
        $categories = TmCategory::all();
        $tags = TmTag::all();
        $berita->load(['tags', 'images']);
        return view('admin.berita.edit', compact('berita', 'categories', 'tags'));
    }

    public function update(BeritaRequest $request, TmNews $berita)
    {
        $data = $request->validated();

        // Upload gambar baru (replace yang lama)
        if ($request->hasFile('description_image')) {
            // Hapus gambar lama jika ada dan bukan dari folder migrasi
            if ($berita->description_image && ! Str::startsWith($berita->description_image, 'berita-portal-kominfo/')) {
                Storage::disk('public')->delete($berita->description_image);
            }
            $data['description_image'] = $request->file('description_image')->store('berita', 'public');
        } else {
            unset($data['description_image']);
        }

        // Pastikan slug unik (kecuali milik sendiri)
        if (isset($data['slug'])) {
            $data['slug'] = $this->ensureUniqueSlug($data['slug'], $berita->id);
        }

        // Set published_at jika baru dipublish
        if ($data['status'] == 1 && ! $berita->published_at && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $berita->update($data);

        // Sinkronisasi Tags
        if ($request->has('tags')) {
            $berita->tags()->sync($request->tags);
        } else {
            $berita->tags()->sync([]);
        }

        // Tambah Gallery Images baru
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('berita/gallery', 'public');
                $berita->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(TmNews $berita)
    {
        // Hapus gambar hanya jika bukan dari folder migrasi
        if ($berita->description_image && ! Str::startsWith($berita->description_image, 'berita-portal-kominfo/')) {
            Storage::disk('public')->delete($berita->description_image);
        }

        // Hapus gallery images
        foreach ($berita->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $berita->images()->delete();

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Pastikan slug unik di tabel tm_news.
     */
    private function ensureUniqueSlug(string $slug, ?int $excludeId = null): string
    {
        $original = $slug;
        $counter = 1;

        while (true) {
            $query = TmNews::withTrashed()->where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (! $query->exists()) {
                break;
            }

            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
}
