@extends('admin.layouts.admin')
@section('title', 'Visi & Misi')
@section('page-title', 'Visi & Misi')

@section('content')
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Visi & Misi</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.visi-misi.create') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90"
                    style="background-color: #0F2044;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah
                </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Tipe</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Konten</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Urutan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                        @if (auth()->user()->isAdmin())
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($items as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <span
                                    class="px-2 py-1 rounded text-xs font-semibold {{ $item->tipe === 'visi' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                                    {{ strtoupper($item->tipe) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-800 max-w-lg">
                                <p class="line-clamp-2">{{ Str::limit($item->konten, 140) }}</p>
                            </td>
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
                                        <a href="{{ route('admin.visi-misi.edit', $item) }}"
                                            class="px-3 py-1 rounded text-xs font-medium text-white hover:opacity-80"
                                            style="background-color: #0F2044;">Edit</a>
                                        @if (auth()->user()->isSuperAdmin())
                                            <form method="POST" action="{{ route('admin.visi-misi.destroy', $item) }}"
                                                onsubmit="return confirm('Hapus data ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-gray-400 text-sm">Belum ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($items->hasPages())
                <div class="px-4 py-3 border-t border-gray-100">{{ $items->links() }}</div>
            @endif
        </div>
    </div>
@endsection
