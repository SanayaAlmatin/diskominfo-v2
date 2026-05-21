@extends('admin.layouts.admin')

@section('title', 'Manajemen Aplikasi')
@section('page-title', 'Manajemen Aplikasi')

@section('content')
    <div class="space-y-4">

        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="text-lg font-bold text-gray-800">Manajemen Aplikasi Portal</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.aplikasi.create') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90 transition-all"
                    style="background-color: #0F2044;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Aplikasi
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="overflow-x-auto">
                <table id="table-aplikasi" class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th
                                class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide w-10">
                                No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Aplikasi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Featured</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Urutan</th>
                            @if (auth()->user()->isAdmin())
                                <th
                                    class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                    Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($apps as $index => $app)
                            <tr class="hover:bg-gray-50 transition-colors">

                                <td class="px-4 py-3 text-gray-500 text-xs">{{ $index + 1 }}</td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-lg bg-gray-50 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                            @if ($app->icon_type === 'upload' && $app->logo_path)
                                                <img src="{{ Storage::disk('public')->url($app->logo_path) }}"
                                                    alt="{{ $app->name }}" class="w-full h-full object-contain">
                                            @else
                                                <span class="material-symbols-outlined {{ $app->icon_color }}"
                                                    style="font-size:20px">{{ $app->icon_material ?: 'apps' }}</span>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="font-semibold text-gray-800 truncate">{{ $app->name }}</p>
                                            <p class="text-xs text-gray-400 mt-0.5 truncate"><a href="{{ $app->href }}"
                                                    target="_blank"
                                                    class="text-primary">{{ Str::limit($app->href, 40) }}</a></p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3">
                                    <span
                                        class="inline-block px-2 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">{{ ucfirst($app->category) }}</span>
                                    @if ($app->tags)
                                        <div class="mt-1">
                                            @foreach ($app->tags as $tag)
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded text-xs bg-gray-100 text-gray-700">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-medium {{ $app->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $app->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                </td>

                                <td class="px-4 py-3">
                                    <span
                                        class="px-2 py-1 rounded text-xs font-medium {{ $app->is_featured ? 'bg-amber-100 text-amber-700' : 'bg-gray-100 text-gray-500' }}">{{ $app->is_featured ? 'Ya' : 'Tidak' }}</span>
                                </td>

                                <td class="px-4 py-3">
                                    <span class="text-gray-500 text-xs font-medium">{{ $app->sort_order }}</span>
                                </td>

                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.aplikasi.edit', $app) }}"
                                                class="px-3 py-1 rounded text-xs font-medium text-white bg-[#0F2044] hover:opacity-90 transition-all">Edit</a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.aplikasi.destroy', $app) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this.closest('form'), 'Aplikasi yang dihapus tidak dapat dikembalikan.')"
                                                        class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600 transition-all">Hapus</button>
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

        <div id="dt-paging-aplikasi"></div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#table-aplikasi').DataTable({
            layout: {
                bottomStart: 'info',
                bottomEnd: '#dt-paging-aplikasi',
            },
            columnDefs: [{
                orderable: false,
                targets: [0, 1, 3, 6]
            }],
        });

        // Toggle switch handler (uses fetch and CSRF header)
        document.querySelectorAll('.toggle-status').forEach(switchEl => {
            switchEl.addEventListener('change', function() {
                const id = this.dataset.id;
                const field = this.dataset.field;
                const value = this.checked ? 1 : 0;

                fetch('{{ route('admin.aplikasi.toggleFeatured') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            field,
                            value
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Optional: show toast
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        this.checked = !this.checked; // Revert on failure
                        alert('Gagal memperbarui status');
                    });
            });
        });
    </script>
@endpush
