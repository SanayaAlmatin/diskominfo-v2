@extends('admin.layouts.admin')

@section('title', 'Manajemen Galeri Foto')
@section('page-title', 'Kelola Galeri Foto')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Galeri Foto</h2>
                <p class="text-sm text-gray-500 mt-0.5">Manajemen foto dokumentasi kegiatan</p>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.foto.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm" style="background-color: #1a56db;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Foto
                </a>
            @endif
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-5 mb-6">
            {{-- Card 1: Total Foto --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalFoto) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Foto</p>
                </div>
            </div>
            
            {{-- Card 2: Aktif --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalAktif) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Status Aktif</p>
                </div>
            </div>

            {{-- Card 3: Kategori --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalKategori) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Kategori</p>
                </div>
            </div>
        </div>

        {{-- Custom Filter Bar --}}
        <form method="GET" action="{{ route('admin.foto.index') }}" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex flex-col lg:flex-row gap-4 items-end">
            <div class="flex-1 w-full lg:w-auto">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>Cari Foto</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul atau kategori..." class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="flex gap-2 w-full lg:w-auto">
                <button type="submit" class="flex-1 lg:flex-none px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2" style="background-color: #1a56db;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    Filter
                </button>
                <a href="{{ route('admin.foto.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center gap-2" title="Reset Filter">
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
                    <thead class="bg-gray-50/50 text-gray-500 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold tracking-wider w-16">#</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-32">FOTO</th>
                            <th class="px-6 py-4 font-semibold tracking-wider">JUDUL KEGIATAN</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-40">KATEGORI</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-32">STATUS</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-6 py-4 font-semibold tracking-wider w-32">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($items as $index => $item)
                            <tr class="hover:bg-blue-50/20 transition-colors group">
                                <td class="px-6 py-4 align-middle text-gray-400 font-medium">
                                    {{ ($items->currentPage() - 1) * $items->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($item->image_path)
                                        <div class="relative group/image inline-block cursor-pointer" onclick="openLightbox('{{ Storage::url($item->image_path) }}')">
                                            <img src="{{ Storage::url($item->image_path) }}" class="h-16 w-24 object-cover rounded-lg border border-gray-200 shadow-sm transition-transform group-hover/image:scale-105" alt="{{ $item->title }}">
                                            <div class="absolute inset-0 bg-black/40 rounded-lg opacity-0 group-hover/image:opacity-100 flex items-center justify-center transition-opacity">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                            </div>
                                        </div>
                                    @else
                                        <div class="h-16 w-24 bg-gray-50 rounded-lg border border-gray-200 border-dashed flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="font-bold text-gray-900 mb-1 line-clamp-2">{{ $item->title }}</p>
                                    @if ($item->description)
                                        <p class="text-sm text-gray-500 line-clamp-1">{{ $item->description }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($item->category)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $item->category }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm italic">Tidak ada kategori</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($item->is_active)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-green-50 text-green-700 border border-green-100">
                                            <svg class="w-3.5 h-3.5 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-50 text-gray-600 border border-gray-200">
                                            <svg class="w-3.5 h-3.5 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-6 py-4 align-middle ">
                                        <div class="flex items-center justify-start gap-2">
                                            <a href="{{ route('admin.foto.edit', $item) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.foto.destroy', $item) }}" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button" onclick="confirmDelete(this.closest('form'), 'Foto ini akan dihapus secara permanen.')" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-100 hover:text-orange-600 transition-colors" title="Hapus">
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
                                <td colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}" class="px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    <p class="text-gray-500 font-medium">Belum ada data foto</p>
                                    <p class="text-gray-400 text-sm mt-1">Data galeri foto tidak ditemukan berdasarkan pencarian Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $items->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

