@extends('admin.layouts.admin')
@section('title', 'Lowongan Karir')
@section('page-title', 'Lowongan Karir')

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <h2 class="text-lg font-bold text-gray-800">Lowongan Pekerjaan & Magang</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.lowongan.create') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90"
                    style="background-color: #0F2044;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Lowongan
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm">
            <div class="overflow-x-auto">
                <table id="table-lowongan" class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Banner</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Posisi / Judul</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jenis</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tipe Kerja</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tanggal Tutup</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($items as $item)
                            <tr class="hover:bg-gray-50">
                                {{-- Banner --}}
                                <td class="px-4 py-3">
                                    @if ($item->gambar)
                                        <img src="{{ Storage::url($item->gambar) }}"
                                            class="w-20 h-12 object-cover rounded-lg lb-thumb"
                                            onclick="openLightbox(this.src)" alt="Banner {{ $item->posisi }}">
                                    @else
                                        <div class="w-20 h-12 rounded-lg bg-gray-100 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>

                                {{-- Posisi --}}
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-gray-800">{{ $item->posisi }}</p>
                                    @if ($item->lokasi)
                                        <p class="text-xs text-gray-400 mt-0.5">{{ $item->lokasi }}</p>
                                    @endif
                                </td>

                                {{-- Jenis --}}
                                <td class="px-4 py-3">
                                    @php
                                        $jenisBadge = match($item->jenis) {
                                            'pekerjaan' => 'bg-indigo-100 text-indigo-700',
                                            'magang'    => 'bg-sky-100 text-sky-700',
                                            'program'   => 'bg-emerald-100 text-emerald-700',
                                            'kompetisi' => 'bg-amber-100 text-amber-700',
                                            default     => 'bg-gray-100 text-gray-600',
                                        };
                                        $jenisLabel = match($item->jenis) {
                                            'pekerjaan' => 'Pekerjaan',
                                            'magang'    => 'Magang',
                                            'program'   => 'Program',
                                            'kompetisi' => 'Kompetisi',
                                            default     => $item->jenis,
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded text-xs font-semibold {{ $jenisBadge }}">
                                        {{ $jenisLabel }}
                                    </span>
                                </td>

                                {{-- Tipe Kerja --}}
                                <td class="px-4 py-3 text-gray-500 text-xs">{{ $item->tipe_kerja ?? '-' }}</td>

                                {{-- Tanggal Tutup --}}
                                <td class="px-4 py-3 text-xs">
                                    @if ($item->tanggal_tutup)
                                        @php $isExpired = $item->tanggal_tutup->isPast(); @endphp
                                        <span class="{{ $isExpired ? 'text-red-500' : 'text-gray-600' }}">
                                            {{ $item->tanggal_tutup->isoFormat('D MMM YYYY') }}
                                        </span>
                                        @if ($isExpired)
                                            <span class="ml-1 text-[10px] text-red-400">(Lewat)</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded text-xs font-medium
                                        {{ $item->status === 'buka' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-500' }}">
                                        {{ $item->status === 'buka' ? 'Buka' : 'Tutup' }}
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.lowongan.edit', $item) }}"
                                                class="px-3 py-1 rounded text-xs font-medium text-white hover:opacity-80"
                                                style="background-color: #0F2044;">Edit</a>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.lowongan.destroy', $item) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(this.closest('form'), 'Lowongan yang dihapus tidak dapat dikembalikan.')"
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
        <div id="dt-paging-lowongan"></div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#table-lowongan').DataTable({
            layout: {
                bottomStart: 'info',
                bottomEnd: '#dt-paging-lowongan',
            },
            columnDefs: [
                { orderable: false, targets: [0, 2, 4, -1] }
            ],
        });
    </script>
@endpush
