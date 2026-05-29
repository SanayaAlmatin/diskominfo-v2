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
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = TmNews::with(['category', 'author', 'tags'])->latest('published_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // If user is verifikator or sort_pending is requested, prioritize pending validation items
        if (auth()->user()?->hasRole('verifikator') || $request->has('sort_pending')) {
            $query->orderByRaw('CASE WHEN status = 2 THEN 1 ELSE 2 END');
        }

        if ($request->filled('status')) {
            if ($request->status == 'Published') {
                $status = 1;
            } elseif ($request->status == 'Menunggu Validasi') {
                $status = 2;
            } else {
                $status = 0;
            }
            $query->where('status', $status);
        }

        if ($request->filled('category')) {
            $categoryName = $request->category;
            $query->whereHas('category', function($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        $items = $query->paginate(10);
        $categories = TmCategory::all();

        $totalBerita = TmNews::count();
        $totalDraft = TmNews::whereIn('status', [0, 3])->count();
        $totalPublished = TmNews::where('status', 1)->count();
        $totalPending = TmNews::where('status', 2)->count();
        $totalHeadline = TmNews::where('is_headline', 1)->count();

        return view('admin.berita.index', compact(
            'items', 'categories', 'totalBerita', 'totalDraft', 'totalPublished', 'totalPending', 'totalHeadline'
        ));
    }

    public function create()
    {
        if (auth()->user()->hasRole('verifikator')) {
            abort(403, 'Akses Ditolak. Verifikator tidak dapat membuat berita baru.');
        }

        $categories = TmCategory::all();
        $tags = TmTag::all();
        return view('admin.berita.create', compact('categories', 'tags'));
    }

    public function store(BeritaRequest $request)
    {
        if (auth()->user()->hasRole('verifikator')) {
            abort(403, 'Akses Ditolak.');
        }

        $data = $request->validated();

        // Upload gambar utama
        if ($request->hasFile('description_image')) {
            $data['description_image'] = $request->file('description_image')->store('berita', 'public');
        }

        // Pastikan slug unik
        $data['slug'] = $this->ensureUniqueSlug($data['slug']);

        // Set author
        $data['author_id'] = auth()->id();

        // Jika admin mencoba publish langsung (status 1) tapi bukan verifikator, ubah ke 2 (Menunggu Validasi)
        if ($data['status'] == 1 && !auth()->user()->hasRole('verifikator')) {
            $data['status'] = 2;
        }

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
        // Jika verifikator, HANYA update status dan rejection_reason
        if (auth()->user()->hasRole('verifikator')) {
            $berita->update([
                'status' => $request->status,
                'rejection_reason' => $request->rejection_reason ?? null,
                'verifikator_id' => auth()->id(),
                'published_at' => $request->status == 1 ? ($berita->published_at ?? now()) : null,
            ]);
            return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diverifikasi.');
        }

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

        // Jika admin mencoba publish langsung (status 1) tapi bukan verifikator, ubah ke 2
        if ($data['status'] == 1 && !auth()->user()->hasRole('verifikator')) {
            $data['status'] = 2;
        }

        // Jika statusnya dikirim untuk validasi atau draft, reset rejection reason
        if (in_array($data['status'], [0, 2])) {
            $data['rejection_reason'] = null;
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
        if (auth()->user()->hasRole('verifikator')) {
            abort(403, 'Akses Ditolak.');
        }

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

    public function verify(Request $request, TmNews $berita)
    {
        $request->validate([
            'action' => ['required', 'in:approve,reject'],
            'rejection_reason' => ['required_if:action,reject', 'nullable', 'string']
        ]);

        if ($request->action === 'approve') {
            $berita->update([
                'status' => 1,
                'published_at' => $berita->published_at ?? now(),
                'verifikator_id' => auth()->id(),
                'rejection_reason' => null
            ]);
            $message = 'Berita berhasil dipublikasi.';
        } else {
            $berita->update([
                'status' => 0, // Kembalikan ke draft
                'verifikator_id' => auth()->id(),
                'rejection_reason' => $request->rejection_reason
            ]);
            $message = 'Berita ditolak dan dikembalikan sebagai draft.';
        }

        return redirect()->back()->with('success', $message);
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
