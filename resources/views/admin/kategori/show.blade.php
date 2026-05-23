@extends('admin.layouts.admin')

@section('title', 'Detail Kategori')
@section('page-title', 'Detail Kategori')

@push('styles')
<style>
    /* Add subtle hover effects and refinements */
    .info-card { transition: all 0.2s ease; }
    .info-card:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); }
</style>
@endpush

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto" x-data="kategoriDetailManager()">

        {{-- Breadcrumb --}}
        <div class="flex items-center text-sm text-gray-500 mb-2">
            <a href="{{ route('admin.kategori.index') }}" class="hover:text-blue-600 transition-colors">Kategori</a>
            <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            <span class="font-semibold text-gray-800">Detail</span>
        </div>

        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div class="flex items-center gap-4">
                <div class="bg-blue-600 text-white p-3 rounded-xl flex items-center justify-center flex-shrink-0 shadow-sm" style="background-color: #1a56db;">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 tracking-tight">{{ $kategori->name }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Detail informasi kategori artikel</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3 w-full sm:w-auto">
                @if (auth()->user()->isAdmin())
                    <button @click="openEditModal({{ $kategori->id }}, '{{ addslashes($kategori->name) }}', '{{ addslashes($kategori->description) }}')" class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm whitespace-nowrap" style="background-color: #1a56db;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Edit Kategori
                    </button>
                @endif
                <a href="{{ route('admin.kategori.index') }}" class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-6 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors shadow-sm whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Main Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Left Column (Main) --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Informasi Kategori Card --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 sm:p-8 info-card">
                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-[#f0f4f8] flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Informasi Kategori</h3>
                    </div>
                    
                    {{-- Body --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-7 gap-x-8">
                        <div>
                            <p class="text-[13px] text-gray-500 mb-2 flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg> Nama Kategori</p>
                            <p class="font-bold text-gray-900 text-base">{{ $kategori->name }}</p>
                        </div>
                        <div>
                            <p class="text-[13px] text-gray-500 mb-2 flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg> Slug</p>
                            <span class="inline-block bg-[#f8f9fa] text-gray-700 px-3 py-1 rounded-lg text-sm font-mono font-medium">{{ $kategori->slug }}</span>
                        </div>
                        <div>
                            <p class="text-[13px] text-gray-500 mb-2 flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Tanggal Dibuat</p>
                            <p class="font-bold text-gray-900 text-base">{{ $kategori->created_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-[13px] text-gray-500 mb-2 flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Terakhir Update</p>
                            <p class="font-bold text-gray-900 text-base">{{ $kategori->updated_at->translatedFormat('d M Y, H:i') }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-[13px] text-gray-500 mb-2 flex items-center gap-2"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg> Deskripsi</p>
                            <p class="text-base text-gray-700">{{ $kategori->description ?: 'Tidak ada deskripsi yang ditambahkan untuk kategori ini.' }}</p>
                        </div>
                    </div>

                    {{-- Separator --}}
                    <div class="h-px w-full bg-gray-100/70 my-8"></div>

                    {{-- STATISTIK ARTIKEL --}}
                    <div>
                        <div class="flex items-center gap-2.5 mb-5 text-gray-500 font-bold text-[13px] uppercase tracking-widest">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            STATISTIK ARTIKEL
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            {{-- Total --}}
                            <div class="rounded-2xl p-6 flex flex-col items-center justify-center text-center" style="background-color: #f0f4f8;">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background-color: #e2e8f0;">
                                    <svg class="w-6 h-6 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <p class="text-[32px] font-bold text-gray-900 leading-none mb-1.5">{{ number_format($totalArtikel) }}</p>
                                <p class="text-[13px] text-gray-500 font-medium">Total Artikel</p>
                            </div>
                            
                            {{-- Published --}}
                            <div class="rounded-2xl p-6 flex flex-col items-center justify-center text-center" style="background-color: #f0fdf4;">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background-color: #dcfce7;">
                                    <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <p class="text-[32px] font-bold text-gray-900 leading-none mb-1.5">{{ number_format($artikelPublished) }}</p>
                                <p class="text-[13px] text-gray-500 font-medium">Dipublikasi</p>
                            </div>

                            {{-- Pending --}}
                            <div class="rounded-2xl p-6 flex flex-col items-center justify-center text-center" style="background-color: #fdfbf2;">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background-color: #fef08a;">
                                    <svg class="w-6 h-6 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <p class="text-[32px] font-bold text-gray-900 leading-none mb-1.5">{{ number_format($artikelPending) }}</p>
                                <p class="text-[13px] text-gray-500 font-medium">Pending</p>
                            </div>

                            {{-- Draft --}}
                            <div class="rounded-2xl p-6 flex flex-col items-center justify-center text-center" style="background-color: #f8f9fa;">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background-color: #e2e8f0;">
                                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                </div>
                                <p class="text-[32px] font-bold text-gray-900 leading-none mb-1.5">{{ number_format($artikelDraft) }}</p>
                                <p class="text-[13px] text-gray-500 font-medium">Draft</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Artikel dalam Kategori --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden info-card">
                    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                            <h3 class="text-lg font-bold text-gray-800">Artikel dalam Kategori</h3>
                        </div>
                        <div class="bg-blue-50 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full border border-blue-100">
                            {{ number_format($totalArtikel) }} artikel
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-16">#</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">JUDUL ARTIKEL</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-40">PENULIS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($latestArticles as $index => $article)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-500">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                @if ($article->description_image)
                                                    <img src="{{ asset('storage/' . $article->description_image) }}" class="w-12 h-12 object-cover rounded-lg border border-gray-100 shadow-sm flex-shrink-0">
                                                @else
                                                    <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0 text-gray-400">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <a href="{{ route('admin.berita.show', $article) }}" class="font-bold text-gray-800 hover:text-blue-600 line-clamp-1 transition-colors">{{ $article->title }}</a>
                                                    <p class="text-xs text-gray-500 mt-1">{{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : 'Draft' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                <span class="text-gray-600 text-xs font-medium">{{ $article->author ? $article->author->nama : 'Unknown' }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                                            <p class="text-sm font-medium text-gray-600">Belum ada artikel di kategori ini</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($totalArtikel > 5)
                        <div class="p-4 border-t border-gray-100 bg-gray-50/30 text-center">
                            <a href="{{ route('admin.berita.index', ['category' => $kategori->name]) }}" class="inline-flex items-center justify-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors gap-1.5">
                                Lihat Semua Artikel ({{ number_format($totalArtikel) }}) 
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Column (Sidebar) --}}
            <div class="space-y-6">
                
                {{-- Info Kategori Card --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 info-card">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <h3 class="text-lg font-bold text-gray-800">Info Kategori</h3>
                    </div>
                    
                    <div class="space-y-1 mt-2">
                        <div class="flex justify-between items-center py-2.5">
                            <span class="text-sm text-gray-500">ID Kategori</span>
                            <span class="text-sm font-bold text-gray-800">{{ $kategori->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2.5">
                            <span class="text-sm text-gray-500">Slug</span>
                            <span class="inline-block bg-gray-100 text-gray-600 px-2.5 py-1 rounded-md text-xs font-mono font-medium">{{ $kategori->slug }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2.5">
                            <span class="text-sm text-gray-500">Terdaftar</span>
                            <span class="text-sm font-bold text-gray-800">{{ $kategori->created_at->translatedFormat('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2.5">
                            <span class="text-sm text-gray-500">Terakhir Update</span>
                            <span class="text-sm font-bold text-gray-800">{{ $kategori->updated_at->translatedFormat('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Aksi Cepat Card --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 info-card">
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        <h3 class="text-lg font-bold text-gray-800">Aksi Cepat</h3>
                    </div>
                    
                    <div class="space-y-3 mt-2">
                        @if (auth()->user()->isAdmin())
                            <button @click="openEditModal({{ $kategori->id }}, '{{ addslashes($kategori->name) }}', '{{ addslashes($kategori->description) }}')" class="w-full flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm whitespace-nowrap" style="background-color: #1a56db;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                Edit Kategori
                            </button>
                            
                            <a href="{{ route('admin.berita.create', ['category_id' => $kategori->id]) }}" class="w-full flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-emerald-500 text-emerald-600 rounded-lg text-sm font-semibold hover:bg-emerald-50 transition-colors whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Tambah Artikel
                            </a>
                        @endif
                        
                        <a href="{{ route('admin.berita.index', ['category' => $kategori->name]) }}" class="w-full flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-cyan-500 text-cyan-600 rounded-lg text-sm font-semibold hover:bg-cyan-50 transition-colors whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                            Lihat Semua Artikel
                        </a>
                        
                        @if (auth()->user()->isSuperAdmin())
                            <form method="POST" action="{{ route('admin.kategori.destroy', $kategori) }}" class="block mt-4 pt-4 border-t border-gray-100">
                                @csrf @method('DELETE')
                                <button type="button" onclick="confirmDelete(this.closest('form'), 'Kategori ini akan dihapus secara permanen.')" class="w-full flex items-center justify-center gap-2 px-5 py-2.5 bg-white border border-red-500 text-red-600 rounded-lg text-sm font-semibold hover:bg-red-50 transition-colors whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Hapus Kategori
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        {{-- Edit Modal --}}
        <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center" style="z-index: 9999;" x-cloak>
            {{-- Backdrop --}}
            <div x-show="modalOpen" x-transition.opacity class="absolute inset-0" style="background-color: rgba(0, 0, 0, 0.65);" @click="closeModal()"></div>
            
            {{-- Modal Panel --}}
            <div x-show="modalOpen" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">
                
                {{-- Header --}}
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800">Edit Kategori</h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                {{-- Form --}}
                <form :action="formAction" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Kategori <span class="text-red-500">*</span></label>
                            <input type="text" name="name" x-model="formData.name" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Misal: Berita Wilayah">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                            <textarea name="description" x-model="formData.description" rows="3" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Deskripsi kategori (opsional)"></textarea>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button type="button" @click="closeModal()" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors" style="background-color: #1a56db;">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('kategoriDetailManager', () => ({
                modalOpen: false,
                formAction: '',
                formData: {
                    name: '',
                    description: ''
                },
                openEditModal(id, name, description) {
                    this.formAction = '{{ url('admin/kategori') }}/' + id;
                    this.formData.name = name;
                    this.formData.description = description;
                    this.modalOpen = true;
                },
                closeModal() {
                    this.modalOpen = false;
                }
            }));
        });
    </script>
@endpush
