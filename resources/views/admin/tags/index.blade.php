@extends('admin.layouts.admin')

@section('title', 'Manajemen Tag')
@section('page-title', 'Manajemen Tag')

@push('styles')
@endpush

@section('content')
<div x-data="tagManager()" class="max-w-7xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                <span class="text-blue-600">#</span> Kelola Tag
            </h1>
            <p class="text-gray-500 mt-1">Kelola tag untuk artikel berita</p>
        </div>
        
        <div class="flex items-center gap-3 w-full md:w-auto">
            <form action="{{ route('admin.tags.index') }}" method="GET" class="relative flex-1 md:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tag..." class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-shadow">
                <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </form>
            
            @if(auth()->user()->isAdmin())
            <button @click="openModal()" class="flex items-center justify-center gap-2 px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors shadow-sm whitespace-nowrap" style="background-color: #1a56db;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Tag Baru
            </button>
            @endif
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Tag -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <span class="text-blue-600 text-2xl font-bold">#</span>
            </div>
            <div>
                <p class="text-[28px] font-bold text-gray-900 leading-none mb-1">{{ number_format($totalTag) }}</p>
                <p class="text-sm text-gray-500 font-medium">Total Tag</p>
            </div>
        </div>
        
        <!-- Di Halaman Ini -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: #fffbeb;">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
            </div>
            <div>
                <p class="text-[28px] font-bold text-gray-900 leading-none mb-1">{{ $tags->count() }}</p>
                <p class="text-sm text-gray-500 font-medium">Di Halaman Ini</p>
            </div>
        </div>
        
        <!-- Status -->
        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: #ecfdf5;">
                <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-[28px] font-bold text-gray-900 leading-none mb-1">Aktif</p>
                <p class="text-sm text-gray-500 font-medium">Status Sistem</p>
            </div>
        </div>
    </div>

    <!-- Tags Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse($tags as $tag)
            <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center gap-4 truncate">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <span class="text-blue-600 font-bold">#</span>
                    </div>
                    <h3 class="font-bold text-gray-800 text-[15px] truncate">{{ $tag->n_tag }}</h3>
                </div>
                
                @if(auth()->user()->isAdmin())
                <div class="flex items-center gap-2 flex-shrink-0 ml-2">
                    <button @click="openEditModal({{ $tag->id }}, '{{ addslashes($tag->n_tag) }}')" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                    </button>
                    @if(auth()->user()->isSuperAdmin())
                    <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button type="button" onclick="confirmDelete(this.closest('form'), 'Tag ini akan dihapus secara permanen.')" class="w-8 h-8 rounded-full bg-orange-50 text-orange-500 flex items-center justify-center hover:bg-red-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl p-10 border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" /></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-1">Belum ada tag</h3>
                <p class="text-gray-500">Tidak ada data tag yang ditemukan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($tags->hasPages())
    <div class="pt-2">
        {{ $tags->links() }}
    </div>
    @endif

    <!-- Modal Form -->
    <div x-show="modalOpen" class="fixed inset-0 flex items-center justify-center z-[100]" x-cloak>
        <div x-show="modalOpen" x-transition.opacity class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="closeModal()"></div>
        
        <div x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             class="bg-white rounded-2xl shadow-xl w-full max-w-md relative z-10 overflow-hidden">
             
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900" x-text="isEditing ? 'Edit Tag' : 'Tambah Tag Baru'"></h3>
                <button @click="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form :action="formAction" method="POST">
                @csrf
                <template x-if="isEditing">
                    @method('PUT')
                </template>

                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Tag <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3.5 top-2.5 text-gray-400 font-bold">#</span>
                            <input type="text" name="n_tag" x-model="formData.n_tag" required 
                                   class="w-full pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                                   placeholder="Contoh: ADVERTORIAL, AI, Anak Muda">
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50/50 border-t border-gray-100 flex items-center justify-end gap-3">
                    <button type="button" @click="closeModal()" class="px-5 py-2 text-sm font-semibold text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm" style="background-color: #1a56db;">
                        Simpan Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function tagManager() {
        return {
            modalOpen: false,
            isEditing: false,
            formAction: '{{ route('admin.tags.store') }}',
            formData: {
                n_tag: ''
            },
            openModal() {
                this.isEditing = false;
                this.formAction = '{{ route('admin.tags.store') }}';
                this.formData.n_tag = '';
                this.modalOpen = true;
            },
            openEditModal(id, name) {
                this.isEditing = true;
                this.formAction = '/admin/tags/' + id;
                this.formData.n_tag = name;
                this.modalOpen = true;
            },
            closeModal() {
                this.modalOpen = false;
                setTimeout(() => {
                    this.formData.n_tag = '';
                }, 300);
            }
        }
    }
</script>
@endpush
@endsection
