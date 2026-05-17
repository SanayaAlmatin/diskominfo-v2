@extends('admin.layouts.admin')
@section('title', 'Tambah Banner')
@section('page-title', 'Tambah Banner & Program')

@section('content')
    <div class="max-w-2xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.program-vacancy.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Tambah Banner</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.program-vacancy.store') }}" enctype="multipart/form-data"
                class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-400 @enderror"
                        placeholder="Deskripsi banner atau program...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Banner <span
                            class="text-red-500">*</span></label>
                    <input type="file" name="image" accept="image/*" required
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:text-white">
                    <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WebP. Maks. 2MB. Disarankan rasio 16:5.</p>
                    @error('image')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL Tautan</label>
                    <input type="url" name="link_url" value="{{ old('link_url') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('link_url') border-red-400 @enderror"
                        placeholder="https://...">
                    @error('link_url')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                        {{ old('is_active', '1') ? 'checked' : '' }} class="w-4 h-4 rounded border-gray-300">
                    <label for="is_active" class="text-sm font-semibold text-gray-700">Tampilkan di landing page</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90"
                        style="background-color: #0F2044;">Simpan</button>
                    <a href="{{ route('admin.program-vacancy.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
