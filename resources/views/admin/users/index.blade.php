@extends('admin.layouts.admin')
@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')

@section('content')
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Daftar Pengguna</h2>
            <a href="{{ route('admin.users.create') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90"
                style="background-color: #0F2044;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pengguna
            </a>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Pengguna</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Username</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Login</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" class="w-8 h-8 rounded-full object-cover"
                                            alt="">
                                    @else
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white"
                                            style="background-color: #0F2044;">
                                            {{ strtoupper(substr($user->nama ?? $user->username, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-800">{{ $user->nama ?? '—' }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-gray-600 font-mono text-xs">{{ $user->username }}</td>
                            <td class="px-4 py-3 text-gray-500 text-xs">{{ $user->email ?? '—' }}</td>
                            <td class="px-4 py-3">
                                @php $role = $user->getCmsRole(); @endphp
                                <span
                                    class="px-2 py-1 rounded text-xs font-semibold
                            {{ $role === 'super-admin' ? 'bg-red-100 text-red-700' : ($role === 'admin' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ $role === 'super-admin' ? 'Super Admin' : ($role === 'admin' ? 'Admin' : 'Guest') }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-400">
                                @if ($user->google_id)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                                fill="#4285F4" />
                                            <path
                                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                                fill="#34A853" />
                                            <path
                                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                                fill="#EA4335" />
                                        </svg>
                                        Google
                                    </span>
                                @else
                                    <span>Password</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="px-3 py-1 rounded text-xs font-medium text-white hover:opacity-80"
                                        style="background-color: #0F2044;">Edit</a>
                                    @if ($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                            onsubmit="return confirm('Hapus pengguna {{ addslashes($user->username) }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 rounded text-xs font-medium bg-red-500 text-white hover:bg-red-600">Hapus</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-gray-400 text-sm">Belum ada pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($users->hasPages())
                <div class="px-4 py-3 border-t border-gray-100">{{ $users->links() }}</div>
            @endif
        </div>
    </div>
@endsection
