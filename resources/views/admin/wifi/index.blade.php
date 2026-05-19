@extends('admin.layouts.admin')

@section('title', 'Titik WiFi')
@section('page-title', 'Titik WiFi')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="text-lg font-bold text-gray-800">Daftar Titik WiFi</h2>
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

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table id="table-wifi" class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Wilayah</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">SSID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Koordinat</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kecepatan</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
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
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.wifi.edit', $item) }}"
                                                class="px-3 py-1 rounded text-xs font-medium text-white hover:opacity-80"
                                                style="background-color: #0F2044;">Edit</a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.wifi.destroy', $item) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this.closest('form'), 'Data titik WiFi ini akan dihapus dan tidak dapat dikembalikan.')"
                                                        class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600">Hapus</button>
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

@push('scripts')
    <script>
        $('#table-wifi').DataTable({
            paging: false,
            info: false,
            bFilter: false,
            columnDefs: [{
                orderable: false,
                targets: [-1]
            }]
        });
    </script>
@endpush
