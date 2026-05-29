@extends('admin.layouts.admin')

@section('title', 'Tambah Event')
@section('page-title', 'Tambah Event')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    #map { height: 300px; z-index: 10; border-radius: 0.5rem; }
</style>
@endpush

@section('content')
<div class="space-y-6 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-2">
        <div>
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-600 text-white flex items-center justify-center">
                    <span class="material-symbols-outlined">calendar_add_on</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Tambah Event</h2>
                    <p class="text-sm text-gray-500">Buat event atau acara baru untuk portal</p>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.events.index') }}" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
            <div class="flex items-start">
                <span class="material-symbols-outlined text-red-500 mr-2">error</span>
                <div>
                    <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan pengisian form:</h3>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-700">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf
        
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Informasi Event -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">description</span>
                    <h3 class="text-sm font-bold text-gray-800">Informasi Event</h3>
                </div>
                <div class="p-6 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Event <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Festival Seni Budaya Tangerang Selatan 2026" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Label / Kategori Event <span class="text-red-500">*</span></label>
                        <input type="text" name="label" list="labelsList" value="{{ old('label') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Festival, Seminar, Workshop, dll" required>
                        <datalist id="labelsList">
                            @foreach($labels as $lbl)
                                <option value="{{ $lbl }}">
                            @endforeach
                        </datalist>
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Mulai ketik untuk melihat saran label yang sudah ada</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi <span class="text-red-500">*</span></label>
                        <input type="text" name="location" value="{{ old('location') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: Gedung Serbaguna BSD, Tangerang Selatan" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Event</label>
                        <textarea name="description" rows="5" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="Tuliskan deskripsi lengkap tentang event ini...">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Waktu Event</label>
                        <input type="text" name="time" value="{{ old('time') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="Contoh: 08:00 - 12:00 atau 08:00 WIB">
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Format bebas, contoh: "09:00 - 17:00" atau "Pukul 14:00 WIB"</p>
                    </div>

                    <div class="pt-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Titik Koordinat Lokasi</label>
                        <div id="map" class="mb-3 border border-gray-200"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Latitude</label>
                                <input type="text" id="latitude" name="latitude" value="{{ old('latitude', '-6.28862') }}" class="w-full border-gray-300 rounded-xl bg-gray-50 focus:bg-white text-sm" readonly>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Longitude</label>
                                <input type="text" id="longitude" name="longitude" value="{{ old('longitude', '106.71789') }}" class="w-full border-gray-300 rounded-xl bg-gray-50 focus:bg-white text-sm" readonly>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Geser pin pada peta untuk menentukan titik lokasi yang tepat.</p>
                    </div>

                    <div class="pt-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Link Pendaftaran / Informasi Event</label>
                        <input type="url" name="event_url" value="{{ old('event_url') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="https://...">
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Link untuk pendaftaran atau informasi lebih lanjut (Opsional)</p>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Website Penyelenggara</label>
                        <input type="url" name="website" value="{{ old('website') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" placeholder="https://...">
                    </div>
                </div>
            </div>

            <!-- Banner Event -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">image</span>
                    <h3 class="text-sm font-bold text-gray-800">Banner Event</h3>
                </div>
                <div class="p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Gambar Banner</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:bg-gray-50 transition-colors relative" id="drop-zone">
                        <input type="file" name="image" id="image-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)">
                        <div id="upload-content">
                            <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">cloud_upload</span>
                            <p class="text-sm font-medium text-gray-700 mb-1">Klik atau drop file di sini</p>
                            <p class="text-xs text-gray-500">Format: JPG, JPEG, PNG (max 5MB).</p>
                        </div>
                        <div id="image-preview" class="hidden relative mt-2">
                            <img id="preview-img" class="max-h-48 mx-auto rounded-lg shadow-sm border border-gray-200">
                            <button type="button" onclick="clearPreview(event)" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600">
                                <span class="material-symbols-outlined text-[16px] block">close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Right Column -->
        <div class="space-y-6">
            
            <!-- Jadwal Event -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">event</span>
                    <h3 class="text-sm font-bold text-gray-800">Jadwal Event</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1 flex items-center gap-1"><span class="material-symbols-outlined text-[14px]">info</span> Kosongkan jika event hanya 1 hari</p>
                    </div>
                </div>
            </div>

            <!-- Tampilan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2 bg-gray-50/50">
                    <span class="material-symbols-outlined text-gray-400">visibility</span>
                    <h3 class="text-sm font-bold text-gray-800">Tampilan</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                                <span class="material-symbols-outlined">publish</span>
                            </div>
                            <div>
                                <p class="font-bold text-sm text-gray-800">Aktifkan Event</p>
                                <p class="text-xs text-gray-500">Tampilkan di website portal</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-50 p-4 rounded-2xl border border-gray-200 flex flex-col gap-3">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-sm shadow-blue-600/30 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span> Simpan Event
                </button>
                <a href="{{ route('admin.events.index') }}" class="w-full bg-white hover:bg-gray-50 text-gray-700 font-bold py-3 px-4 rounded-xl border border-gray-300 text-center transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">close</span> Batal
                </a>
            </div>
            
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    // Image Preview
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const img = document.getElementById('preview-img');
        const content = document.getElementById('upload-content');
        const dropZone = document.getElementById('drop-zone');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
                content.classList.add('hidden');
                dropZone.classList.replace('p-4', 'p-2');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function clearPreview(e) {
        e.preventDefault();
        e.stopPropagation();
        const input = document.getElementById('image-input');
        const preview = document.getElementById('image-preview');
        const content = document.getElementById('upload-content');
        const dropZone = document.getElementById('drop-zone');
        
        input.value = '';
        preview.classList.add('hidden');
        content.classList.remove('hidden');
        dropZone.classList.replace('p-2', 'p-4');
    }

    // Initialize Map
    document.addEventListener('DOMContentLoaded', function() {
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        
        let initialLat = parseFloat(latInput.value);
        let initialLng = parseFloat(lngInput.value);
        
        const map = L.map('map').setView([initialLat, initialLng], 13);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
        
        const marker = L.marker([initialLat, initialLng], {draggable: true}).addTo(map);
        
        // Update inputs on marker drag
        marker.on('dragend', function(e) {
            const position = marker.getLatLng();
            latInput.value = position.lat.toFixed(8);
            lngInput.value = position.lng.toFixed(8);
            map.panTo(position);
        });
        
        // Update marker on map click
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            latInput.value = e.latlng.lat.toFixed(8);
            lngInput.value = e.latlng.lng.toFixed(8);
        });

        // Search coordinate manual input
        latInput.addEventListener('change', updateMarkerFromInputs);
        lngInput.addEventListener('change', updateMarkerFromInputs);

        function updateMarkerFromInputs() {
            let newLat = parseFloat(latInput.value);
            let newLng = parseFloat(lngInput.value);
            if(!isNaN(newLat) && !isNaN(newLng)){
                marker.setLatLng([newLat, newLng]);
                map.panTo([newLat, newLng]);
            }
        }
    });
</script>
@endpush
