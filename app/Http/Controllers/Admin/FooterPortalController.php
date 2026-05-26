<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FooterPortalRequest;
use App\Models\TmFooterPortal;

class FooterPortalController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = TmFooterPortal::ordered();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('label', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%");
        }

        $portals = $query->paginate(10);

        return view('admin.footer.portals.index', compact('portals'));
    }

    public function create()
    {
        return view('admin.footer.portals.create');
    }

    public function store(FooterPortalRequest $request)
    {
        TmFooterPortal::create(array_merge($request->validated(), [
            'is_active'  => $request->boolean('is_active', true),
            'sort_order' => $request->input('sort_order', 0),
        ]));

        return redirect()->route('admin.footer.portals.index')
            ->with('success', 'Portal terkait berhasil ditambahkan.');
    }

    public function edit(TmFooterPortal $portal)
    {
        return view('admin.footer.portals.edit', compact('portal'));
    }

    public function update(FooterPortalRequest $request, TmFooterPortal $portal)
    {
        $portal->update(array_merge($request->validated(), [
            'is_active'  => $request->boolean('is_active'),
            'sort_order' => $request->input('sort_order', 0),
        ]));

        return redirect()->route('admin.footer.portals.index')
            ->with('success', 'Portal terkait berhasil diperbarui.');
    }

    public function destroy(TmFooterPortal $portal)
    {
        $portal->delete();

        return redirect()->route('admin.footer.portals.index')
            ->with('success', 'Portal terkait berhasil dihapus.');
    }
}
