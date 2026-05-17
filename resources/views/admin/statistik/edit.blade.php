@extends('admin.layouts.admin')
@section('title', 'Kelola Bidang Statistik')
@section('page-title', 'Kelola Bidang Statistik')

@section('content')
    <div class="space-y-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.statistik.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Kelola: {{ $bidang->n_bidang }}</h2>
        </div>

        {{-- Edit Nama Bidang --}}
        @if (auth()->user()->isAdmin())
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 max-w-lg">
                <h3 class="text-sm font-bold text-gray-700 mb-4">Edit Nama Bidang</h3>
                <form method="POST" action="{{ route('admin.statistik.update', $bidang) }}" class="flex gap-3">
                    @csrf @method('PUT')
                    <input type="text" name="n_bidang" value="{{ old('n_bidang', $bidang->n_bidang) }}" maxlength="50"
                        class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                        class="px-5 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90 whitespace-nowrap"
                        style="background-color: #0F2044;">Simpan</button>
                </form>
                @error('n_bidang')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        {{-- File list --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-bold text-gray-700">File Publikasi ({{ count($files) }})</h3>
                @if (auth()->user()->isAdmin())
                    <button onclick="document.getElementById('add-file-form').classList.toggle('hidden')"
                        class="flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-semibold text-white hover:opacity-90"
                        style="background-color: #0F2044;">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah File
                    </button>
                @endif
            </div>

            @if (auth()->user()->isAdmin())
                <div id="add-file-form" class="hidden border-b border-gray-100 bg-gray-50 p-5">
                    <form method="POST" action="{{ route('admin.statistik.storeFile', $bidang) }}"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">Nama File <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="n_file" value="{{ old('n_file') }}"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Nama tampilan file">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1">File <span
                                        class="text-red-500">*</span></label>
                                <input type="file" name="file_path" accept=".pdf,.xlsx,.xls,.csv,.doc,.docx"
                                    class="w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:text-white"
                                    style="--file-bg: #0F2044;">
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                class="px-5 py-2 rounded-lg text-xs font-bold text-white hover:opacity-90"
                                style="background-color: #0F2044;">Upload & Simpan</button>
                        </div>
                    </form>
                </div>
            @endif

            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama File</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Path</th>
                        @if (auth()->user()->isAdmin())
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($files as $file)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $file->deskripsi }}</td>
                            <td class="px-4 py-3 text-gray-500 text-xs">
                                <a href="{{ Storage::url($file->file) }}" target="_blank"
                                    class="text-blue-600 hover:underline">
                                    Lihat File
                                </a>
                            </td>
                            @if (auth()->user()->isAdmin())
                                <td class="px-4 py-3 text-right">
                                    @if (auth()->user()->isSuperAdmin())
                                        <form method="POST"
                                            action="{{ route('admin.statistik.destroyFile', [$bidang, $file]) }}"
                                            onsubmit="return confirm('Hapus file ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-10 text-center text-gray-400 text-sm">Belum ada file di bidang
                                ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
