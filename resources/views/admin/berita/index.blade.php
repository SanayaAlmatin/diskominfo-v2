@extends('admin.layouts.admin')

@section('title', 'Manajemen Berita')
@section('page-title', 'Manajemen Berita')

@push('styles')
<style>
    /* Custom Pagination Styling to match reference */
    .dt-paging-button {
        padding: 0.35rem 0.75rem !important;
        margin: 0 0.15rem !important;
        border-radius: 0.375rem !important;
        border: 1px solid #e5e7eb !important;
        font-size: 0.875rem !important;
        color: #4b5563 !important;
        background: #fff !important;
    }
    .dt-paging-button.current {
        background: #3b82f6 !important;
        color: #fff !important;
        border-color: #3b82f6 !important;
        font-weight: 600 !important;
    }
    .dt-paging-button:hover:not(.current) {
        background: #f9fafb !important;
    }
    .dt-info {
        font-size: 0.875rem;
        color: #6b7280;
    }
    /* Action Buttons Hover */
    .action-btn {
        transition: all 0.2s ease;
    }
    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>
@endpush

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kelola Artikel</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola semua artikel dalam sistem</p>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.berita.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm" style="background-color: #1a56db;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Buat Artikel
                </a>
            @endif
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {{-- Card 1: Total --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalBerita) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Artikel</p>
                </div>
            </div>
            
            {{-- Card 2: Draft --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalDraft) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Draft</p>
                </div>
            </div>

            {{-- Card 3: Published --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalPublished) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Dipublikasi</p>
                </div>
            </div>

            {{-- Card 4: Headline --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalHeadline) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Headline</p>
                </div>
            </div>
        </div>

        {{-- Main Container --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            
            {{-- Custom Filter Bar --}}
            <div class="p-5 border-b border-gray-100 bg-gray-50/50 flex flex-col lg:flex-row gap-4 items-end">
                <div class="flex-1 w-full lg:w-auto">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>Cari Artikel</label>
                    <input type="text" id="customSearch" placeholder="Cari judul, konten..." class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="w-full lg:w-48">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>Status</label>
                    <select id="customStatus" class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none">
                        <option value="">Semua Status</option>
                        <option value="Published">Published</option>
                        <option value="Draft">Draft</option>
                    </select>
                </div>
                <div class="w-full lg:w-48">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002 2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>Kategori</label>
                    <select id="customCategory" class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2 w-full lg:w-auto">
                    <button type="button" id="btnFilter" class="flex-1 lg:flex-none px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        Filter
                    </button>
                    <button type="button" id="btnReset" class="px-3 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center" title="Reset Filter">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    </button>
                </div>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto p-5">
                <table id="table-berita" class="w-full text-sm">
                    <thead class="bg-gray-50/80 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ARTIKEL</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-28">KATEGORI</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-40">PENULIS</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-28">STATUS</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-36">TANGGAL</th>
                            <th data-orderable="false" class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider w-32">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($items as $item)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                {{-- Artikel Column --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-start gap-4">
                                        {{-- Image Thumbnail --}}
                                        <div class="flex-shrink-0 relative">
                                            @if ($item->description_image)
                                                <img src="{{ asset('storage/' . $item->description_image) }}" alt="{{ $item->title }}" class="w-24 h-24 object-cover rounded-lg border border-gray-100 shadow-sm cursor-pointer hover:opacity-90 transition-opacity" onclick="openLightbox(this.src)">
                                            @else
                                                <div class="w-24 h-24 rounded-lg bg-gray-100 border border-gray-200 flex flex-col items-center justify-center text-gray-400">
                                                    <svg class="w-8 h-8 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    <span class="text-[10px] font-medium">No Image</span>
                                                </div>
                                            @endif
                                            @if($item->is_headline)
                                                <div class="absolute -top-2 -right-2 bg-amber-500 text-white p-1 rounded-full shadow-sm" title="Headline">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        {{-- Content Info --}}
                                        <div class="flex-1 min-w-0">
                                            <p class="font-bold text-gray-800 text-sm line-clamp-2 leading-tight group-hover:text-blue-600 transition-colors">{{ $item->title }}</p>
                                            <p class="text-[13px] text-gray-500 mt-1 line-clamp-1" title="{{ $item->excerpt ?? $item->subtitle }}">{{ $item->excerpt ?? $item->subtitle ?? 'Tidak ada ringkasan.' }}</p>
                                            
                                            <div class="flex items-center flex-wrap gap-x-3 gap-y-1 mt-2.5">
                                                <div class="flex items-center text-xs text-gray-400 font-medium">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                                    {{ number_format($item->view_count ?? 0) }}
                                                </div>
                                                <div class="flex items-center text-[11px] font-medium text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded gap-1 max-w-[200px] overflow-hidden whitespace-nowrap text-ellipsis">
                                                    <span class="text-blue-500 font-bold">#</span>
                                                    @if($item->tags && $item->tags->count() > 0)
                                                        {{ $item->tags->take(2)->pluck('n_tag')->join(', ') }}
                                                        @if($item->tags->count() > 2)
                                                            <span class="text-gray-400">+{{ $item->tags->count() - 2 }}</span>
                                                        @endif
                                                    @else
                                                        Tanpa Tag
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kategori Column --}}
                                <td class="px-4 py-4 align-top pt-5">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100 whitespace-nowrap">
                                        {{ $item->category ? $item->category->name : 'Uncategorized' }}
                                    </span>
                                </td>

                                {{-- Penulis Column --}}
                                <td class="px-4 py-4 align-top pt-5">
                                    <p class="text-sm font-bold text-gray-800">{{ $item->author ? $item->author->nama : 'Unknown' }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Portal CMS</p>
                                </td>

                                {{-- Status Column --}}
                                <td class="px-4 py-4 align-top pt-5">
                                    @if($item->status == 1)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                            Dipublikasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                {{-- Tanggal Column --}}
                                <td class="px-4 py-4 align-top pt-5" data-sort="{{ $item->published_at ? $item->published_at->timestamp : 0 }}">
                                    @if($item->published_at)
                                        <p class="text-sm font-bold text-gray-800">{{ $item->published_at->translatedFormat('d M Y') }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $item->published_at->format('H:i') }} WIB</p>
                                        <div class="flex items-center gap-1 mt-1 text-[10px] text-emerald-600 font-medium">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                            {{ $item->created_at->translatedFormat('d M Y') }}
                                        </div>
                                    @else
                                        <p class="text-sm font-bold text-gray-500">-</p>
                                    @endif
                                </td>

                                {{-- Aksi Column --}}
                                <td class="px-4 py-4 align-top pt-5">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.berita.show', $item) }}" class="action-btn w-8 h-8 rounded bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700" title="Preview">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>
                                        @if (auth()->user()->isAdmin())
                                            <a href="{{ route('admin.berita.edit', $item) }}" class="action-btn w-8 h-8 rounded bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.berita.destroy', $item) }}" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button" onclick="confirmDelete(this.closest('form'), 'Artikel ini akan dihapus secara permanen.')" class="action-btn w-8 h-8 rounded bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-100 hover:text-orange-600" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#table-berita').DataTable({
                layout: {
                    topStart: null,
                    topEnd: null,
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                },
                language: {
                    info: "_START_ - _END_ dari _TOTAL_",
                    infoEmpty: "0 dari 0",
                    infoFiltered: "",
                    emptyTable: "Belum ada data artikel.",
                    zeroRecords: "Tidak ditemukan artikel yang sesuai."
                },
                columnDefs: [
                    { orderable: false, targets: [0, 5] } // Nonaktifkan sorting pada Artikel dan Aksi
                ],
                order: [[4, 'desc']] // Urutkan berdasarkan Tanggal descending defaultnya
            });

            // Fungsionalitas Custom Filter
            $('#btnFilter').on('click', function() {
                var search = $('#customSearch').val();
                var status = $('#customStatus').val();
                var category = $('#customCategory').val();

                table.search(search);
                table.column(3).search(status); // Status ada di kolom ke-4 (index 3)
                table.column(1).search(category); // Kategori ada di kolom ke-2 (index 1)
                
                table.draw();
            });

            // Trigger filter saat enter di input pencarian
            $('#customSearch').on('keyup', function(e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    $('#btnFilter').click();
                }
            });

            // Fungsi Reset
            $('#btnReset').on('click', function() {
                $('#customSearch').val('');
                $('#customStatus').val('');
                $('#customCategory').val('');
                
                table.search('').columns().search('').draw();
            });
        });
    </script>
@endpush
