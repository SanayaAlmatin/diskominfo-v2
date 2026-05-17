@extends('admin.layouts.admin')

@section('title', 'Tambah Sekilas Diskominfo')
@section('page-title', 'Tambah Sekilas Diskominfo')

@section('content')
    <div class="max-w-2xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.sekilas.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Tambah Sekilas Diskominfo</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.sekilas.store') }}" enctype="multipart/form-data"
                class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten <span
                            class="text-red-500">*</span></label>
                    <textarea name="content" rows="8"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-400 @enderror"
                        placeholder="Tuliskan deskripsi sekilas Diskominfo...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar</label>
                    <input type="file" name="gambar" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:text-white file:cursor-pointer hover:file:opacity-80"
                        style="--file-bg: #0F2044;">
                    <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WebP. Maks. 2MB.</p>
                    @error('gambar')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90 transition-all"
                        style="background-color: #0F2044;">
                        Simpan
                    </button>
                    <a href="{{ route('admin.sekilas.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
