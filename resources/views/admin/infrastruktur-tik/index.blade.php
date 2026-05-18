@extends('admin.layouts.admin')
@section('title', 'Infrastruktur TIK')
@section('page-title', 'Infrastruktur & Statistik TIK')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="text-lg font-bold text-gray-800">Infrastruktur & Statistik TIK</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.infrastruktur-tik.create') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90"
                    style="background-color: #0F2044;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Statistik
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="overflow-x-auto">
                <table id="table-tik" class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Label</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nilai</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Satuan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Urutan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($items as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-medium bg-blue-50 text-blue-700">{{ $item->kategori }}</span>
                                </td>
                                <td class="px-4 py-3 text-gray-800 font-medium">{{ $item->label }}</td>
                                <td class="px-4 py-3 font-bold text-gray-900">{{ number_format($item->nilai) }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $item->satuan }}</td>
                                <td class="px-4 py-3 text-gray-500 text-xs">{{ $item->sort_order }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-medium {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.infrastruktur-tik.edit', $item) }}"
                                                class="px-3 py-1 rounded text-xs font-medium text-white hover:opacity-80"
                                                style="background-color: #0F2044;">Edit</a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST"
                                                    action="{{ route('admin.infrastruktur-tik.destroy', $item) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this.closest('form'), 'Data infrastruktur TIK yang dihapus tidak dapat dikembalikan.')"
                                                        class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600">Hapus</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="dt-paging-tik"></div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#table-tik').DataTable({
            layout: {
                bottomStart: 'info',
                bottomEnd: '#dt-paging-tik',
            },
            columnDefs: [{
                orderable: false,
                targets: -1
            }]
        });
    </script>
@endpush
