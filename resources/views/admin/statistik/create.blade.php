@extends('admin.layouts.admin')
@section('title', 'Tambah Bidang Statistik')
@section('page-title', 'Tambah Bidang Statistik')

@section('content')
    <div class="max-w-lg">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.statistik.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Tambah Bidang Statistik</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.statistik.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Bidang <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="n_bidang" value="{{ old('n_bidang') }}" maxlength="50"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('n_bidang') border-red-400 @enderror"
                        placeholder="Nama bidang statistik...">
                    @error('n_bidang')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90"
                        style="background-color: #0F2044;">Simpan</button>
                    <a href="{{ route('admin.statistik.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
