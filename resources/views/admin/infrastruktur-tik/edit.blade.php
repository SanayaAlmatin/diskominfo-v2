@extends('admin.layouts.admin')
@section('title', 'Edit Statistik TIK')
@section('page-title', 'Edit Statistik TIK')

@section('content')
    <div class="max-w-xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.infrastruktur-tik.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Edit Statistik TIK</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.infrastruktur-tik.update', $infrastrukturTik) }}"
                class="space-y-5">
                @csrf @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kategori <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="kategori" value="{{ old('kategori', $infrastrukturTik->kategori) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Icon (CSS class)</label>
                        <input type="text" name="icon" value="{{ old('icon', $infrastrukturTik->icon) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Label <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="label" value="{{ old('label', $infrastrukturTik->label) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nilai <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="nilai" value="{{ old('nilai', $infrastrukturTik->nilai) }}"
                            step="0.01"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Satuan</label>
                        <input type="text" name="satuan" value="{{ old('satuan', $infrastrukturTik->satuan) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" name="sort_order"
                            value="{{ old('sort_order', $infrastrukturTik->sort_order) }}" min="0"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
                        <div class="flex items-center gap-2 mt-2.5">
                            <input type="checkbox" name="is_active" value="1" id="is_active"
                                {{ old('is_active', $infrastrukturTik->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 rounded border-gray-300">
                            <label for="is_active" class="text-sm text-gray-700">Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90"
                        style="background-color: #0F2044;">Perbarui</button>
                    <a href="{{ route('admin.infrastruktur-tik.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
