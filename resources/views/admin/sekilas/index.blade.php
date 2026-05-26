@extends('admin.layouts.admin')

@section('title', 'Sekilas Diskominfo')
@section('page-title', 'Sekilas Diskominfo')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Sekilas Diskominfo</h2>
                <p class="text-sm text-gray-500 mt-0.5">Manajemen informasi sekilas tentang dinas</p>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.sekilas.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm" style="background-color: #1a56db;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Data
                </a>
            @endif
        </div>

        {{-- Custom Filter Bar --}}
        <form method="GET" action="{{ route('admin.sekilas.index') }}" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex flex-col lg:flex-row gap-4 items-end">
            <div class="flex-1 w-full lg:w-auto">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>Cari Data</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul atau konten..." class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="flex gap-2 w-full lg:w-auto">
                <button type="submit" class="flex-1 lg:flex-none px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2" style="background-color: #1a56db;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    Filter
                </button>
                <a href="{{ route('admin.sekilas.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center gap-2" title="Reset Filter">
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
                            <th class="px-6 py-4 font-semibold tracking-wider">KONTEN</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-40">GAMBAR</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-40">DIPERBARUI</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-6 py-4 font-semibold tracking-wider w-32">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($sekilas as $item)
                            <tr class="hover:bg-blue-50/20 transition-colors group">
                                <td class="px-6 py-4 align-middle text-gray-400 font-medium">
                                    {{ ($sekilas->currentPage() - 1) * $sekilas->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 align-middle text-gray-800">
                                    @if($item->judul)
                                        <p class="font-bold text-gray-900 mb-1">{{ $item->judul }}</p>
                                    @endif
                                    <p class="line-clamp-2 text-gray-600 leading-relaxed">{{ strip_tags($item->konten) }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($item->gambar)
                                        <div class="relative group/image inline-block cursor-pointer" onclick="openLightbox('{{ Storage::url($item->gambar) }}')">
                                            <img src="{{ Storage::url($item->gambar) }}" class="h-14 w-24 object-cover rounded-lg border border-gray-200 shadow-sm transition-transform group-hover/image:scale-105" alt="Preview">
                                            <div class="absolute inset-0 bg-black/40 rounded-lg opacity-0 group-hover/image:opacity-100 flex items-center justify-center transition-opacity">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                                            </div>
                                        </div>
                                    @else
                                        <div class="h-14 w-24 bg-gray-50 rounded-lg border border-gray-200 border-dashed flex items-center justify-center text-gray-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="text-sm font-bold text-gray-800">{{ $item->updated_at?->translatedFormat('d M Y') ?? '-' }}</p>
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-6 py-4 align-middle ">
                                        <div class="flex items-center justify-start gap-2">
                                            <a href="{{ route('admin.sekilas.edit', $item) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.sekilas.destroy', $item) }}" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button" onclick="confirmDelete(this.closest('form'), 'Data sekilas diskominfo ini akan dihapus secara permanen.')" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-100 hover:text-orange-600 transition-colors" title="Hapus">
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
                                <td colspan="{{ auth()->user()->isAdmin() ? 5 : 4 }}" class="px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <p class="text-gray-500 font-medium">Belum ada data</p>
                                    <p class="text-gray-400 text-sm mt-1">Data sekilas diskominfo tidak ditemukan berdasarkan pencarian Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $sekilas->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

