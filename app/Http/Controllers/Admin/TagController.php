<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TmTag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $query = TmTag::query();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('n_tag', 'like', '%' . $request->search . '%');
        }
        
        $totalTag = TmTag::count();
        $tags = $query->orderBy('id', 'desc')->paginate(12)->withQueryString();
        
        return view('admin.tags.index', compact('tags', 'totalTag'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'n_tag' => 'required|string|max:255|unique:tm_tags,n_tag',
        ], [
            'n_tag.required' => 'Nama tag wajib diisi.',
            'n_tag.unique' => 'Nama tag sudah terdaftar.',
        ]);

        TmTag::create([
            'n_tag' => $request->n_tag,
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil ditambahkan.');
    }

    public function update(Request $request, TmTag $tag)
    {
        $request->validate([
            'n_tag' => 'required|string|max:255|unique:tm_tags,n_tag,' . $tag->id,
        ], [
            'n_tag.required' => 'Nama tag wajib diisi.',
            'n_tag.unique' => 'Nama tag sudah terdaftar.',
        ]);

        $tag->update([
            'n_tag' => $request->n_tag,
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil diperbarui.');
    }

    public function destroy(TmTag $tag)
    {
        // Detach related news to avoid orphan records in pivot table
        $tag->news()->detach();
        $tag->delete();

        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil dihapus.');
    }
}
