@extends('admin.layouts.admin')

@section('title', 'Detail Event')
@section('page-title', 'Detail Event')

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                <span class="material-symbols-outlined">event</span>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Detail Event</h2>
                <p class="text-sm text-gray-500">Informasi lengkap acara / kegiatan</p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.events.edit', $event) }}" class="bg-amber-50 hover:bg-amber-100 border border-amber-200 text-amber-700 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">edit</span> Edit
            </a>
            <a href="{{ route('admin.events.index') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            {{-- Banner --}}
            @if($event->image)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="w-full h-auto max-h-80 object-cover">
            </div>
            @endif

            {{-- Informasi --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">description</span>
                    <h3 class="text-sm font-bold text-gray-800">Informasi Event</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Nama Event</label>
                        <p class="text-base font-bold text-gray-800 mt-1">{{ $event->name }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Label</label>
                            <p class="mt-1">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                    <span class="material-symbols-outlined text-[14px]">sell</span> {{ $event->label }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Status</label>
                            <p class="mt-1">
                                @if($event->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-gray-50 text-gray-600 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Nonaktif
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Lokasi</label>
                        <p class="text-sm text-gray-700 mt-1">{{ $event->location }}</p>
                    </div>
                    @if($event->description)
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Deskripsi</label>
                        <div class="text-sm text-gray-700 mt-1 leading-relaxed prose prose-sm max-w-none">{!! nl2br(e($event->description)) !!}</div>
                    </div>
                    @endif
                    @if($event->event_url)
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Link Pendaftaran</label>
                        <a href="{{ $event->event_url }}" target="_blank" class="text-sm text-blue-600 hover:underline mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span> {{ $event->event_url }}
                        </a>
                    </div>
                    @endif
                    @if($event->website)
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Website Penyelenggara</label>
                        <a href="{{ $event->website }}" target="_blank" class="text-sm text-blue-600 hover:underline mt-1 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[16px]">open_in_new</span> {{ $event->website }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="space-y-6">
            {{-- Jadwal --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">event</span>
                    <h3 class="text-sm font-bold text-gray-800">Jadwal</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Tanggal Mulai</label>
                        <p class="text-sm font-medium text-gray-800 mt-1">{{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y') }}</p>
                    </div>
                    @if($event->end_date)
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Tanggal Selesai</label>
                        <p class="text-sm font-medium text-gray-800 mt-1">{{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y') }}</p>
                    </div>
                    @endif
                    @if($event->time)
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Waktu</label>
                        <p class="text-sm font-medium text-gray-800 mt-1 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px] text-gray-400">schedule</span> {{ $event->time }}
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Koordinat --}}
            @if($event->latitude && $event->longitude)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">location_on</span>
                    <h3 class="text-sm font-bold text-gray-800">Koordinat</h3>
                </div>
                <div class="p-6 space-y-2">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <label class="text-[10px] font-semibold text-gray-500 uppercase">Lat</label>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $event->latitude }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <label class="text-[10px] font-semibold text-gray-500 uppercase">Lng</label>
                            <p class="text-sm font-medium text-gray-800 mt-0.5">{{ $event->longitude }}</p>
                        </div>
                    </div>
                    <a href="https://www.google.com/maps?q={{ $event->latitude }},{{ $event->longitude }}" target="_blank"
                       class="w-full inline-flex items-center justify-center gap-1.5 text-xs text-blue-600 bg-blue-50 border border-blue-100 rounded-lg py-2 mt-2 hover:bg-blue-100 transition-colors font-medium">
                        <span class="material-symbols-outlined text-[16px]">map</span> Buka di Google Maps
                    </a>
                </div>
            </div>
            @endif

            {{-- Metadata --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">info</span>
                    <h3 class="text-sm font-bold text-gray-800">Metadata</h3>
                </div>
                <div class="p-6 space-y-2 text-xs text-gray-500">
                    <div class="flex justify-between">
                        <span>Dibuat</span>
                        <span class="font-medium text-gray-700">{{ $event->created_at ? $event->created_at->translatedFormat('d M Y, H:i') : '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Diperbarui</span>
                        <span class="font-medium text-gray-700">{{ $event->updated_at ? $event->updated_at->translatedFormat('d M Y, H:i') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
