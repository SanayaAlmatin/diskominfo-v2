@extends('admin.layouts.admin')

@section('title', 'Titik WiFi')
@section('page-title', 'Titik WiFi')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="text-lg font-bold text-gray-800">Daftar Titik WiFi</h2>
            <div class="flex flex-wrap items-center gap-2">
                <form method="GET" action="{{ route('admin.wifi.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari wilayah atau SSID…"
                        class="px-3 py-2 rounded-lg border border-gray-200 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-200 w-56">
                    <button type="submit"
                        class="px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90 transition-all"
                        style="background-color: #0F2044;">Cari</button>
                    @if ($search)
                        <a href="{{ route('admin.wifi.index') }}"
                            class="px-3 py-2 rounded-lg text-sm text-gray-500 border border-gray-200 hover:bg-gray-50">Reset</a>
                    @endif
                </form>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.wifi.create') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90 transition-all"
                        style="background-color: #0F2044;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Lokasi
                    </a>
                @endif
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-5 mb-2">
            {{-- Card 1: Total WiFi --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalWifi) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Total Titik WiFi</p>
                </div>
            </div>
            
            {{-- Card 2: SSID Dikonfigurasi --}}
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-emerald-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($totalSsid) }}</p>
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">SSID Dikonfigurasi</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
            <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Wilayah</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">SSID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Koordinat</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kecepatan</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($wifis as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-gray-400 text-xs">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $item->n_wilayah }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $item->ssid ?: '-' }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $item->latitude }}, {{ $item->longitude }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $item->kecepatan ?: '-' }}</td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 ">
                                        <div class="flex items-center justify-start gap-2">
                                            <a href="{{ route('admin.wifi.edit', $item) }}"
                                                class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.wifi.destroy', $item) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this.closest('form'), 'Data titik WiFi ini akan dihapus dan tidak dapat dikembalikan.')"
                                                        class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-100 hover:text-orange-600 transition-colors" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center text-gray-400 text-sm">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-4 py-3 border-t border-gray-100">
                {{ $wifis->links() }}
            </div>
        </div>
    </div>
@endsection
