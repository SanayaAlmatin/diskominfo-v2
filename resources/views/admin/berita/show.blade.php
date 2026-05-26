@extends('admin.layouts.admin')

@section('title', 'Detail Artikel')
@section('page-title', 'Detail Artikel')

@push('styles')
<style>
    /* Content styling */
    .article-content {
        line-height: 1.8;
        color: #374151;
        font-size: 0.95rem;
    }
    .article-content p {
        margin-bottom: 1.25rem;
    }
    .article-content strong {
        color: #111827;
        font-weight: 600;
    }
    .article-content a {
        color: #2563eb;
        text-decoration: none;
    }
    .article-content a:hover {
        text-decoration: underline;
    }
    .article-content ul, .article-content ol {
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    .article-content ul {
        list-style-type: disc;
    }
    .article-content ol {
        list-style-type: decimal;
    }
    .article-content blockquote {
        border-left: 4px solid #e5e7eb;
        padding-left: 1rem;
        font-style: italic;
        color: #6b7280;
        margin-bottom: 1.25rem;
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Artikel</h2>
            <p class="text-sm text-gray-500 mt-1">Lihat detail dan kelola artikel</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.berita.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition-colors text-sm font-semibold flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </a>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.berita.edit', $berita) }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm text-sm font-semibold flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    Edit
                </a>
            @endif
        </div>
    </div>

    {{-- Grid Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- KOLOM KIRI (Konten Utama) --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Main Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                
                {{-- Blue Header --}}
                <div class="bg-blue-600 px-6 py-8 text-white relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-500 opacity-90"></div>
                    <div class="relative z-10">
                        @if($berita->status == 1)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white mb-4 border border-white/30 backdrop-blur-sm">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Dipublikasi
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-black/20 text-white mb-4 border border-white/30 backdrop-blur-sm">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Draft
                            </span>
                        @endif
                        
                        <h1 class="text-2xl sm:text-3xl font-bold leading-tight mb-3">
                            {{ $berita->title }}
                        </h1>
                        @if($berita->subtitle)
                            <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                                {{ $berita->subtitle }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Stats Bar --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-gray-100 border-b border-gray-100 bg-gray-50/50">
                    <div class="px-4 py-4 text-center">
                        <p class="text-sm font-bold text-gray-800">{{ $berita->author ? $berita->author->nama : 'Unknown' }}</p>
                        <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mt-0.5">Penulis</p>
                    </div>
                    <div class="px-4 py-4 text-center">
                        <p class="text-sm font-bold text-gray-800">{{ $berita->category ? $berita->category->name : 'Uncategorized' }}</p>
                        <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mt-0.5">Kategori</p>
                    </div>
                    <div class="px-4 py-4 text-center">
                        <p class="text-sm font-bold text-gray-800">{{ number_format($berita->view_count ?? 0) }}</p>
                        <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mt-0.5">Views</p>
                    </div>
                    <div class="px-4 py-4 text-center">
                        <p class="text-sm font-bold text-gray-800">{{ $berita->created_at->translatedFormat('d M Y') }}</p>
                        <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mt-0.5">Dibuat</p>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-6 sm:p-8">
                    
                    {{-- Excerpt Box --}}
                    @if($berita->excerpt)
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-8 flex gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-gray-800 mb-1">Ringkasan</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">{{ $berita->excerpt }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Main Content --}}
                    <div class="article-content">
                        {!! $berita->content !!}
                    </div>

                    {{-- Galeri Gambar --}}
                    @if($berita->images && $berita->images->count() > 0)
                        <div class="mt-10 pt-8 border-t border-gray-100">
                            <div class="flex items-center gap-2 mb-4">
                                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <h3 class="font-bold text-gray-800">Galeri Gambar</h3>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach($berita->images as $image)
                                    <button onclick="openLightbox('{{ asset('storage/' . $image->image) }}')" class="block w-full text-left group relative rounded-xl overflow-hidden aspect-video bg-gray-100 border border-gray-200 cursor-pointer">
                                        <img src="{{ asset('storage/' . $image->image) }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" alt="Gallery Image">
                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Tags --}}
                    <div class="mt-8 pt-8 border-t border-gray-100">
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            <h3 class="font-bold text-gray-800">Tags</h3>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @forelse($berita->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                    {{ $tag->n_tag }}
                                </span>
                            @empty
                                <p class="text-sm text-gray-500 italic">Belum ada tag untuk artikel ini.</p>
                            @endforelse
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>

        {{-- KOLOM KANAN (Sidebar) --}}
        <div class="space-y-6">
            
            {{-- Status Workflow Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    <h3 class="font-bold text-gray-800">Status Workflow</h3>
                </div>
                <div class="p-6">
                    <div class="relative pl-2 space-y-6">
                        {{-- Timeline line --}}
                        <div class="absolute left-[19px] top-2 bottom-2 w-[2px] bg-gray-100"></div>

                        {{-- Draft Step (Always checked because it exists) --}}
                        <div class="relative flex items-start gap-4">
                            <div class="w-6 h-6 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center border-2 border-white ring-2 ring-emerald-50 text-emerald-600 z-10 mt-0.5 relative">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">Draft</p>
                                <p class="text-xs text-gray-500 mt-0.5">Artikel dibuat</p>
                            </div>
                        </div>

                        {{-- Published Step --}}
                        <div class="relative flex items-start gap-4">
                            @if($berita->status == 1)
                                <div class="w-6 h-6 rounded-full bg-emerald-100 flex-shrink-0 flex items-center justify-center border-2 border-white ring-2 ring-emerald-50 text-emerald-600 z-10 mt-0.5 relative">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Dipublikasi</p>
                                    @if($berita->published_at)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $berita->published_at->translatedFormat('d M Y, H:i') }} WIB</p>
                                    @endif
                                </div>
                            @else
                                <div class="w-6 h-6 rounded-full bg-gray-100 flex-shrink-0 flex items-center justify-center border-2 border-white ring-2 ring-gray-50 text-gray-400 z-10 mt-0.5 relative">
                                    <div class="w-2 h-2 rounded-full bg-gray-300"></div>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-400">Dipublikasi</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Belum dipublikasi</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Detail Artikel Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <h3 class="font-bold text-gray-800">Detail Artikel</h3>
                </div>
                <div class="p-5 space-y-5">
                    
                    {{-- ID --}}
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">ID Artikel</p>
                            <p class="text-sm font-bold text-gray-800">#{{ $berita->id }}</p>
                        </div>
                    </div>

                    {{-- Slug --}}
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Slug URL</p>
                            <div class="bg-gray-50 border border-gray-100 rounded px-2 py-1">
                                <p class="text-xs text-gray-600 font-mono break-all">{{ $berita->slug }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Penulis --}}
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Penulis</p>
                            <p class="text-sm font-bold text-gray-800">{{ $berita->author ? $berita->author->nama : 'Unknown' }}</p>
                            <p class="text-xs text-gray-500">Portal CMS</p>
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Tanggal Berita</p>
                            <p class="text-sm font-bold text-gray-800">
                                {{ $berita->published_at ? $berita->published_at->translatedFormat('l, d M Y') : '-' }}
                            </p>
                        </div>
                    </div>

                    {{-- Deskripsi Gambar --}}
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Deskripsi Gambar</p>
                            <p class="text-sm text-gray-800">
                                {{ $berita->image_caption ?: '-' }}
                            </p>
                        </div>
                    </div>

                    <div class="h-px bg-gray-100"></div>

                    {{-- Timestamps --}}
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Dibuat</p>
                            <p class="text-sm font-bold text-gray-800">{{ $berita->created_at->translatedFormat('d M Y, H:i') }} WIB</p>
                            <p class="text-xs text-gray-500">{{ $berita->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Terakhir Update</p>
                            <p class="text-sm font-bold text-gray-800">{{ $berita->updated_at->translatedFormat('d M Y, H:i') }} WIB</p>
                            <p class="text-xs text-gray-500">{{ $berita->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SEO Meta Tags Card --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <h3 class="font-bold text-gray-800">SEO Meta Tags</h3>
                </div>
                <div class="p-5 space-y-4">
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Meta Title</p>
                            <p class="text-sm font-bold text-gray-800">{{ $berita->meta_title ?: '-' }}</p>
                        </div>
                    </div>
                    
                    @if($berita->meta_description)
                    <div class="flex gap-3">
                        <div class="w-5 h-5 mt-0.5 text-gray-400 flex-shrink-0">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                        </div>
                        <div>
                            <p class="text-[11px] font-medium text-gray-500 uppercase tracking-wider mb-1">Meta Description</p>
                            <p class="text-sm text-gray-600">{{ $berita->meta_description }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>

{{-- Lightbox Modal --}}
<div id="imageLightbox" class="fixed inset-0 z-50 hidden bg-black/90 backdrop-blur-sm flex items-center justify-center transition-opacity" onclick="closeLightbox()">
    <button class="absolute top-6 right-6 text-white hover:text-gray-300 transition-colors" onclick="closeLightbox()">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
    </button>
    <img id="lightboxImage" src="" class="max-h-[90vh] max-w-[90vw] object-contain rounded-lg shadow-2xl transition-transform duration-300 scale-95" alt="Preview Image">
</div>

@push('scripts')
<script>
    // Lightbox Functions
    function openLightbox(src) {
        const lightbox = document.getElementById('imageLightbox');
        const img = document.getElementById('lightboxImage');
        img.src = src;
        lightbox.classList.remove('hidden');
        // Animate in
        setTimeout(() => {
            img.classList.remove('scale-95');
            img.classList.add('scale-100');
        }, 10);
    }

    function closeLightbox() {
        const lightbox = document.getElementById('imageLightbox');
        const img = document.getElementById('lightboxImage');
        // Animate out
        img.classList.remove('scale-100');
        img.classList.add('scale-95');
        setTimeout(() => {
            lightbox.classList.add('hidden');
        }, 200);
    }

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !document.getElementById('imageLightbox').classList.contains('hidden')) {
            closeLightbox();
        }
    });
</script>
@endpush

@endsection
