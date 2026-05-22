@extends('admin.layouts.admin')

@section('title', 'Edit Aplikasi')
@section('page-title', 'Edit Aplikasi')

@section('content')
    <div class="max-w-2xl">

        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.aplikasi.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Edit: {{ $aplikasi->name }}</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form action="{{ route('admin.aplikasi.update', $aplikasi->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-5" x-data="aplikasiForm()">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Aplikasi <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $aplikasi->name) }}" required
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                    @error('name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <input type="hidden" name="category" x-model="category">
                        
                        <!-- Custom Dropdown -->
                        <div class="relative" x-data="{ openCategory: false }" @click.away="openCategory = false">
                            <button type="button" @click="openCategory = !openCategory"
                                class="w-full flex items-center justify-between px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category') border-red-400 @enderror">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-gray-600" style="font-size:18px;" x-text="getCategoryIcon(category)"></span>
                                    <span class="font-medium text-gray-800" x-text="category || 'Pilih Kategori'"></span>
                                </div>
                                <span class="material-symbols-outlined text-gray-400" style="font-size:20px;">expand_more</span>
                            </button>

                            <div x-show="openCategory" x-cloak
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute z-20 w-full mt-1 bg-white border border-gray-200 rounded-xl shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="cat in categories" :key="cat.name">
                                    <button type="button" @click="category = cat.name; openCategory = false"
                                        class="w-full text-left px-4 py-2.5 text-sm hover:bg-indigo-50 flex items-center gap-3 transition-colors"
                                        :class="category === cat.name ? 'bg-indigo-50/50 text-indigo-700 font-semibold' : 'text-gray-700 font-medium'">
                                        <div class="w-8 h-8 rounded bg-white shadow-sm border border-gray-100 flex items-center justify-center flex-shrink-0"
                                            :class="category === cat.name ? 'text-indigo-600' : 'text-gray-500'">
                                            <span class="material-symbols-outlined" style="font-size:16px;" x-text="cat.icon_material"></span>
                                        </div>
                                        <span x-text="cat.name"></span>
                                    </button>
                                </template>
                                <div class="border-t border-gray-100 p-2">
                                    <button type="button" @click="openCategory = false; showNewCategoryInput = true"
                                        class="w-full text-left px-3 py-2 text-sm text-blue-600 hover:bg-blue-50 hover:text-blue-700 rounded-lg flex items-center gap-2 font-bold transition-colors">
                                        <span class="material-symbols-outlined" style="font-size:18px;">add_circle</span>
                                        Tambah Kategori Baru
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Form Tambah Kategori Baru -->
                        <div x-show="showNewCategoryInput" x-cloak x-collapse class="mt-3">
                            <div class="p-4 border border-gray-200 rounded-xl bg-gray-50 space-y-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Kategori</label>
                                    <input type="text" x-model="newCategoryName" placeholder="Contoh: Pendidikan"
                                        class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Pilih Ikon</label>
                                    <div class="flex flex-wrap gap-1.5">
                                        <template x-for="icon in predefinedIcons.slice(0, 16)" :key="icon">
                                            <button type="button" @click="newCategoryIcon = icon"
                                                :class="newCategoryIcon === icon ? 'bg-blue-100 text-blue-600 border-blue-400 ring-2 ring-blue-100' : 'bg-white text-gray-500 border-gray-200 hover:bg-gray-100'"
                                                class="w-8 h-8 rounded border flex items-center justify-center transition-all shadow-sm">
                                                <span class="material-symbols-outlined" style="font-size:16px;" x-text="icon"></span>
                                            </button>
                                        </template>
                                    </div>
                                </div>

                                <div class="flex gap-2 justify-end pt-2 border-t border-gray-200">
                                    <button type="button" @click="showNewCategoryInput = false"
                                        class="px-3 py-1.5 text-xs font-semibold text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">Batal</button>
                                    <button type="button" @click="saveNewCategory" :disabled="isSavingCategory || !newCategoryName.trim() || !newCategoryIcon"
                                        class="px-4 py-1.5 text-xs font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors disabled:opacity-50 flex items-center gap-1.5 shadow-sm">
                                        <span x-show="!isSavingCategory" class="material-symbols-outlined" style="font-size:14px;">save</span>
                                        <svg x-show="isSavingCategory" class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span x-text="isSavingCategory ? 'Menyimpan...' : 'Simpan'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @error('category')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL / Tautan (Href)</label>
                        <input type="url" name="href" value="{{ old('href', $aplikasi->href) }}" required
                            placeholder="https://..."
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('href') border-red-400 @enderror">
                        @error('href')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="6"
                        class="tinymce-editor-simple w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-400 @enderror">{{ old('description', $aplikasi->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tipe Ikon</label>
                    <div class="flex gap-2">
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="icon_type" value="material" x-model="iconType" class="form-radio"
                                {{ old('icon_type', $aplikasi->icon_type) == 'material' ? 'checked' : '' }}>
                            <span class="text-sm">Material Icon</span>
                        </label>
                        <label class="inline-flex items-center gap-2">
                            <input type="radio" name="icon_type" value="upload" x-model="iconType" class="form-radio"
                                {{ old('icon_type', $aplikasi->icon_type) == 'upload' ? 'checked' : '' }}>
                            <span class="text-sm">Upload Logo</span>
                        </label>
                    </div>
                </div>

                <!-- Material icon panel -->
                <div x-show="iconType === 'material'" class="border border-gray-200 rounded-xl p-4 bg-gray-50/50">
                    <input type="hidden" name="icon_material" x-model="selectedIcon">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <!-- Warna Background -->
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-2 block">Warna Background</label>
                            <input type="hidden" name="icon_bg" x-model="iconBg">
                            <div class="flex flex-wrap gap-2">
                                <template x-for="opt in bgOptions" :key="opt.value">
                                    <button type="button"
                                        @click="iconBg = opt.value"
                                        :title="opt.label"
                                        class="w-8 h-8 rounded-full border-2 transition-all duration-150 flex items-center justify-center"
                                        :class="iconBg === opt.value ? 'border-gray-700 scale-110 shadow-md' : 'border-transparent hover:border-gray-400 hover:scale-105'"
                                        :style="'background-color:' + opt.hex">
                                        <svg x-show="iconBg === opt.value" class="w-3.5 h-3.5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5">Dipilih: <span class="font-medium text-gray-600" x-text="bgOptions.find(o=>o.value===iconBg)?.label || iconBg"></span></p>
                        </div>

                        <!-- Warna Ikon -->
                        <div>
                            <label class="text-sm font-semibold text-gray-700 mb-2 block">Warna Ikon</label>
                            <input type="hidden" name="icon_color" x-model="iconColor">
                            <div class="flex flex-wrap gap-2">
                                <template x-for="opt in colorOptions" :key="opt.value">
                                    <button type="button"
                                        @click="iconColor = opt.value"
                                        :title="opt.label"
                                        class="w-8 h-8 rounded-full border-2 transition-all duration-150 flex items-center justify-center"
                                        :class="iconColor === opt.value ? 'border-gray-700 scale-110 shadow-md' : 'border-transparent hover:border-gray-400 hover:scale-105'"
                                        :style="'background-color:' + opt.hex">
                                        <svg x-show="iconColor === opt.value" class="w-3.5 h-3.5 text-white drop-shadow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <p class="text-xs text-gray-400 mt-1.5">Dipilih: <span class="font-medium text-gray-600" x-text="colorOptions.find(o=>o.value===iconColor)?.label || iconColor"></span></p>
                        </div>
                    </div>

                    <!-- Preview + Icon Grid -->
                    <div class="flex items-center gap-4 mb-3 p-3 bg-white rounded-lg border border-gray-200">
                        <div :class="iconBg" class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined" :class="iconColor" style="font-size:32px; font-variation-settings:'FILL' 1"
                                x-text="selectedIcon">apps</span>
                        </div>
                        <div>
                            <div class="text-xs text-gray-400 uppercase tracking-wide font-semibold">Preview Ikon</div>
                            <div class="font-semibold text-gray-800 mt-0.5" x-text="selectedIcon"></div>
                        </div>
                    </div>

                    <div class="border border-gray-200 rounded-lg bg-white p-2 overflow-auto" style="max-height:200px">
                        <div class="flex flex-wrap gap-2">
                            <template x-for="icon in predefinedIcons" :key="icon">
                                <button type="button"
                                    class="w-10 h-10 rounded-lg border flex items-center justify-center transition-all duration-150"
                                    :class="selectedIcon === icon ? 'bg-[#0F2044] border-[#0F2044] text-white shadow-md' : 'border-gray-200 hover:border-indigo-300 hover:bg-indigo-50'"
                                    :title="icon"
                                    @click="selectedIcon = icon">
                                    <span class="material-symbols-outlined" style="font-size:20px; font-variation-settings:'FILL' 1" x-text="icon"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Upload logo panel -->
                <div x-show="iconType === 'upload'" x-cloak class="border-2 border-dashed border-gray-300 rounded-xl p-6 bg-gray-50/50 hover:border-indigo-400 hover:bg-indigo-50/30 transition-all duration-200"
                    :class="logoFileName ? 'border-green-400 bg-green-50/30' : ''">
                    @if ($aplikasi->logo_path)
                        <div class="flex justify-center mb-4">
                            <div class="relative">
                                <p class="text-xs text-center text-gray-400 mb-2 uppercase tracking-wide font-semibold">Logo Saat Ini</p>
                                <img id="current-logo-preview" src="{{ Storage::disk('public')->url($aplikasi->logo_path) }}"
                                    class="max-h-20 rounded-xl border border-gray-200 shadow-sm object-contain mx-auto" alt="Logo saat ini">
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col items-center text-center">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-3"
                            :class="logoFileName ? 'bg-green-100' : 'bg-indigo-100'">
                            <span class="material-symbols-outlined text-3xl"
                                :class="logoFileName ? 'text-green-600' : 'text-indigo-500'"
                                x-text="logoFileName ? 'check_circle' : 'upload_file'"
                                style="font-variation-settings:'FILL' 1">upload_file</span>
                        </div>
                        <template x-if="!logoFileName">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">{{ $aplikasi->logo_path ? 'Klik untuk ganti logo' : 'Klik untuk pilih file logo' }}</p>
                                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP, SVG &mdash; Maks. 2MB</p>
                            </div>
                        </template>
                        <template x-if="logoFileName">
                            <div>
                                <p class="text-sm font-semibold text-green-700" x-text="logoFileName"></p>
                                <p class="text-xs text-gray-400 mt-1">Klik untuk ganti file</p>
                            </div>
                        </template>
                        <label class="mt-3 cursor-pointer inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-150"
                            :class="logoFileName ? 'bg-green-600 text-white hover:bg-green-700' : 'bg-indigo-600 text-white hover:bg-indigo-700'">
                            <span class="material-symbols-outlined text-base" style="font-variation-settings:'FILL' 1"
                                x-text="logoFileName ? 'sync' : 'folder_open'">folder_open</span>
                            <span x-text="logoFileName ? 'Ganti File' : 'Pilih File'">Pilih File</span>
                            <input type="file" name="logo_file" accept="image/*" class="sr-only"
                                @change="handleLogoChange($event)">
                        </label>
                        <div x-show="logoPreviewUrl" class="mt-4">
                            <img :src="logoPreviewUrl" class="max-h-24 rounded-lg border border-gray-200 shadow-sm object-contain" alt="Preview logo baru">
                        </div>
                    </div>
                    @error('logo_file')
                        <p class="mt-2 text-xs text-red-600 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tags</label>
                    <input type="hidden" name="tags" x-model="tagsJson">
                    <div class="border rounded p-2 flex flex-wrap gap-2 items-center" style="min-height:42px">
                        <template x-for="(tag, index) in tags" :key="index">
                            <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 text-xs flex items-center gap-2">
                                <span x-text="tag"></span>
                                <button type="button" @click="removeTag(index)" class="text-xs">×</button>
                            </span>
                        </template>
                        <input type="text" x-model="newTag" @keydown.enter.prevent="addTag()"
                            placeholder="Tambah tag..." class="border-0 outline-none flex-grow min-w-[120px]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    {{-- Sort Order --}}
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-3 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-indigo-500" style="font-size:18px; font-variation-settings:'FILL' 1">sort</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide block mb-1">Urutan Tampil</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $aplikasi->sort_order) }}"
                                min="0" class="w-full bg-white border border-gray-200 rounded-lg px-3 py-1.5 text-sm font-semibold text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition-all">
                        </div>
                    </div>

                    {{-- Featured toggle --}}
                    <button type="button" @click="isFeatured = !isFeatured"
                        :class="isFeatured ? 'border-amber-400 bg-amber-50 shadow-sm' : 'border-gray-200 bg-white hover:border-amber-200 hover:bg-amber-50/30'"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 transition-all duration-150 text-left w-full">
                        <input type="hidden" name="is_featured" :value="isFeatured ? '1' : '0'">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 transition-colors"
                            :class="isFeatured ? 'bg-amber-100' : 'bg-gray-100'">
                            <span class="material-symbols-outlined transition-colors" style="font-size:18px; font-variation-settings:'FILL' 1"
                                :class="isFeatured ? 'text-amber-500' : 'text-gray-400'">star</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wide transition-colors" :class="isFeatured ? 'text-amber-600' : 'text-gray-400'">Featured</p>
                            <p class="text-xs transition-colors" :class="isFeatured ? 'text-amber-700 font-medium' : 'text-gray-400'"
                                x-text="isFeatured ? 'Tampil di Terbaru' : 'Tidak ditampilkan'"></p>
                        </div>
                        <span class="ml-auto w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all"
                            :class="isFeatured ? 'bg-amber-400 border-amber-400' : 'border-gray-300'">
                            <svg x-show="isFeatured" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                    </button>

                    {{-- Active toggle --}}
                    <button type="button" @click="isActive = !isActive"
                        :class="isActive ? 'border-emerald-400 bg-emerald-50 shadow-sm' : 'border-red-200 bg-red-50/40 hover:border-red-300'"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl border-2 transition-all duration-150 text-left w-full">
                        <input type="hidden" name="is_active" :value="isActive ? '1' : '0'">
                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 transition-colors"
                            :class="isActive ? 'bg-emerald-100' : 'bg-red-100'">
                            <span class="material-symbols-outlined transition-colors" style="font-size:18px; font-variation-settings:'FILL' 1"
                                :class="isActive ? 'text-emerald-500' : 'text-red-400'" x-text="isActive ? 'check_circle' : 'cancel'">check_circle</span>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-semibold uppercase tracking-wide transition-colors"
                                :class="isActive ? 'text-emerald-600' : 'text-red-500'" x-text="isActive ? 'Aktif' : 'Nonaktif'">Aktif</p>
                            <p class="text-xs transition-colors"
                                :class="isActive ? 'text-emerald-700 font-medium' : 'text-red-400'"
                                x-text="isActive ? 'Tampil di portal' : 'Tersembunyi dari portal'">Tampil di portal</p>
                        </div>
                        <span class="ml-auto w-5 h-5 rounded-full border-2 flex items-center justify-center flex-shrink-0 transition-all"
                            :class="isActive ? 'bg-emerald-400 border-emerald-400' : 'bg-red-400 border-red-400'">
                            <svg x-show="isActive" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                            <svg x-show="!isActive" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </span>
                    </button>
                </div>

                <div class="flex gap-3 pt-2 border-t border-gray-100">
                    <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-bold text-white"
                        style="background-color: #0F2044;">Simpan Perubahan</button>
                    <a href="{{ route('admin.aplikasi.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100">Batal</a>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('aplikasiForm', () => ({
                iconType: '{{ old('icon_type', $aplikasi->icon_type) }}',
                iconBg: '{{ old('icon_bg', $aplikasi->icon_bg) }}',
                iconColor: '{{ old('icon_color', $aplikasi->icon_color) }}',
                category: '{{ old('category', $aplikasi->category) }}',
                isFeatured: {{ old('is_featured', $aplikasi->is_featured) ? 'true' : 'false' }},
                isActive: {{ old('is_active', $aplikasi->is_active) ? 'true' : 'false' }},
                categories: {!! json_encode($categories) !!},
                showNewCategoryInput: false,
                newCategoryName: '',
                newCategoryIcon: 'apps',
                isSavingCategory: false,

                getCategoryIcon(name) {
                    let cat = this.categories.find(c => c.name === name);
                    return cat ? cat.icon_material : 'apps';
                },

                async saveNewCategory() {
                    let name = this.newCategoryName.trim();
                    if (!name || !this.newCategoryIcon) return;
                    
                    this.isSavingCategory = true;
                    try {
                        const response = await fetch('{{ route('admin.aplikasi.categories.store') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                name: name,
                                icon_material: this.newCategoryIcon
                            })
                        });
                        
                        const data = await response.json();
                        if (response.ok && data.success) {
                            this.categories.push(data.category);
                            this.categories.sort((a, b) => a.name.localeCompare(b.name));
                            this.category = data.category.name;
                            this.showNewCategoryInput = false;
                            this.newCategoryName = '';
                            this.newCategoryIcon = 'apps';
                        } else {
                            alert(data.message || 'Gagal menambahkan kategori. Mungkin nama sudah ada.');
                        }
                    } catch (err) {
                        console.error(err);
                        alert('Terjadi kesalahan jaringan.');
                    } finally {
                        this.isSavingCategory = false;
                    }
                },
                selectedIcon: '{{ old('icon_material', $aplikasi->icon_material ?: 'apps') }}',
                predefinedIcons: [
                    'apps', 'description', 'payments', 'health_and_safety', 'medical_information',
                    'luggage', 'flight_takeoff', 'security', 'fingerprint', 'medical_services',
                    'emergency', 'groups', 'local_hospital', 'gavel', 'school', 'policy', 'receipt',
                    'account_balance', 'volunteer_activism', 'public', 'forum', 'campaign', 'map',
                    'family_restroom', 'science', 'domain', 'water_drop', 'electric_bolt',
                    'recycling', 'forest', 'home_work', 'storefront', 'apartment', 'location_city',
                    'business'
                ],
                newTag: '',
                logoFileName: '',
                logoPreviewUrl: '',
                bgOptions: [
                    { value: 'bg-blue-100',   label: 'Blue',    hex: '#60A5FA' },
                    { value: 'bg-indigo-100', label: 'Indigo',  hex: '#818CF8' },
                    { value: 'bg-sky-100',    label: 'Sky',     hex: '#38BDF8' },
                    { value: 'bg-emerald-100',label: 'Emerald', hex: '#34D399' },
                    { value: 'bg-amber-100',  label: 'Amber',   hex: '#FBBF24' },
                    { value: 'bg-red-100',    label: 'Red',     hex: '#F87171' },
                    { value: 'bg-violet-100', label: 'Violet',  hex: '#A78BFA' },
                    { value: 'bg-teal-100',   label: 'Teal',    hex: '#2DD4BF' },
                ],
                colorOptions: [
                    { value: 'text-blue-600',   label: 'Blue',    hex: '#2563EB' },
                    { value: 'text-indigo-600', label: 'Indigo',  hex: '#4F46E5' },
                    { value: 'text-sky-600',    label: 'Sky',     hex: '#0284C7' },
                    { value: 'text-emerald-600',label: 'Emerald', hex: '#059669' },
                    { value: 'text-amber-600',  label: 'Amber',   hex: '#D97706' },
                    { value: 'text-red-600',    label: 'Red',     hex: '#DC2626' },
                    { value: 'text-violet-600', label: 'Violet',  hex: '#7C3AED' },
                    { value: 'text-teal-600',   label: 'Teal',    hex: '#0D9488' },
                ],
                tags: {!! json_encode(old('tags') ? json_decode(old('tags')) : ($aplikasi->tags ?: [])) !!},
                get tagsJson() {
                    return JSON.stringify(this.tags);
                },
                addTag() {
                    if (this.newTag.trim() !== '' && !this.tags.includes(this.newTag.trim())) {
                        this.tags.push(this.newTag.trim());
                    }
                    this.newTag = '';
                },
                removeTag(index) {
                    this.tags.splice(index, 1);
                },
                handleLogoChange(event) {
                    const file = event.target.files && event.target.files[0];
                    if (!file) return;
                    this.logoFileName = file.name;
                    this.logoPreviewUrl = URL.createObjectURL(file);
                }
            }));
        });

        // Re-initialize TinyMCE for this page's textarea
        document.addEventListener('DOMContentLoaded', () => {
            if (window.tinymce) {
                const target = document.querySelector('textarea.tinymce-editor-simple');
                if (target && !tinymce.get(target.id)) {
                    tinymce.init({
                        target: target,
                        plugins: 'lists link autolink',
                        toolbar: 'bold italic underline | bullist numlist | link | removeformat',
                        height: 220,
                        skin: false,
                        content_css: false,
                        content_style: `
                            body { font-family: ui-sans-serif, system-ui, sans-serif; font-size: 14px; color: #111827; line-height: 1.75; margin: 8px 12px; }
                            a { color: #0F2044; text-decoration: underline; }
                            ul, ol { padding-left: 1.5em; }
                            p { margin: 0 0 0.75em; }
                        `,
                        license_key: 'gpl',
                        promotion: false,
                        branding: false,
                        menubar: false,
                        resize: false,
                        width: '100%',
                        setup(editor) {
                            editor.on('change', () => editor.save());
                        },
                    });
                }
            }
        });

        // Logo file preview handled by Alpine handleLogoChange
    </script>
@endpush
