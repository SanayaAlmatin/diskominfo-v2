@extends('admin.layouts.admin')

@section('title', 'Kelola Event')
@section('page-title', 'Kelola Event')

@push('styles')
<style>
    .event-table th {
        white-space: nowrap;
    }
    .label-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
        border: 1px solid;
    }
    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 600;
        transition: all 0.15s ease;
        white-space: nowrap;
    }
    .action-btn-view {
        background: #ffffff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    .action-btn-view:hover {
        background: #eff6ff;
    }
    .action-btn-edit {
        background: #ffffff;
        color: #d97706;
        border: 1px solid #fde68a;
    }
    .action-btn-edit:hover {
        background: #fefce8;
    }
    .action-btn-delete {
        background: #ffffff;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
    .action-btn-delete:hover {
        background: #fef2f2;
    }
</style>
@endpush

@section('content')
<div class="space-y-5">

    {{-- Header --}}
    <div class="flex items-start justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kelola Event</h2>
            <p class="text-sm text-gray-500 mt-0.5">Kelola acara dan kegiatan Kota Tangerang Selatan</p>
        </div>
        <a href="{{ route('admin.events.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition-colors flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[18px]">add</span> Tambah Event
        </a>
    </div>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
        {{-- Total Event --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[22px]">event</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800 leading-none">{{ $totalEvent }}</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Total Event</p>
            </div>
        </div>
        {{-- Aktif --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[22px]">check_circle</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800 leading-none">{{ $aktifEvent }}</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Aktif</p>
            </div>
        </div>
        {{-- Akan Datang --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[22px]">schedule</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800 leading-none">{{ $akanDatangEvent }}</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Akan Datang</p>
            </div>
        </div>
        {{-- Selesai --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[22px]">inventory_2</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800 leading-none">{{ $selesaiEvent }}</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Selesai</p>
            </div>
        </div>
        {{-- Bulan Ini --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[22px]">calendar_month</span>
            </div>
            <div>
                <p class="text-2xl font-bold text-gray-800 leading-none">{{ $bulanIniEvent }}</p>
                <p class="text-xs text-gray-500 font-medium mt-1">Bulan Ini</p>
            </div>
        </div>
    </div>

    {{-- Filter Section --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
        <form action="{{ route('admin.events.index') }}" method="GET">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-5">
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700 mb-2">
                        <span class="material-symbols-outlined text-[18px]">search</span> Cari
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Nama event, label, lokasi..."
                           class="w-full text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2.5 px-3">
                </div>
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700 mb-2">
                        <span class="material-symbols-outlined text-[18px]">sell</span> Label
                    </label>
                    <select name="label" class="w-full text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2.5 px-3 bg-white">
                        <option value="">Semua Label</option>
                        @foreach($labels as $label)
                            <option value="{{ $label }}" {{ request('label') == $label ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700 mb-2">
                        <span class="material-symbols-outlined text-[18px]">visibility</span> Status
                    </label>
                    <select name="status" class="w-full text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2.5 px-3 bg-white">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700 mb-2">
                        <span class="material-symbols-outlined text-[18px]">calendar_today</span> Dari Tanggal
                    </label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                           class="w-full text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2.5 px-3">
                </div>
                <div>
                    <label class="flex items-center gap-1.5 text-sm font-medium text-gray-700 mb-2">
                        <span class="material-symbols-outlined text-[18px]">event</span> Sampai Tanggal
                    </label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                           class="w-full text-sm border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2.5 px-3">
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="bg-[#0665D0] hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">search</span> Filter
                </button>
                <a href="{{ route('admin.events.index') }}"
                   class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-6 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">refresh</span> Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Event Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left event-table">
                <thead>
                    <tr class="border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-semibold bg-gray-50/80">
                        <th class="px-5 py-3.5" style="min-width: 320px;">Event</th>
                        <th class="px-4 py-3.5">Label</th>
                        <th class="px-4 py-3.5">Tanggal</th>
                        <th class="px-4 py-3.5" style="min-width: 140px;">Lokasi</th>
                        <th class="px-4 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                    <tr class="border-b border-gray-100 hover:bg-blue-50/30 transition-colors">
                        {{-- EVENT --}}
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}"
                                         class="w-14 h-14 object-cover rounded-xl border border-gray-200 flex-shrink-0">
                                @else
                                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center text-blue-300 border border-blue-100 flex-shrink-0">
                                        <span class="material-symbols-outlined text-[28px]">image</span>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-sm font-bold text-gray-800 leading-snug line-clamp-1">{{ $event->name }}</p>
                                    @if($event->description)
                                        <p class="text-xs text-gray-500 mt-0.5 line-clamp-1 leading-relaxed">{{ Str::limit(strip_tags($event->description), 45) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- LABEL --}}
                        <td class="px-4 py-3.5 align-top pt-5">
                            <span class="label-badge bg-blue-50 text-blue-600 border-blue-200">
                                <span class="material-symbols-outlined text-[14px] text-blue-500">sell</span>
                                {{ $event->label }}
                            </span>
                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-4 py-3.5 align-top pt-5">
                            @php
                                $start = \Carbon\Carbon::parse($event->start_date);
                                $end = $event->end_date ? \Carbon\Carbon::parse($event->end_date) : null;
                                $hasRange = $end && $start->format('Y-m-d') !== $end->format('Y-m-d');
                            @endphp
                            <div class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-[16px] text-gray-400 mt-0.5">calendar_today</span>
                                <div class="text-xs text-gray-800 leading-tight">
                                    @if($hasRange)
                                        <span class="font-bold text-[13px]">{{ $start->format('d') }} - {{ $end->format('d') }}</span><br>
                                        <span class="text-gray-500">{{ $start->translatedFormat('M') }}</span><br>
                                        <span class="text-gray-500">{{ $start->format('Y') }}</span>
                                    @else
                                        <span class="font-bold text-[13px]">{{ $start->format('d') }}</span><br>
                                        <span class="text-gray-500">{{ $start->translatedFormat('M') }}</span><br>
                                        <span class="text-gray-500">{{ $start->format('Y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        {{-- LOKASI --}}
                        <td class="px-4 py-3.5 align-top pt-5">
                            <p class="text-[13px] text-gray-600 line-clamp-3 leading-relaxed">{{ Str::limit($event->location, 60) }}</p>
                        </td>

                        {{-- STATUS --}}
                        <td class="px-4 py-3.5 text-center align-top pt-5">
                            @if($event->is_active)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-600 border border-transparent">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gray-50 text-gray-600 border border-transparent">
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="px-5 py-3.5 align-top pt-5">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.events.show', $event) }}" class="action-btn action-btn-view" title="Lihat">
                                    <span class="material-symbols-outlined text-[14px]">visibility</span> Lihat
                                </a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="action-btn action-btn-edit" title="Edit">
                                    <span class="material-symbols-outlined text-[14px]">edit</span> Edit
                                </a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline"
                                      onsubmit="event.preventDefault(); if(confirm('Apakah Anda yakin ingin menghapus event &quot;{{ $event->name }}&quot;?')) this.submit();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-btn-delete" title="Hapus">
                                        <span class="material-symbols-outlined text-[14px]">delete</span> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-16 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mb-3">
                                    <span class="material-symbols-outlined text-3xl text-gray-300">event_busy</span>
                                </div>
                                <p class="text-sm font-medium text-gray-500">Belum ada data event.</p>
                                <p class="text-xs text-gray-400 mt-1">Klik "Tambah Event" untuk menambahkan event baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($events->hasPages())
        <div class="flex items-center justify-between px-5 py-4 border-t border-gray-100">
            <p class="text-sm text-gray-600">
                {{ $events->firstItem() }} - {{ $events->lastItem() }} dari {{ $events->total() }}
            </p>
            <div class="flex items-center gap-1">
                @if($events->onFirstPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 cursor-not-allowed">
                        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $events->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                    </a>
                @endif

                @foreach($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                    @if($page == $events->currentPage())
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-600 text-white text-sm font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 text-sm font-medium transition-colors">{{ $page }}</a>
                    @endif
                @endforeach

                @if($events->hasMorePages())
                    <a href="{{ $events->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-600 hover:bg-gray-100 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </a>
                @else
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-300 cursor-not-allowed">
                        <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </span>
                @endif
            </div>
        </div>
        @endif
    </div>

</div>
@endsection
