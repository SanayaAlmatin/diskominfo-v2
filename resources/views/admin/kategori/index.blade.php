@extends('admin.layouts.admin')

@section('title', 'Manajemen Kategori')
@section('page-title', 'Kelola Kategori')

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
    <div class="space-y-6 max-w-7xl mx-auto" x-data="kategoriManager()">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 text-white p-2 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Kelola Kategori</h2>
                    <p class="text-sm text-gray-500 mt-0.5">Manajemen kategori artikel</p>
                </div>
            </div>
            @if (auth()->user()->isAdmin())
                <button @click="openModal()" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm" style="background-color: #1a56db;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Kategori
                </button>
            @endif
        </div>

        {{-- Custom Filter Bar --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex flex-col lg:flex-row gap-4 items-end">
            <div class="flex-1 w-full lg:w-auto">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>Cari Kategori</label>
                <input type="text" id="customSearch" placeholder="Cari berdasarkan nama kategori..." class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="flex gap-2 w-full lg:w-auto">
                <button type="button" id="btnFilter" class="flex-1 lg:flex-none px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2" style="background-color: #1a56db;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    Filter
                </button>
                <button type="button" id="btnReset" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center gap-2" title="Reset Filter">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Reset
                </button>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            {{-- Card 1: Total Kategori --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalKategori) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Kategori</p>
                </div>
            </div>
            
            {{-- Card 2: Total Artikel --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalArtikel) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Artikel</p>
                </div>
            </div>

            {{-- Card 3: Hari Ini --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($artikelHariIni) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Hari Ini</p>
                </div>
            </div>

            {{-- Card 4: Minggu Ini --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($artikelMingguIni) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Minggu Ini</p>
                </div>
            </div>
        </div>

        {{-- Main Container --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden p-5">
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table id="table-kategori" class="w-full text-sm">
                    <thead class="border-b border-gray-100 bg-white">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-64">KATEGORI</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">DESKRIPSI</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-32">ARTIKEL</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-40">TANGGAL DIBUAT</th>
                            <th data-orderable="false" class="px-4 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider w-32">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($categories as $item)
                            <tr class="hover:bg-blue-50/20 transition-colors group">
                                {{-- Kategori Column --}}
                                <td class="px-4 py-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" /></svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm">{{ $item->name }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">{{ $item->slug }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Deskripsi Column --}}
                                <td class="px-4 py-4 align-middle text-gray-600 text-sm">
                                    {{ $item->description ?: '-' }}
                                </td>

                                {{-- Artikel Column --}}
                                <td class="px-4 py-4 align-middle">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-sm font-bold bg-blue-50 text-blue-800 border border-blue-100">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        {{ $item->news_count }} <span class="font-normal text-blue-600">artikel</span>
                                    </span>
                                </td>

                                {{-- Tanggal Column --}}
                                <td class="px-4 py-4 align-middle" data-sort="{{ $item->created_at->timestamp }}">
                                    <p class="text-sm font-bold text-gray-800">{{ $item->created_at->translatedFormat('d M Y') }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $item->created_at->format('H:i') }} WIB</p>
                                </td>

                                {{-- Aksi Column --}}
                                <td class="px-4 py-4 align-middle">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('admin.kategori.show', $item) }}" class="action-btn w-8 h-8 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100 hover:text-emerald-700" title="Detail Kategori">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>
                                        @if (auth()->user()->isAdmin())
                                            <button @click="openModal({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->description) }}')" class="action-btn w-8 h-8 rounded bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </button>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.kategori.destroy', $item) }}" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button" onclick="confirmDelete(this.closest('form'), 'Kategori ini akan dihapus secara permanen.')" class="action-btn w-8 h-8 rounded bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-100 hover:text-orange-600" title="Hapus">
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

        {{-- Modal --}}
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
                    <h3 class="text-lg font-bold text-gray-800" x-text="isEdit ? 'Edit Kategori' : 'Tambah Kategori'"></h3>
                    <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                {{-- Form --}}
                <form :action="formAction" method="POST">
                    @csrf
                    <template x-if="isEdit">
                        @method('PUT')
                    </template>
                    
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
                            Simpan
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
            Alpine.data('kategoriManager', () => ({
                modalOpen: false,
                isEdit: false,
                formAction: '{{ route('admin.kategori.store') }}',
                formData: {
                    name: '',
                    description: ''
                },
                openModal(id = null, name = '', description = '') {
                    if (id) {
                        this.isEdit = true;
                        this.formAction = '{{ url('admin/kategori') }}/' + id;
                        this.formData.name = name;
                        this.formData.description = description;
                    } else {
                        this.isEdit = false;
                        this.formAction = '{{ route('admin.kategori.store') }}';
                        this.formData.name = '';
                        this.formData.description = '';
                    }
                    this.modalOpen = true;
                },
                closeModal() {
                    this.modalOpen = false;
                }
            }));
        });

        $(document).ready(function() {
            // Inisialisasi DataTable
            var table = $('#table-kategori').DataTable({
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
                    emptyTable: "Belum ada data kategori.",
                    zeroRecords: "Tidak ditemukan kategori yang sesuai."
                },
                columnDefs: [
                    { orderable: false, targets: [4] } // Nonaktifkan sorting pada Aksi
                ],
                order: [[3, 'desc']] // Urutkan berdasarkan Tanggal Dibuat descending defaultnya
            });

            // Fungsionalitas Custom Filter
            $('#btnFilter').on('click', function() {
                var search = $('#customSearch').val();
                table.search(search).draw();
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
                table.search('').columns().search('').draw();
            });
        });
    </script>
@endpush
