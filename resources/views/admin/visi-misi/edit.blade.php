@extends('admin.layouts.admin')
@section('title', 'Edit Visi/Misi')
@section('page-title', 'Edit Visi & Misi')

@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.visi-misi.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Edit Visi / Misi</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.visi-misi.update', $visiMisi) }}" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tipe <span
                            class="text-red-500">*</span></label>
                    <select name="tipe"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="visi" {{ old('tipe', $visiMisi->tipe) === 'visi' ? 'selected' : '' }}>Visi</option>
                        <option value="misi" {{ old('tipe', $visiMisi->tipe) === 'misi' ? 'selected' : '' }}>Misi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten <span
                            class="text-red-500">*</span></label>
                    <textarea name="konten" rows="5" class="tinymce-editor-simple w-full">{{ old('konten', $visiMisi->konten) }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $visiMisi->sort_order) }}"
                            min="0"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                        <div class="flex items-center gap-2 mt-2.5">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                {{ old('is_active', $visiMisi->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-300">
                            <label for="is_active" class="text-sm text-gray-700">Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90 transition-all"
                        style="background-color: #0F2044;">Perbarui</button>
                    <a href="{{ route('admin.visi-misi.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
