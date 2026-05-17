@extends('admin.layouts.admin')
@section('title', 'Edit SOTK')
@section('page-title', 'Edit Struktur Organisasi')

@section('content')
    <div class="max-w-2xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.struktur-organisasi.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Edit SOTK</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.struktur-organisasi.update', $strukturOrganisasi) }}"
                enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="tahun" value="{{ old('tahun', $strukturOrganisasi->tahun) }}"
                            min="2000" max="2100"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="sort_order"
                            value="{{ old('sort_order', $strukturOrganisasi->sort_order) }}" min="0"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama SOTK <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama_sotk" value="{{ old('nama_sotk', $strukturOrganisasi->nama_sotk) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('deskripsi', $strukturOrganisasi->deskripsi) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar / Bagan</label>
                    @if ($strukturOrganisasi->gambar)
                        <div class="mb-3">
                            <img src="{{ Storage::url($strukturOrganisasi->gambar) }}"
                                class="h-32 w-auto rounded-lg object-contain border border-gray-100" alt="">
                            <p class="text-xs text-gray-400 mt-1">Gambar saat ini. Upload baru untuk mengganti.</p>
                        </div>
                    @endif
                    <input type="file" name="gambar" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:text-white">
                    <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WebP. Maks. 2MB.</p>
                    @error('gambar')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_current" value="1" id="is_current"
                        {{ old('is_current', $strukturOrganisasi->is_current) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300">
                    <label for="is_current" class="text-sm font-semibold text-gray-700">Tandai sebagai SOTK terkini
                        (aktif)</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90"
                        style="background-color: #0F2044;">Perbarui</button>
                    <a href="{{ route('admin.struktur-organisasi.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
