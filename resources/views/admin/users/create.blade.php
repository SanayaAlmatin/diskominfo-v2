@extends('admin.layouts.admin')
@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')

@section('content')
    <div class="max-w-2xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Tambah Pengguna</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Username <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="username" value="{{ old('username') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('username') border-red-400 @enderror">
                        @error('username')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-400 @enderror">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Telepon</label>
                        <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instansi</label>
                    <input type="text" name="instansi" value="{{ old('instansi') }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password <span
                            class="text-red-500">*</span></label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-400 @enderror"
                        autocomplete="new-password">
                    @error('password')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Role CMS</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($roles as $role)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="role_ids[]" value="{{ $role->id }}"
                                    {{ collect(old('role_ids', []))->contains($role->id) ? 'checked' : '' }}
                                    class="w-4 h-4 border-gray-300">
                                <span class="text-sm text-gray-700">{{ $role->display_name ?? $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('role_ids')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit" class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90"
                        style="background-color: #0F2044;">Simpan</button>
                    <a href="{{ route('admin.users.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
