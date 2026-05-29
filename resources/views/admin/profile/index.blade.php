@extends('admin.layouts.admin')
@section('title', 'Profil Saya')
@section('page-title', 'Profil Saya')

@section('content')
    <div x-data="{ editMode: false, passwordMode: false }" class="max-w-6xl mx-auto pb-10">
        
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                Profil Saya
            </h2>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi profil dan keamanan akun Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Kiri: Kartu Identitas -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center flex flex-col items-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-blue-500 to-blue-700"></div>
                    
                    <div class="relative z-10 w-32 h-32 rounded-full border-4 border-white shadow-lg bg-white flex items-center justify-center overflow-hidden mb-4">
                        @if ($user->profile_photo_url)
                            <img src="{{ $user->profile_photo_url }}" class="w-full h-full object-cover" alt="Profile">
                        @else
                            <span class="text-blue-600 text-4xl font-bold">{{ $user->initials }}</span>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-800">{{ $user->nama }}</h3>
                    <p class="text-gray-500 text-sm mb-3">{{ '@' . $user->username }}</p>
                    
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100 mb-6">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        {{ $user->getCmsRole() == 'admin' ? 'Admin' : ($user->getCmsRole() == 'verifikator' ? 'Verifikator' : 'Pejabat Dinas') }}
                    </span>

                    <div class="w-full space-y-3">
                        <button @click="editMode = true" class="w-full py-2.5 px-4 bg-white border-2 border-blue-600 text-blue-600 font-semibold rounded-xl hover:bg-blue-50 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            Edit Profil
                        </button>
                        @if($user->photo)
                        <form method="POST" action="{{ route('admin.profile.photo.destroy') }}" id="delete-photo-form">
                            @csrf @method('DELETE')
                            <button type="button" onclick="confirmDelete(document.getElementById('delete-photo-form'), 'Apakah Anda yakin ingin menghapus foto profil?')" class="w-full py-2.5 px-4 bg-white border border-red-200 text-red-500 font-semibold rounded-xl hover:bg-red-50 transition-colors flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Hapus Foto
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Kanan: Informasi Pribadi & Statistik -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Informasi Pribadi -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="border-b border-gray-50 bg-gray-50/50 p-5 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800">Informasi Pribadi</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 min-w-0">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Nama Lengkap
                                </p>
                                <p class="font-semibold text-gray-800 truncate">{{ $user->nama ?? '-' }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 min-w-0">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                    Username
                                </p>
                                <p class="font-semibold text-gray-800 truncate">{{ $user->username }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 min-w-0">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    Role
                                </p>
                                <p class="font-semibold text-gray-800 capitalize truncate">{{ $user->getCmsRole() }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 min-w-0">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    No. Telepon
                                </p>
                                <p class="font-semibold text-gray-800 truncate">{{ $user->no_telp ?? '-' }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 md:col-span-2 min-w-0">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h5"></path></svg>
                                    Instansi
                                </p>
                                <p class="font-semibold text-gray-800 truncate">{{ $user->instansi ?? '-' }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100 md:col-span-2 min-w-0">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    Alamat
                                </p>
                                <p class="font-semibold text-gray-800 truncate">{{ $user->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistik Artikel -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                    <div class="bg-white rounded-2xl border-l-4 border-blue-600 shadow-sm p-4 sm:p-5 flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] sm:text-xs text-gray-500 font-medium truncate">Total Artikel</p>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 truncate">{{ $totalArtikel }}</h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border-l-4 border-emerald-500 shadow-sm p-4 sm:p-5 flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] sm:text-xs text-gray-500 font-medium truncate">Dipublikasikan</p>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 truncate">{{ $dipublikasikan }}</h3>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl border-l-4 border-amber-500 shadow-sm p-4 sm:p-5 flex items-center gap-3 sm:gap-4 min-w-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-[10px] sm:text-xs text-gray-500 font-medium truncate">Menunggu</p>
                            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 truncate">{{ $menunggu }}</h3>
                        </div>
                    </div>
                </div>

                <!-- Informasi Akun -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="border-b border-gray-50 bg-gray-50/50 p-5 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800">Informasi Akun</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Akun Dibuat
                                </p>
                                <p class="font-semibold text-gray-800">{{ $user->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-100">
                                <p class="text-xs text-gray-500 mb-1 flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Terakhir Diupdate
                                </p>
                                <p class="font-semibold text-gray-800">{{ $user->updated_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="pt-5 border-t border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h4 class="font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                                    Keamanan Password
                                </h4>
                                <p class="text-sm text-gray-500 mt-1">Ubah password Anda secara berkala untuk keamanan</p>
                            </div>
                            <button @click="passwordMode = true" class="px-5 py-2.5 border-2 border-amber-500 text-amber-600 font-semibold rounded-xl hover:bg-amber-50 transition-colors flex items-center justify-center gap-2 whitespace-nowrap">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Ubah Password
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal Edit Profil -->
        <div x-show="editMode" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="editMode" x-transition.opacity @click="editMode = false" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="editMode" x-transition.scale.origin.bottom class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">Edit Profil</h3>
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Username <span class="text-red-500">*</span></label>
                                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500" required>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">No. Telepon</label>
                                        <input type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instansi</label>
                                        <input type="text" name="instansi" value="{{ old('instansi', $user->instansi) }}" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat</label>
                                    <textarea name="alamat" rows="2" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500">{{ old('alamat', $user->alamat) }}</textarea>
                                </div>
                                <div x-data="{ fileName: '' }">
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ganti Foto Profil</label>
                                    <div class="flex items-center gap-3">
                                        <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-all">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            <span>Pilih Gambar</span>
                                            <input type="file" name="photo" accept="image/jpeg,image/png,image/jpg,image/webp" class="sr-only" x-ref="fileInput" @change="fileName = $refs.fileInput.files[0] ? $refs.fileInput.files[0].name : ''">
                                        </label>
                                        <span class="text-sm text-gray-500 truncate max-w-xs" x-text="fileName ? fileName : 'Belum ada gambar yang dipilih'"></span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Biarkan kosong jika tidak ingin mengubah. Maks 1MB.</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">Simpan Profil</button>
                            <button type="button" @click="editMode = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ubah Password -->
        <div x-show="passwordMode" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="passwordMode" x-transition.opacity @click="passwordMode = false" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div x-show="passwordMode" x-transition.scale.origin.bottom class="relative z-10 inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form method="POST" action="{{ route('admin.profile.password.update') }}">
                        @csrf @method('PUT')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">Ubah Password</h3>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Saat Ini</label>
                                    <input type="password" name="current_password" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru</label>
                                    <input type="password" name="password" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500" required minlength="8">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500" required minlength="8">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-amber-500 text-base font-medium text-white hover:bg-amber-600 sm:ml-3 sm:w-auto sm:text-sm">Ubah Password</button>
                            <button type="button" @click="passwordMode = false" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
