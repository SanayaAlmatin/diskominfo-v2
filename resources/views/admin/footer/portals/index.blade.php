@extends('admin.layouts.admin')
@section('title', 'Portal Terkait')
@section('page-title', 'Konten Footer — Portal Terkait')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="text-lg font-bold text-gray-800">Portal Terkait</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.footer.portals.create') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90"
                    style="background-color: #0F2044;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Portal
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="overflow-x-auto">
                <table id="table-portals" class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Urutan</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Nama Portal</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">URL</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($portals as $portal)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-gray-500 text-xs">{{ $portal->sort_order }}</td>
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $portal->label }}</td>
                                <td class="px-4 py-3 text-gray-500 text-xs max-w-xs truncate">
                                    <a href="{{ $portal->url }}" target="_blank"
                                        class="hover:text-blue-600 transition-colors">{{ $portal->url }}</a>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-medium {{ $portal->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $portal->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.footer.portals.edit', $portal) }}"
                                                class="px-3 py-1 rounded text-xs font-medium text-white hover:opacity-80"
                                                style="background-color: #0F2044;">Edit</a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST"
                                                    action="{{ route('admin.footer.portals.destroy', $portal) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this.closest('form'), 'Portal yang dihapus tidak dapat dikembalikan.')"
                                                        class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600">Hapus</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-400">
                                    Belum ada portal terkait. <a href="{{ route('admin.footer.portals.create') }}"
                                        class="text-blue-600 hover:underline">Tambah sekarang</a>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div id="dt-paging-portals"></div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#table-portals').DataTable({
            layout: {
                bottomStart: 'info',
                bottomEnd: '#dt-paging-portals',
            },
            columnDefs: [{
                orderable: false,
                targets: -1
            }]
        });
    </script>
@endpush
