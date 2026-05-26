@extends('admin.layouts.admin')

@section('title', 'Manajemen Jenis Kegiatan')
@section('page-title', 'Manajemen Jenis Kegiatan')

@section('content')
    <div class="space-y-6 max-w-5xl mx-auto" x-data="{
        showModal: false,
        modalMode: 'add',
        form: {
            id: '',
            nama: '',
            warna: 'bg-gray-50 text-gray-700 border-gray-200'
        },
        openAddModal() {
            this.modalMode = 'add';
            this.form.id = '';
            this.form.nama = '';
            this.form.warna = 'bg-gray-50 text-gray-700 border-gray-200';
            this.showModal = true;
        },
        openEditModal(item) {
            this.modalMode = 'edit';
            this.form.id = item.id;
            this.form.nama = item.nama;
            this.form.warna = item.warna;
            this.showModal = true;
        }
    }">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-2">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Jenis Kegiatan</h2>
                <p class="text-sm text-gray-500 mt-0.5">Kelola tipe atau jenis dari daftar kegiatan/lowongan</p>
            </div>
            @if (auth()->user()->isAdmin())
                <button @click="openAddModal()" class="flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm" style="background-color: #1a56db;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Jenis
                </button>
            @endif
        </div>

        {{-- Main Container --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50/50 text-gray-500 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 font-semibold tracking-wider w-16">NO</th>
                            <th class="px-6 py-4 font-semibold tracking-wider">NAMA JENIS</th>
                            <th class="px-6 py-4 font-semibold tracking-wider">PREVIEW BADGE</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-6 py-4 font-semibold tracking-wider w-32">AKSI</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($items as $index => $item)
                            <tr class="hover:bg-blue-50/20 transition-colors">
                                <td class="px-6 py-4 align-middle text-gray-500 font-medium">
                                    {{ $items->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <p class="font-bold text-gray-900">{{ $item->nama }}</p>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold border {{ $item->warna }}">
                                        {{ $item->nama }}
                                    </span>
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-6 py-4 align-middle">
                                        <div class="flex items-center justify-start gap-2">
                                            <button @click="openEditModal({{ json_encode($item) }})" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 hover:text-blue-700 transition-colors" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                            </button>
                                            @if (auth()->user()->isSuperAdmin())
                                                <form method="POST" action="{{ route('admin.jenis-lowongan.destroy', $item) }}" class="inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button" onclick="confirmDelete(this.closest('form'), 'Jenis kegiatan ini akan dihapus secara permanen.')" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-orange-100 hover:text-orange-600 transition-colors" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->isAdmin() ? 4 : 3 }}" class="px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    <p class="text-gray-500 font-medium">Belum ada data jenis kegiatan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $items->links() }}
            </div>
        </div>

        {{-- Modal --}}
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center" style="z-index: 9999;" x-cloak>
            {{-- Backdrop --}}
            <div x-show="showModal" x-transition.opacity class="absolute inset-0" style="background-color: rgba(0, 0, 0, 0.65);" @click="showModal = false"></div>
            
            {{-- Modal Panel --}}
            <div x-show="showModal" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg mx-4 overflow-hidden">
                
                {{-- Header --}}
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800" x-text="modalMode === 'add' ? 'Tambah Jenis Kegiatan' : 'Edit Jenis Kegiatan'"></h3>
                    <button @click="showModal = false" type="button" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form :action="modalMode === 'add' ? '{{ route('admin.jenis-lowongan.store') }}' : '{{ url('admin/jenis-lowongan') }}/' + form.id" method="POST">
                    @csrf
                    <template x-if="modalMode === 'edit'">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Jenis <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" x-model="form.nama" required class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Misal: Magang">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pilih Warna Badge</label>
                            <input type="hidden" name="warna" x-model="form.warna">
                            
                            <div class="flex flex-wrap gap-3 mt-2">
                                {{-- Abu-abu --}}
                                <button type="button" @click="form.warna = 'bg-gray-50 text-gray-700 border-gray-200'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-gray-400 shadow-sm"
                                    :class="form.warna === 'bg-gray-50 text-gray-700 border-gray-200' ? 'ring-4 ring-gray-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Abu-abu">
                                    <svg x-show="form.warna === 'bg-gray-50 text-gray-700 border-gray-200'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                
                                {{-- Indigo --}}
                                <button type="button" @click="form.warna = 'bg-indigo-50 text-indigo-700 border-indigo-100'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-indigo-500 shadow-sm"
                                    :class="form.warna === 'bg-indigo-50 text-indigo-700 border-indigo-100' ? 'ring-4 ring-indigo-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Indigo">
                                    <svg x-show="form.warna === 'bg-indigo-50 text-indigo-700 border-indigo-100'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                
                                {{-- Biru Langit --}}
                                <button type="button" @click="form.warna = 'bg-sky-50 text-sky-700 border-sky-100'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-sky-400 shadow-sm"
                                    :class="form.warna === 'bg-sky-50 text-sky-700 border-sky-100' ? 'ring-4 ring-sky-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Biru Langit">
                                    <svg x-show="form.warna === 'bg-sky-50 text-sky-700 border-sky-100'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                
                                {{-- Hijau --}}
                                <button type="button" @click="form.warna = 'bg-emerald-50 text-emerald-700 border-emerald-100'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-emerald-500 shadow-sm"
                                    :class="form.warna === 'bg-emerald-50 text-emerald-700 border-emerald-100' ? 'ring-4 ring-emerald-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Hijau">
                                    <svg x-show="form.warna === 'bg-emerald-50 text-emerald-700 border-emerald-100'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                
                                {{-- Kuning --}}
                                <button type="button" @click="form.warna = 'bg-amber-50 text-amber-700 border-amber-100'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-amber-400 shadow-sm"
                                    :class="form.warna === 'bg-amber-50 text-amber-700 border-amber-100' ? 'ring-4 ring-amber-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Kuning">
                                    <svg x-show="form.warna === 'bg-amber-50 text-amber-700 border-amber-100'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                
                                {{-- Merah --}}
                                <button type="button" @click="form.warna = 'bg-red-50 text-red-700 border-red-100'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-red-500 shadow-sm"
                                    :class="form.warna === 'bg-red-50 text-red-700 border-red-100' ? 'ring-4 ring-red-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Merah">
                                    <svg x-show="form.warna === 'bg-red-50 text-red-700 border-red-100'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                
                                {{-- Ungu --}}
                                <button type="button" @click="form.warna = 'bg-purple-50 text-purple-700 border-purple-100'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-purple-500 shadow-sm"
                                    :class="form.warna === 'bg-purple-50 text-purple-700 border-purple-100' ? 'ring-4 ring-purple-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Ungu">
                                    <svg x-show="form.warna === 'bg-purple-50 text-purple-700 border-purple-100'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                                
                                {{-- Merah Muda --}}
                                <button type="button" @click="form.warna = 'bg-pink-50 text-pink-700 border-pink-100'" 
                                    class="w-8 h-8 rounded-full transition-all flex items-center justify-center bg-pink-400 shadow-sm"
                                    :class="form.warna === 'bg-pink-50 text-pink-700 border-pink-100' ? 'ring-4 ring-pink-200 scale-110' : 'hover:scale-110 opacity-70 hover:opacity-100'" title="Merah Muda">
                                    <svg x-show="form.warna === 'bg-pink-50 text-pink-700 border-pink-100'" class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </button>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-700 mb-1">Preview:</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold border" :class="form.warna" x-text="form.nama || 'Nama Jenis'"></span>
                        </div>
                    </div>
                    
                    {{-- Footer --}}
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3">
                        <button type="button" @click="showModal = false" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors" style="background-color: #1a56db;">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
