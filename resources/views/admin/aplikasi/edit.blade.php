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
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori</label>
                        <select name="category" required
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category') border-red-400 @enderror">
                            <option value="admin" {{ old('category', $aplikasi->category) == 'admin' ? 'selected' : '' }}>
                                Administrasi</option>
                            <option value="health" {{ old('category', $aplikasi->category) == 'health' ? 'selected' : '' }}>
                                Kesehatan</option>
                            <option value="finance" {{ old('category', $aplikasi->category) == 'finance' ? 'selected' : '' }}>
                                Keuangan</option>
                            <option value="safety" {{ old('category', $aplikasi->category) == 'safety' ? 'selected' : '' }}>
                                Keamanan Publik</option>
                        </select>
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
                    <textarea id="description" name="description" rows="6"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-400 @enderror">{{ old('description', $aplikasi->description) }}</textarea>
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
                <div x-show="iconType === 'material'" class="border rounded p-4">
                    <input type="hidden" name="icon_material" x-model="selectedIcon">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-3">
                        <div>
                            <label class="text-sm font-medium">Warna Background</label>
                            <select name="icon_bg" x-model="iconBg" class="w-full mt-1 rounded border-gray-300">
                                <option value="bg-blue-100">Blue (bg-blue-100)</option>
                                <option value="bg-indigo-100">Indigo (bg-indigo-100)</option>
                                <option value="bg-sky-100">Sky (bg-sky-100)</option>
                                <option value="bg-emerald-100">Emerald (bg-emerald-100)</option>
                                <option value="bg-amber-100">Amber (bg-amber-100)</option>
                                <option value="bg-red-100">Red (bg-red-100)</option>
                                <option value="bg-violet-100">Violet (bg-violet-100)</option>
                                <option value="bg-teal-100">Teal (bg-teal-100)</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium">Warna Teks</label>
                            <select name="icon_color" x-model="iconColor" class="w-full mt-1 rounded border-gray-300">
                                <option value="text-blue-600">Blue (text-blue-600)</option>
                                <option value="text-indigo-600">Indigo (text-indigo-600)</option>
                                <option value="text-sky-600">Sky (text-sky-600)</option>
                                <option value="text-emerald-600">Emerald (text-emerald-600)</option>
                                <option value="text-amber-600">Amber (text-amber-600)</option>
                                <option value="text-red-600">Red (text-red-600)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mb-3">
                        <div :class="iconBg" class="p-3 rounded">
                            <span class="material-symbols-outlined" :class="iconColor" style="font-size:32px"
                                x-text="selectedIcon">apps</span>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Preview</div>
                            <div class="font-semibold"><span x-text="selectedIcon"></span></div>
                        </div>
                    </div>

                    <div class="border rounded p-2 overflow-auto" style="max-height:200px">
                        <div class="flex flex-wrap gap-2">
                            <template x-for="icon in predefinedIcons" :key="icon">
                                <button type="button" class="px-3 py-2 rounded border text-sm"
                                    :class="{ 'bg-gray-800 text-white': selectedIcon === icon }"
                                    @click="selectedIcon = icon">
                                    <span class="material-symbols-outlined" style="font-size:20px" x-text="icon"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Upload logo panel -->
                <div x-show="iconType === 'upload'" class="border rounded p-4" style="display:none">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Upload Logo</label>

                    @if ($aplikasi->logo_path)
                        <div class="mb-3">
                            <p class="text-sm text-gray-500 mb-1">Logo Saat Ini:</p>
                            <img id="current-logo-preview" src="{{ Storage::disk('public')->url($aplikasi->logo_path) }}"
                                class="rounded border p-2" style="max-height:100px" alt="Logo">
                        </div>
                    @endif

                    <input type="file" name="logo_file" accept="image/*" class="w-full">
                    <p class="mt-1 text-xs text-gray-400">Maks. 2MB. Biarkan kosong jika tidak ingin mengubah.</p>
                    @error('logo_file')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tags (Tekan Enter)</label>
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
                    <div>
                        <label class="text-sm font-medium">Urutan Tampil (Sort Order)</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $aplikasi->sort_order) }}"
                            min="0" class="w-full mt-1 rounded border-gray-300">
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" class="w-4 h-4"
                            {{ old('is_featured', $aplikasi->is_featured) ? 'checked' : '' }}>
                        <label for="is_featured" class="text-sm">Tampil di "Aplikasi Terbaru"</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4"
                            {{ old('is_active', $aplikasi->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="text-sm">Aktif (Tampil di portal)</label>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/{{ env('VITE_TINYMCE_API_KEY') ?? 'no-api-key' }}/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            menubar: false,
            plugins: 'advlist autolink lists link charmap preview anchor searchreplace visualblocks code fullscreen table paste help wordcount',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            height: 300,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('aplikasiForm', () => ({
                iconType: '{{ old('icon_type', $aplikasi->icon_type) }}',
                iconBg: '{{ old('icon_bg', $aplikasi->icon_bg) }}',
                iconColor: '{{ old('icon_color', $aplikasi->icon_color) }}',
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
                }
            }));
        });

        // Logo file preview (edit form)
        document.querySelectorAll('input[name="logo_file"]').forEach(input => {
            input.addEventListener('change', function(e) {
                const file = this.files && this.files[0];
                if (!file) return;
                let preview = document.getElementById('current-logo-preview') || document.getElementById(
                    'logo-preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'logo-preview';
                    preview.className = 'mt-2 rounded border p-1';
                    preview.style.maxHeight = '100px';
                    this.insertAdjacentElement('afterend', preview);
                }
                preview.src = URL.createObjectURL(file);
            });
        });
    </script>
@endpush
