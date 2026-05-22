@extends('admin.layouts.admin')

@section('title', 'Manajemen Aplikasi')
@section('page-title', 'Manajemen Aplikasi')

@push('styles')
    <style>
        .app-stat-card {
            background: white;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            padding: 18px 22px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .app-stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(15, 32, 68, 0.08);
        }
        .app-header-gradient {
            background: linear-gradient(135deg, #0F2044 0%, #1a3460 50%, #253d6b 100%);
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }
        .app-header-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,193,7,0.1) 0%, transparent 70%);
            pointer-events: none;
        }
        .app-header-gradient::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(79,70,229,0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .btn-tambah {
            background: linear-gradient(135deg, #FFC107 0%, #FFD54F 100%);
            color: #0F2044;
            font-weight: 700;
            border-radius: 10px;
            padding: 10px 22px;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 14px rgba(255,193,7,0.3);
            text-decoration: none;
        }
        .btn-tambah:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255,193,7,0.4);
        }
        .app-table-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }
        .app-logo-wrap {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            border: 1.5px solid #E2E8F0;
            background: #F8FAFC;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }
        tr:hover .app-logo-wrap {
            border-color: #C7D2FE;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.06);
        }
        .badge-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.01em;
        }
        .badge-active {
            background: #ECFDF5;
            color: #059669;
        }
        .badge-inactive {
            background: #FEF2F2;
            color: #EF4444;
        }
        .badge-featured {
            background: #FFFBEB;
            color: #D97706;
        }
        .badge-not-featured {
            background: #FEF2F2;
            color: #EF4444;
        }
        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }
        .badge-dot-active { background: #10B981; }
        .badge-dot-inactive { background: #EF4444; }
        .badge-dot-featured { background: #F59E0B; }
        .badge-category {
            background: linear-gradient(135deg, #EEF2FF, #E0E7FF);
            color: #4338CA;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-tag {
            background: #F1F5F9;
            color: #64748B;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 500;
        }
        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            border: 1.5px solid transparent;
        }
        .btn-action-edit {
            background: #EEF2FF;
            color: #4F46E5;
            border-color: #E0E7FF;
        }
        .btn-action-edit:hover {
            background: #4F46E5;
            color: white;
            border-color: #4F46E5;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        .btn-action-delete {
            background: #FEF2F2;
            color: #EF4444;
            border-color: #FECACA;
        }
        .btn-action-delete:hover {
            background: #EF4444;
            color: white;
            border-color: #EF4444;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }
        .sort-badge {
            background: #F8FAFC;
            color: #64748B;
            font-size: 12px;
            font-weight: 600;
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #E2E8F0;
        }
    </style>
@endpush

@section('content')
    <div class="space-y-5">

        {{-- ▸ Header gradient card with stats --}}
        <div class="app-header-gradient px-6 py-6">
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-white flex items-center gap-2.5">
                        <span class="material-symbols-outlined" style="font-size: 26px; color: #FFC107;">apps</span>
                        Manajemen Aplikasi
                    </h2>
                    <p class="text-blue-200 text-sm mt-1">Kelola daftar aplikasi yang ditampilkan pada portal publik</p>
                </div>
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.aplikasi.create') }}" class="btn-tambah">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Aplikasi
                    </a>
                @endif
            </div>

            {{-- Stats row --}}
            <div class="relative z-10 grid grid-cols-1 sm:grid-cols-3 gap-3 mt-5">
                <div class="app-stat-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #EEF2FF, #E0E7FF);">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: #4F46E5;">grid_view</span>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ $apps->count() }}</p>
                            <p class="text-xs text-gray-400 font-medium">Total Aplikasi</p>
                        </div>
                    </div>
                </div>
                <div class="app-stat-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #ECFDF5, #D1FAE5);">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: #059669;">check_circle</span>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ $apps->where('is_active', true)->count() }}</p>
                            <p class="text-xs text-gray-400 font-medium">Aplikasi Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="app-stat-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, #FFFBEB, #FEF3C7);">
                            <span class="material-symbols-outlined" style="font-size: 20px; color: #D97706;">star</span>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-800">{{ $apps->where('is_featured', true)->count() }}</p>
                            <p class="text-xs text-gray-400 font-medium">Featured</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ▸ Table card --}}
        <div class="app-table-card">
            <div class="overflow-x-auto">
                <table id="table-aplikasi" class="w-full text-sm">
                    <thead class="bg-gray-50/80 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide w-10">
                                No</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide" style="min-width: 220px;">
                                Aplikasi</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide" style="max-width: 260px;">
                                Deskripsi</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide w-16">
                                URL</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Featured</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                Urutan</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wide">
                                    Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($apps as $index => $app)
                            <tr class="hover:bg-indigo-50/30 transition-colors duration-150">

                                <td class="px-4 py-3.5 text-gray-400 text-xs font-medium">{{ $index + 1 }}</td>

                                <td class="px-4 py-3.5" style="min-width: 220px;">
                                    <div class="flex items-center gap-3">
                                        <div class="app-logo-wrap">
                                            @if ($app->icon_type === 'upload' && $app->logo_path)
                                                <img src="{{ Storage::disk('public')->url($app->logo_path) }}"
                                                    alt="{{ $app->name }}" class="w-full h-full object-contain p-1">
                                            @else
                                                <span class="material-symbols-outlined {{ $app->icon_color }}"
                                                    style="font-size:20px">{{ $app->icon_material ?: 'apps' }}</span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="font-semibold text-gray-800 truncate text-sm leading-tight">{{ $app->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3.5">
                                    @php
                                        $cat = $app->categoryData;
                                        $catColor = $cat ? $cat->color_class : 'text-gray-600 bg-gray-50 border-gray-200';
                                        $catIcon = $cat ? $cat->icon_material : 'apps';
                                    @endphp
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full border text-xs font-semibold {{ $catColor }}">
                                        <span class="material-symbols-outlined" style="font-size:13px; font-variation-settings:'FILL' 1">{{ $catIcon }}</span>
                                        {{ $app->category }}
                                    </span>
                                    @if ($app->tags)
                                        <div class="flex flex-wrap gap-1 mt-1.5">
                                            @foreach ($app->tags as $tag)
                                                <span class="badge-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </td>

                                <td class="px-4 py-3.5" style="max-width: 260px;">
                                    <p class="text-xs text-gray-500 leading-relaxed line-clamp-2">
                                        {{ Str::limit(strip_tags($app->description), 100) }}
                                    </p>
                                </td>

                                <td class="px-4 py-3.5 text-center">
                                    <a href="{{ $app->href }}" target="_blank" rel="noopener noreferrer"
                                        title="Buka {{ $app->name }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 border border-blue-200 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all duration-150">
                                        <span class="material-symbols-outlined" style="font-size:15px; font-variation-settings:'FILL' 1">open_in_new</span>
                                    </a>
                                </td>

                                <td class="px-4 py-3.5">
                                    <span class="badge-status {{ $app->is_active ? 'badge-active' : 'badge-inactive' }}">
                                        <span class="badge-dot {{ $app->is_active ? 'badge-dot-active' : 'badge-dot-inactive' }}"></span>
                                        {{ $app->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3.5">
                                    <span class="badge-status {{ $app->is_featured ? 'badge-featured' : 'badge-not-featured' }}">
                                        <span class="badge-dot {{ $app->is_featured ? 'badge-dot-featured' : 'badge-dot-inactive' }}"></span>
                                        {{ $app->is_featured ? 'Ya' : 'Tidak' }}
                                    </span>
                                </td>

                                <td class="px-4 py-3.5 text-center">
                                    <span class="sort-badge">{{ $app->sort_order }}</span>
                                </td>

                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3.5 text-right">
                                        <div class="flex items-center justify-end gap-1.5">
                                            <a href="{{ route('admin.aplikasi.edit', $app) }}"
                                                class="btn-action btn-action-edit" title="Edit Aplikasi">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.aplikasi.destroy', $app) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this.closest('form'), 'Aplikasi yang dihapus tidak dapat dikembalikan.')"
                                                        class="btn-action btn-action-delete" title="Hapus Aplikasi">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
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
                targets: [0, 1, 2, 3, 4, 7, 8]
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
