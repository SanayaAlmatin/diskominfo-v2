@extends('admin.layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kelola Pengguna</h2>
                <p class="text-sm text-gray-500 mt-0.5">Manajemen akses dan akun pengguna</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm" style="background-color: #1a56db;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah Pengguna
            </a>
        </div>

        {{-- Custom Filter Bar --}}
        <form method="GET" action="{{ route('admin.users.index') }}" class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 flex flex-col lg:flex-row gap-4 items-end">
            <div class="flex-1 w-full lg:w-auto">
                <label class="block text-xs font-semibold text-gray-600 mb-1.5"><svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>Cari Pengguna</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau email..." class="w-full px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>
            <div class="flex gap-2 w-full lg:w-auto">
                <button type="submit" class="flex-1 lg:flex-none px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center justify-center gap-2" style="background-color: #1a56db;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    Filter
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors flex items-center justify-center gap-2" title="Reset Filter">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                    Reset
                </a>
            </div>
        </form>

        {{-- Main Container --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50/50 text-gray-500 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold tracking-wider">PENGGUNA</th>
                            <th class="px-6 py-4 font-semibold tracking-wider">USERNAME</th>
                            <th class="px-6 py-4 font-semibold tracking-wider">EMAIL</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-32">ROLE</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-32">LOGIN</th>
                            <th class="px-6 py-4 font-semibold tracking-wider w-32">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-blue-50/20 transition-colors group">
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        @if ($user->avatar)
                                            <img src="{{ $user->avatar }}" class="w-10 h-10 rounded-xl object-cover border-2 border-white shadow-sm" alt="">
                                        @else
                                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold text-white shadow-sm bg-blue-600">
                                                {{ strtoupper(substr($user->nama ?? $user->username, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <span class="font-bold text-gray-800">{{ $user->nama ?? '—' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle text-gray-600 font-mono text-sm">{{ $user->username }}</td>
                                <td class="px-6 py-4 align-middle text-gray-500">{{ $user->email ?? '—' }}</td>
                                <td class="px-6 py-4 align-middle">
                                    @php $role = $user->getCmsRole(); @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold
                                        {{ $role === 'super-admin' ? 'bg-red-50 text-red-700 border border-red-100' : ($role === 'admin' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-gray-50 text-gray-700 border border-gray-200') }}">
                                        {{ $role === 'super-admin' ? 'Super Admin' : ($role === 'admin' ? 'Admin' : 'Guest') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 align-middle text-sm text-gray-500 font-medium">
                                    @if ($user->google_id)
                                        <span class="inline-flex items-center gap-1.5">
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                                            </svg>
                                            Google
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                            Password
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle ">
                                    <div class="flex items-center justify-start gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </a>
                                        @if ($user->id !== auth()->id())
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline-block">
                                                @csrf @method('DELETE')
                                                <button type="button" onclick="confirmDelete(this.closest('form'), 'Pengguna \'{{ addslashes($user->username) }}\' akan dihapus permanen.')" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-100 hover:text-orange-600 transition-colors" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                    <p class="text-gray-500 font-medium">Belum ada data pengguna</p>
                                    <p class="text-gray-400 text-sm mt-1">Pengguna tidak ditemukan berdasarkan pencarian Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $users->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection

