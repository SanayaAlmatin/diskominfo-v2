@extends('admin.layouts.admin')

@section('title', 'Buat Artikel Baru')
@section('page-title', 'Buat Artikel Baru')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--multiple {
            min-height: 42px;
            border-radius: 0.5rem;
            border-color: #d1d5db;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            display: none !important; /* Hide default tags inside input */
        }
    </style>
@endpush

@section('content')
    <form method="POST" action="{{ route('admin.berita.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="max-w-7xl mx-auto">
            
            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-500 text-white p-2.5 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Buat Artikel Baru</h2>
                        <p class="text-sm text-gray-500">Tulis artikel berita yang menarik dan informatif</p>
                    </div>
                </div>
                <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors flex items-center gap-2 bg-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Kiri (Col-span-2) --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Konten Artikel Card --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-5">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            <h3 class="text-base font-bold text-gray-800">Konten Artikel</h3>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Artikel <span class="text-red-500">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-400 @enderror"
                                    placeholder="Masukkan judul artikel yang menarik...">
                                @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sub Judul</label>
                                <input type="text" name="subtitle" value="{{ old('subtitle') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('subtitle') border-red-400 @enderror"
                                    placeholder="Sub judul artikel (opsional)">
                                @error('subtitle')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Isi Artikel <span class="text-red-500">*</span></label>
                                <textarea name="content" id="content-editor" rows="15"
                                    class="tinymce-editor w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm @error('content') border-red-400 @enderror">{{ old('content') }}</textarea>
                                @error('content')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <label class="block text-sm font-semibold text-gray-700">Ringkasan Artikel</label>
                                    <button type="button" id="btn-generate-ringkasan" class="text-xs font-semibold px-3 py-1 bg-blue-50 text-blue-600 rounded flex items-center gap-1 hover:bg-blue-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                                        Generate Otomatis
                                    </button>
                                </div>
                                <textarea name="excerpt" id="excerpt-field" rows="3"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('excerpt') border-red-400 @enderror"
                                    placeholder="Ringkasan singkat artikel (akan dibuat otomatis jika kosong)">{{ old('excerpt') }}</textarea>
                                <p class="mt-1 text-xs text-gray-400"><svg class="w-3.5 h-3.5 inline mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Maksimal 500 karakter. Klik tombol "Generate Otomatis" untuk membuat dari isi artikel.</p>
                                @error('excerpt')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Gambar Artikel Card --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-5">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <h3 class="text-base font-bold text-gray-800">Gambar Artikel</h3>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Gambar <span class="text-red-500">*</span></label>
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
                                    :class="dragging ? 'border-blue-400 bg-blue-50/50 scale-[1.01]' : 'border-gray-200'"
                                    class="border-2 border-dashed rounded-xl transition-all duration-200 overflow-hidden hover:border-blue-400 hover:bg-slate-50/50">

                                    <input type="file" x-ref="fileInput" name="description_image" accept="image/*" class="hidden" @change="handleFile($event)">

                                    <div x-show="!previewUrl" @click="$refs.fileInput.click()" class="py-10 px-6 text-center cursor-pointer select-none">
                                        <div class="mx-auto w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                                        </div>
                                        <p class="text-sm font-semibold text-gray-700">Belum ada gambar yang diupload</p>
                                        <p class="text-xs text-gray-400 mt-1">Pilih file untuk memulai upload</p>
                                    </div>

                                    <div x-show="previewUrl" class="p-4" style="display:none;">
                                        <div class="flex flex-col items-center gap-3">
                                            <img :src="previewUrl" alt="" class="max-h-48 rounded-lg object-contain" style="box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                                            <div class="flex items-center gap-2">
                                                <p class="text-xs font-semibold text-gray-800" x-text="fileName"></p>
                                                <button type="button" @click="clear()" class="text-xs text-red-500 hover:text-red-700 font-medium">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-1.5 text-xs text-gray-400"><svg class="w-3.5 h-3.5 inline mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Upload gambar. Format: JPG, JPEG, PNG (max 2MB).</p>
                                @error('description_image')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Gambar</label>
                                <input type="text" name="image_caption" value="{{ old('image_caption') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image_caption') border-red-400 @enderror"
                                    placeholder="Masukkan deskripsi gambar (opsional)">
                                <p class="mt-1 text-xs text-gray-400"><svg class="w-3.5 h-3.5 inline mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg> Keterangan atau caption untuk gambar artikel</p>
                                @error('image_caption')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                        </div>
                    </div>

                </div>

                {{-- Kanan (Col-span-1) --}}
                <div class="space-y-6">
                    
                    {{-- Pengaturan Publikasi --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-5">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            <h3 class="text-base font-bold text-gray-800">Pengaturan Publikasi</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tanggal & Waktu <span class="text-red-500">*</span></label>
                                <input type="datetime-local" name="published_at" value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('published_at') border-red-400 @enderror">
                                @error('published_at')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span class="text-red-500">*</span></label>
                                <select name="category_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 bg-white @error('category_id') border-red-400 @enderror">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div class="pt-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="hidden" name="is_headline" value="0">
                                    <input type="checkbox" name="is_headline" value="1" {{ old('is_headline') ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="text-sm font-medium text-gray-700">Jadikan Headline</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Tag Artikel --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-5">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            <h3 class="text-base font-bold text-gray-800">Tag Artikel</h3>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Cari atau Tambah Tag</label>
                            <select name="tags[]" id="tags-select" multiple="multiple" class="w-full">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ (is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'selected' : '' }}>{{ $tag->n_tag }}</option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-gray-400 mb-3"><svg class="w-3.5 h-3.5 inline mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Ketik nama tag dan tekan Enter, atau pilih dari daftar</p>
                            
                            {{-- Custom Container untuk Tag Terpilih --}}
                            <div id="selected-tags-container" class="flex flex-wrap gap-2 mt-1"></div>

                            @error('tags')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- SEO Meta --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-5">
                            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            <h3 class="text-base font-bold text-gray-800">SEO Meta</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('meta_title') border-red-400 @enderror"
                                    placeholder="Meta title untuk SEO">
                                @error('meta_title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Meta Description</label>
                                <textarea name="meta_description" rows="3"
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none @error('meta_description') border-red-400 @enderror"
                                    placeholder="Meta description untuk SEO">{{ old('meta_description') }}</textarea>
                                @error('meta_description')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Aksi --}}
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
                        <div class="flex items-center gap-2 mb-5">
                            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <h3 class="text-base font-bold text-gray-800">Aksi</h3>
                        </div>

                        <div class="space-y-3">
                            <button type="submit" name="status" value="0" class="w-full px-4 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 flex items-center justify-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                Simpan sebagai Draft
                            </button>
                            <button type="submit" name="status" value="1" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 flex items-center justify-center gap-2 transition-colors" style="background-color: #0F2044;">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                                Kirim / Publish Artikel
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tags-select').select2({
                placeholder: "Ketik nama tag...",
                allowClear: false,
                tags: true // Allow creating new tags if necessary
            });

            // Sinkronisasi tag terpilih ke container di bawah
            function renderTags() {
                let container = $('#selected-tags-container');
                container.empty();
                let selectedData = $('#tags-select').select2('data');
                selectedData.forEach(function(item) {
                    let tagHtml = `
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                            ${item.text}
                            <button type="button" class="ml-2 focus:outline-none hover:text-blue-900" onclick="removeCustomTag('${item.id}')">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </span>
                    `;
                    container.append(tagHtml);
                });
            }

            window.removeCustomTag = function(id) {
                let select = $('#tags-select');
                let currentVal = select.val() || [];
                let newVal = currentVal.filter(val => val != id);
                select.val(newVal).trigger('change');
            };

            $('#tags-select').on('change', function() {
                renderTags();
            });

            // Initial render
            renderTags();

            // Auto-generate ringkasan
            $('#btn-generate-ringkasan').click(function() {
                // Get content from TinyMCE
                if (window.tinymce && tinymce.get('content-editor')) {
                    var content = tinymce.get('content-editor').getContent({format: 'text'});
                    // Truncate to 500 characters
                    var excerpt = content.substring(0, 500);
                    if (content.length > 500) {
                        excerpt += '...';
                    }
                    $('#excerpt-field').val(excerpt);
                }
            });
        });
    </script>
@endpush
