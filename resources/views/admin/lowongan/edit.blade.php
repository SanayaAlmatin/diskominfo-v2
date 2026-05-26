@extends('admin.layouts.admin')
@section('title', 'Edit Kegiatan')
@section('page-title', 'Edit Kegiatan')

@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.lowongan.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Edit Kegiatan: {{ $lowongan->posisi }}</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.lowongan.update', $lowongan) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                {{-- Baris 1: Posisi + Jenis --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Posisi / Judul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="posisi" value="{{ old('posisi', $lowongan->posisi) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('posisi') border-red-400 @enderror"
                            placeholder="Contoh: Fullstack Developer">
                        @error('posisi')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Jenis <span class="text-red-500">*</span>
                        </label>
                        <div x-data="{ 
                            open: false, 
                            selectedId: '{{ old('id_jenis', $lowongan->id_jenis) }}',
                            selectedName: '{{ old('id_jenis', $lowongan->id_jenis) ? addslashes($jenisList->firstWhere('id', old('id_jenis', $lowongan->id_jenis))?->nama) : '-- Pilih Jenis --' }}',
                            selectedColor: '{{ old('id_jenis', $lowongan->id_jenis) ? $jenisList->firstWhere('id', old('id_jenis', $lowongan->id_jenis))?->warna : '' }}',
                            selectOption(id, name, color) {
                                this.selectedId = id;
                                this.selectedName = name;
                                this.selectedColor = color;
                                this.open = false;
                            }
                        }" class="relative">
                            <input type="hidden" name="id_jenis" x-model="selectedId">
                            
                            <button type="button" @click="open = !open" @click.outside="open = false" 
                                class="w-full flex items-center justify-between px-4 py-[9px] rounded-lg border text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors {{ $errors->has('id_jenis') ? 'border-red-400' : 'border-gray-300' }} bg-white">
                                
                                <template x-if="selectedId">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold border" :class="selectedColor" x-text="selectedName"></span>
                                </template>
                                <template x-if="!selectedId">
                                    <span class="text-gray-500" x-text="selectedName"></span>
                                </template>

                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>

                            <div x-show="open" x-transition x-cloak class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg overflow-auto max-h-60 p-3">
                                <button type="button" @click="selectOption('', '-- Pilih Jenis --', '')" class="w-full text-left px-2 py-1.5 mb-2 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-md transition-colors border border-transparent hover:border-gray-200">
                                    -- Pilih Jenis --
                                </button>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($jenisList as $jenis)
                                        <button type="button" @click="selectOption('{{ $jenis->id }}', '{{ addslashes($jenis->nama) }}', '{{ $jenis->warna }}')" 
                                            class="hover:scale-105 transition-transform">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold border cursor-pointer shadow-sm {{ $jenis->warna }}">
                                                {{ $jenis->nama }}
                                            </span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @error('id_jenis')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Baris 2: Lokasi + Tipe Kerja --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $lowongan->lokasi) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: Tangerang Selatan">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tipe Kerja</label>
                        <input type="text" name="tipe_kerja" value="{{ old('tipe_kerja', $lowongan->tipe_kerja) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Contoh: Penuh Waktu / 3 Bulan / Daring">
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="tinymce-editor-simple w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Deskripsi singkat posisi atau program...">{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tags --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tags / Keahlian
                        <span class="text-xs font-normal text-gray-400 ml-1">(pisahkan dengan koma)</span>
                    </label>
                    <input type="text" name="tags"
                        value="{{ old('tags', is_array($lowongan->tags) ? implode(', ', $lowongan->tags) : '') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Contoh: Laravel, Vue.js, PostgreSQL">
                    <p class="mt-1 text-xs text-gray-400">Contoh: Laravel, Vue.js, PostgreSQL</p>
                </div>

                {{-- Baris 3: Tanggal Tutup + Link Daftar --}}
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal Tutup Pendaftaran</label>
                        <input type="date" name="tanggal_tutup"
                            value="{{ old('tanggal_tutup', $lowongan->tanggal_tutup?->format('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Link Pendaftaran</label>
                        <input type="url" name="link_daftar" value="{{ old('link_daftar', $lowongan->link_daftar) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="https://...">
                        @error('link_daftar')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Gambar Banner --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Banner</label>
                    @if ($lowongan->gambar)
                        <div class="flex items-center gap-3 p-3 mb-3 bg-gray-50 rounded-xl border border-gray-100">
                            <img src="{{ Storage::url($lowongan->gambar) }}"
                                class="h-14 w-14 rounded-lg object-cover flex-shrink-0"
                                style="box-shadow: 0 2px 8px rgba(15,32,68,0.12);" alt="">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-700">Gambar saat ini</p>
                                <p class="text-xs text-gray-400 truncate mt-0.5">{{ basename($lowongan->gambar) }}</p>
                            </div>
                            <span class="text-xs text-gray-400 italic whitespace-nowrap">Upload baru untuk mengganti</span>
                        </div>
                    @endif
                    <div x-data="{
                            fileName: '',
                            previewUrl: '',
                            dragging: false,
                            handleFile(e) {
                                const file = e.target.files[0];
                                if (!file) return;
                                this.fileName = file.name;
                                this.previewUrl = URL.createObjectURL(file);
                            },
                            handleDrop(e) {
                                this.dragging = false;
                                const file = e.dataTransfer.files[0];
                                if (!file) return;
                                const dt = new DataTransfer();
                                dt.items.add(file);
                                this.$refs.fileInput.files = dt.files;
                                this.fileName = file.name;
                                this.previewUrl = URL.createObjectURL(file);
                            },
                            clear() {
                                this.fileName = '';
                                this.previewUrl = '';
                                this.$refs.fileInput.value = '';
                            }
                        }" @dragover.prevent="dragging = true" @dragleave.prevent="dragging = false"
                        @drop.prevent="handleDrop($event)"
                        :class="dragging ? 'border-[#0F2044] bg-blue-50/40 scale-[1.005]' : ''"
                        class="border-2 border-dashed border-gray-200 rounded-xl transition-all duration-200 overflow-hidden hover:border-[#0F2044]/40 hover:bg-slate-50/50">
                        <input type="file" x-ref="fileInput" name="gambar" accept="image/*" class="hidden"
                            @change="handleFile($event)">

                        <div x-show="!previewUrl" @click="$refs.fileInput.click()"
                            class="py-9 px-6 text-center cursor-pointer select-none">
                            <div class="mx-auto w-12 h-12 rounded-2xl flex items-center justify-center mb-3"
                                style="background-color: rgba(15,32,68,0.07);">
                                <svg class="w-6 h-6" style="color: rgba(15,32,68,0.5);" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-700">Klik atau seret gambar ke sini</p>
                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP &middot; Maks. 2MB</p>
                        </div>

                        <div x-show="previewUrl" class="p-4" style="display:none;">
                            <div class="flex items-center gap-4">
                                <img :src="previewUrl" alt=""
                                    class="h-20 w-20 rounded-xl object-cover flex-shrink-0"
                                    style="box-shadow: 0 4px 12px rgba(15,32,68,0.15);">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-800 truncate" x-text="fileName"></p>
                                    <p class="text-xs text-emerald-600 font-medium mt-0.5">Siap diunggah</p>
                                </div>
                                <div class="flex flex-col gap-2 flex-shrink-0">
                                    <button type="button" @click="$refs.fileInput.click()"
                                        class="px-4 py-1.5 rounded-lg text-xs font-bold text-white hover:opacity-90 transition-all"
                                        style="background-color: #0F2044;">Ganti</button>
                                    <button type="button" @click="clear()"
                                        class="px-4 py-1.5 rounded-lg text-xs font-semibold text-gray-500 bg-gray-100 hover:bg-gray-200 transition-all">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="mt-1.5 text-xs text-gray-400">Format: JPG, PNG, WebP. Maks. 2MB.</p>
                    @error('gambar')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="buka"
                                {{ old('status', $lowongan->status) === 'buka' ? 'checked' : '' }}
                                class="w-4 h-4 text-green-600 border-gray-300">
                            <span class="text-sm text-gray-700">Buka</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="tutup"
                                {{ old('status', $lowongan->status) === 'tutup' ? 'checked' : '' }}
                                class="w-4 h-4 text-red-500 border-gray-300">
                            <span class="text-sm text-gray-700">Tutup</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90 transition-all"
                        style="background-color: #0F2044;">Simpan Perubahan</button>
                    <a href="{{ route('admin.lowongan.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
