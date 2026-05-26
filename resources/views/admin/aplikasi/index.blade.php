@extends('admin.layouts.admin')

@section('title', 'Manajemen Aplikasi')
@section('page-title', 'Manajemen Aplikasi Portal')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
            <div>
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Aplikasi</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Kelola daftar aplikasi yang ditampilkan pada portal publik</p>
                </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.aplikasi.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm" style="background-color: #1a56db;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Aplikasi
                </a>
            @endif
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-5 mb-6">
            {{-- Card 1: Total Aplikasi --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-blue-500">grid_view</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ $apps->total() }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Aplikasi</p>
                </div>
            </div>
            
            {{-- Card 2: Aplikasi Aktif --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-emerald-500">check_circle</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\TmPortalApp::where('is_active', true)->count() }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Aplikasi Aktif</p>
                </div>
            </div>

            {{-- Card 3: Featured --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-amber-500">star</span>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\TmPortalApp::where('is_featured', true)->count() }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Featured</p>
                </div>
            </div>
        </div>

        {{-- Custom Filter Bar --}}
        <form method="GET" action="{{ route('admin.aplikasi.index') }}" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex flex-col lg:flex-row gap-4 items-end">
            <div class="flex-1 w-full lg:w-auto">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>Cari Aplikasi</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau deskripsi..." class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="flex gap-2 w-full lg:w-auto">
                <button type="submit" class="flex-1 lg:flex-none px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2" style="background-color: #1a56db;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    Filter
                </button>
                <a href="{{ route('admin.aplikasi.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center gap-2" title="Reset Filter">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Reset
                </a>
            </div>
        </form>

        {{-- Main Container --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50/80 text-gray-500 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold tracking-wider w-16">#</th>
                            <th class="px-6 py-4 font-semibold tracking-wider min-w-[250px]">APLIKASI</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-48">KATEGORI</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-16">URL</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-24">STATUS</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-24">FEATURED</th>
                            <th class="px-6 py-4 font-semibold tracking-wider text-center w-24">URUTAN</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-6 py-4 font-semibold tracking-wider w-32">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($apps as $item)
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="px-6 py-4 align-middle text-gray-400 font-medium">
                                    {{ ($apps->currentPage() - 1) * $apps->perPage() + $loop->iteration }}
                                </td>
                                
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0 bg-gray-50 border border-gray-200 group-hover:border-indigo-200 group-hover:shadow-[0_0_0_3px_rgba(79,70,229,0.06)] transition-all overflow-hidden">
                                            @if ($item->icon_type === 'upload' && $item->logo_path)
                                                <img src="{{ Storage::disk('public')->url($item->logo_path) }}" alt="{{ $item->name }}" class="w-full h-full object-contain p-1.5">
                                            @else
                                                <span class="material-symbols-outlined {{ $item->icon_color }}" style="font-size:24px">{{ $item->icon_material ?: 'apps' }}</span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-bold text-gray-900 truncate mb-0.5">{{ $item->name }}</p>
                                            <p class="text-xs text-gray-500 line-clamp-1 leading-relaxed">{{ strip_tags($item->description) }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 align-middle">
                                    @php
                                        $cat = $item->categoryData;
                                        $catColor = $cat ? $cat->color_class : 'text-gray-600 bg-gray-50 border-gray-200';
                                        $catIcon = $cat ? $cat->icon_material : 'apps';
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border text-xs font-semibold {{ $catColor }} mb-2">
                                        <span class="material-symbols-outlined" style="font-size:13px; font-variation-settings:'FILL' 1">{{ $catIcon }}</span>
                                        {{ $item->category }}
                                    </span>
                                    
                                    @if ($item->tags)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($item->tags as $tag)
                                                <span class="px-2 py-0.5 rounded-md bg-gray-100 text-gray-500 text-[10px] font-medium border border-gray-200">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-middle text-center">
                                    <a href="{{ $item->href }}" target="_blank" rel="noopener noreferrer" title="Buka {{ $item->name }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">
                                        <span class="material-symbols-outlined" style="font-size:16px; font-variation-settings:'FILL' 1">open_in_new</span>
                                    </a>
                                </td>

                                <td class="px-6 py-4 align-middle">
                                    @if ($item->is_active)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-middle">
                                    @if ($item->is_featured)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Ya
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-gray-50 text-gray-600 border border-gray-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                            Tidak
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 align-middle text-center">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-700 font-bold text-xs border border-gray-200">
                                        {{ $item->sort_order }}
                                    </span>
                                </td>

                                @if (auth()->user()->isAdmin())
                                    <td class="px-6 py-4 align-middle ">
                                        <div class="flex items-center justify-start gap-1.5">
                                            <a href="{{ route('admin.aplikasi.edit', $item) }}" class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white hover:shadow-[0_4px_12px_rgba(79,70,229,0.3)] transition-all hover:-translate-y-0.5" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.aplikasi.destroy', $item) }}" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button" onclick="confirmDelete(this.closest('form'), 'Aplikasi ini akan dihapus secara permanen.')" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white hover:shadow-[0_4px_12px_rgba(239,68,68,0.3)] transition-all hover:-translate-y-0.5" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isAdmin() ? 8 : 7 }}" class="px-6 py-12 text-center">
                                    <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-3 border border-gray-100">
                                        <span class="material-symbols-outlined text-gray-300" style="font-size: 32px;">apps</span>
                                    </div>
                                    <p class="text-gray-500 font-medium text-base">Belum ada data aplikasi</p>
                                    <p class="text-gray-400 text-sm mt-1">Data aplikasi tidak ditemukan berdasarkan pencarian Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $apps->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

