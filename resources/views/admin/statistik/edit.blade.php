@extends('admin.layouts.admin')
@section('title', 'Kelola Bidang Statistik')
@section('page-title', 'Kelola Bidang Statistik')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.statistik.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Kelola: {{ $bidang->n_bidang }}</h2>
        </div>

        {{-- Edit Nama Bidang --}}
        @if (auth()->user()->isAdmin())
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-lg">
                <h3 class="text-sm font-bold text-gray-700 mb-4">Edit Nama Bidang</h3>
                <form method="POST" action="{{ route('admin.statistik.update', $bidang) }}"
                    class="flex flex-col sm:flex-row gap-3">
                    @csrf @method('PUT')
                    <input type="text" name="n_bidang" value="{{ old('n_bidang', $bidang->n_bidang) }}" maxlength="50"
                        class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                        class="px-5 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90 whitespace-nowrap"
                        style="background-color: #0F2044;">Simpan</button>
                </form>
                @error('n_bidang')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        {{-- File list --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex flex-wrap items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-700">File Publikasi ({{ count($files) }})</h3>
                @if (auth()->user()->isAdmin())
                    <button onclick="document.getElementById('add-file-form').classList.toggle('hidden')"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold text-white hover:opacity-90"
                        style="background-color: #0F2044;">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah File
                    </button>
                @endif
            </div>

            @if (auth()->user()->isAdmin())
                <div id="add-file-form" class="hidden border-b border-gray-100 bg-gray-50 p-5">
                    <form method="POST" action="{{ route('admin.statistik.storeFile', $bidang) }}"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Nama File <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="n_file" value="{{ old('n_file') }}"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Nama tampilan file">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">File <span
                                        class="text-red-500">*</span></label>
                                <div x-data="{
                                    fileName: '',
                                    dragging: false,
                                    handleFile(e) {
                                        const file = e.target.files[0];
                                        if (!file) return;
                                        this.fileName = file.name;
                                    },
                                    handleDrop(e) {
                                        this.dragging = false;
                                        const file = e.dataTransfer.files[0];
                                        if (!file) return;
                                        const dt = new DataTransfer();
                                        dt.items.add(file);
                                        this.$refs.fileInput.files = dt.files;
                                        this.fileName = file.name;
                                    },
                                    clear() {
                                        this.fileName = '';
                                        this.$refs.fileInput.value = '';
                                    }
                                }" @dragover.prevent="dragging = true"
                                    @dragleave.prevent="dragging = false" @drop.prevent="handleDrop($event)"
                                    :class="dragging ? 'border-[#0F2044] bg-blue-50/40' : ''"
                                    class="border-2 border-dashed border-gray-200 rounded-xl transition-all duration-200 overflow-hidden hover:border-[#0F2044]/40 hover:bg-slate-50/50">
                                    <input type="file" x-ref="fileInput" name="file_path"
                                        accept=".pdf,.xlsx,.xls,.csv,.doc,.docx" class="hidden"
                                        @change="handleFile($event)">

                                    <div x-show="!fileName" @click="$refs.fileInput.click()"
                                        class="py-5 px-4 text-center cursor-pointer select-none">
                                        <div class="mx-auto w-9 h-9 rounded-xl flex items-center justify-center mb-2"
                                            style="background-color: rgba(15,32,68,0.07);">
                                            <svg class="w-4.5 h-4.5" style="color: rgba(15,32,68,0.5);" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                            </svg>
                                        </div>
                                        <p class="text-xs font-semibold text-gray-600">Klik atau seret file</p>
                                        <p class="text-xs text-gray-400 mt-0.5">PDF, Excel, Word, CSV</p>
                                    </div>

                                    <div x-show="fileName" class="px-3 py-2.5" style="display:none;">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                                                style="background-color: rgba(15,32,68,0.07);">
                                                <svg class="w-4 h-4" style="color: #0F2044;" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                            </div>
                                            <p class="text-xs font-medium text-gray-700 flex-1 truncate" x-text="fileName">
                                            </p>
                                            <button type="button" @click.stop="$refs.fileInput.click()"
                                                class="text-xs font-bold px-2.5 py-1 rounded-lg text-white hover:opacity-90 transition-all flex-shrink-0"
                                                style="background-color: #0F2044;">Ganti</button>
                                            <button type="button" @click.stop="clear()"
                                                class="text-xs font-semibold px-2.5 py-1 rounded-lg text-gray-500 bg-gray-100 hover:bg-gray-200 transition-all flex-shrink-0">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                class="px-5 py-2 rounded-lg text-xs font-bold text-white hover:opacity-90"
                                style="background-color: #0F2044;">Upload & Simpan</button>
                        </div>
                    </form>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama File</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Path</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($files as $file)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $file->deskripsi }}</td>
                                <td class="px-4 py-3 text-gray-500 text-xs">
                                    <a href="{{ Storage::url($file->file) }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        Lihat File
                                    </a>
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right">
                                        @if (auth()->user()->isSuperAdmin())
                                            <form method="POST"
                                                action="{{ route('admin.statistik.destroyFile', [$bidang, $file]) }}">
                                                @csrf @method('DELETE')
                                                <button type="button"
                                                    onclick="confirmDelete(this.closest('form'), 'File statistik yang dihapus tidak dapat dikembalikan.')"
                                                    class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-gray-400 text-sm">Belum ada file di
                                    bidang
                                    ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
