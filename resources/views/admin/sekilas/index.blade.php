@extends('admin.layouts.admin')

@section('title', 'Sekilas Diskominfo')
@section('page-title', 'Sekilas Diskominfo')

@section('content')
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Sekilas Diskominfo</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.sekilas.create') }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90 transition-all"
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
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Konten</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Gambar</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Diperbarui</th>
                        @if (auth()->user()->isAdmin())
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($sekilas as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-gray-400 text-xs">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-gray-800 max-w-md">
                                <p class="line-clamp-2">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                            </td>
                            <td class="px-4 py-3">
                                @if ($item->gambar)
                                    <img src="{{ Storage::url($item->gambar) }}" class="w-16 h-10 object-cover rounded"
                                        alt="">
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-500 text-xs">{{ $item->updated_at?->format('d/m/Y') }}</td>
                            @if (auth()->user()->isAdmin())
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.sekilas.edit', $item) }}"
                                            class="px-3 py-1 rounded text-xs font-medium text-white hover:opacity-80"
                                            style="background-color: #0F2044;">Edit</a>
                                        @if (auth()->user()->isSuperAdmin())
                                            <form method="POST" action="{{ route('admin.sekilas.destroy', $item) }}"
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
            @if ($sekilas->hasPages())
                <div class="px-4 py-3 border-t border-gray-100">{{ $sekilas->links() }}</div>
            @endif
        </div>
    </div>
@endsection
