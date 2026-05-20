@extends('admin.layouts.admin')

@section('title', 'Edit Titik WiFi')
@section('page-title', 'Edit Titik WiFi')

@section('content')
    <div class="max-w-4xl">
        <div class="flex items-center gap-3 mb-5">
            <a href="{{ route('admin.wifi.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="text-lg font-bold text-gray-800">Edit Titik WiFi</h2>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.wifi.update', $wifi) }}" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Wilayah / Lokasi <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="n_wilayah" value="{{ old('n_wilayah', $wifi->n_wilayah) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#0F2044] focus:border-[#0F2044] text-sm @error('n_wilayah') border-red-400 @enderror"
                            placeholder="Contoh: Taman Kota BSD">
                        @error('n_wilayah')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama SSID</label>
                        <input type="text" name="ssid" value="{{ old('ssid', $wifi->ssid) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#0F2044] focus:border-[#0F2044] text-sm @error('ssid') border-red-400 @enderror"
                            placeholder="Contoh: @PemkotTangsel_Free">
                        @error('ssid')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kecepatan</label>
                        <input type="text" name="kecepatan" value="{{ old('kecepatan', $wifi->kecepatan) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#0F2044] focus:border-[#0F2044] text-sm @error('kecepatan') border-red-400 @enderror"
                            placeholder="Contoh: 50 Mbps">
                        @error('kecepatan')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Keterangan Lokasi</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#0F2044] focus:border-[#0F2044] text-sm @error('keterangan') border-red-400 @enderror"
                        placeholder="Detail lokasi (contoh: Dekat pintu masuk utama)">{{ old('keterangan', $wifi->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="border-gray-100">

                <div class="space-y-3">
                    <label class="block text-sm font-semibold text-gray-700">Tentukan Titik Koordinat <span
                            class="text-red-500">*</span></label>
                    <p class="text-xs text-gray-500">Cari nama tempat, klik tombol "Lokasi Saya", atau geser pin/klik pada
                        peta untuk menentukan posisi.</p>

                    {{-- Map Container --}}
                    <div id="map"
                        class="w-full h-[400px] rounded-xl border border-gray-300 shadow-inner overflow-hidden relative"
                        style="z-index: 10;"></div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Latitude</label>
                            <input type="text" name="latitude" id="latitude"
                                value="{{ old('latitude', $normalizedCoordinates['latitude'] ?? $wifi->latitude) }}" required readonly
                                class="w-full px-3 py-1.5 bg-gray-50 border border-gray-300 rounded-lg text-sm text-gray-600 outline-none">
                            @error('latitude')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1">Longitude</label>
                            <input type="text" name="longitude" id="longitude"
                                value="{{ old('longitude', $normalizedCoordinates['longitude'] ?? $wifi->longitude) }}" required readonly
                                class="w-full px-3 py-1.5 bg-gray-50 border border-gray-300 rounded-lg text-sm text-gray-600 outline-none">
                            @error('longitude')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="submit"
                        class="px-6 py-2.5 rounded-lg text-sm font-bold text-white hover:opacity-90 transition-all"
                        style="background-color: #0F2044;">
                        Perbarui
                    </button>
                    <a href="{{ route('admin.wifi.index') }}"
                        class="px-6 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet Geocoder CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        /* Custom map pin style mimicking Google Maps */
        .leaflet-geocoder-icon {
            border-radius: 4px;
        }

        .leaflet-geocoder-form input {
            font-size: 14px;
        }

        /* Lokasi Saya Button Custom Style */
        .leaflet-control-locate {
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.65);
            cursor: pointer;
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .leaflet-control-locate:hover {
            background-color: #f4f4f4;
        }
    </style>
@endpush

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Leaflet Geocoder JS -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangerang Selatan Center as default
            var defaultLat = -6.2886;
            var defaultLng = 106.7179;
            var currentLat = document.getElementById('latitude').value;
            var currentLng = document.getElementById('longitude').value;

            var initialLat = currentLat ? parseFloat(currentLat) : defaultLat;
            var initialLng = currentLng ? parseFloat(currentLng) : defaultLng;

            // Initialize Map
            var map = L.map('map').setView([initialLat, initialLng], 15);

            // Add Tile Layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'Â© OpenStreetMap contributors'
            }).addTo(map);

            // Marker
            var marker = null;
            if (currentLat && currentLng) {
                marker = L.marker([currentLat, currentLng], {
                    draggable: true
                }).addTo(map);
            }

            function updateInputs(lat, lng) {
                document.getElementById('latitude').value = lat.toFixed(6);
                document.getElementById('longitude').value = lng.toFixed(6);
            }

            function setMarker(lat, lng) {
                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng], {
                        draggable: true
                    }).addTo(map);

                    marker.on('dragend', function(e) {
                        var position = marker.getLatLng();
                        updateInputs(position.lat, position.lng);
                    });
                }
                map.setView([lat, lng], 15);
                updateInputs(lat, lng);
            }

            // Click on map event
            map.on('click', function(e) {
                setMarker(e.latlng.lat, e.latlng.lng);
            });

            // Geocoder (Search Box)
            var geocoder = L.Control.geocoder({
                    defaultMarkGeocode: false,
                    placeholder: "Cari lokasi...",
                })
                .on('markgeocode', function(e) {
                    var center = e.geocode.center;
                    setMarker(center.lat, center.lng);

                    var nameInput = document.querySelector('input[name="n_wilayah"]');
                    if (!nameInput.value) {
                        nameInput.value = e.geocode.name.split(',')[0];
                    }
                })
                .addTo(map);

            // Custom "Lokasi Saya" Control
            var LocateControl = L.Control.extend({
                options: {
                    position: 'topleft'
                },
                onAdd: function(map) {
                    var container = L.DomUtil.create('div',
                        'leaflet-bar leaflet-control leaflet-control-custom');

                    var button = L.DomUtil.create('a', 'leaflet-control-locate', container);
                    button.href = '#';
                    button.title = 'Lokasi Saya';
                    button.innerHTML =
                        '<svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" fill="#444"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm8.94 3c-.46-4.17-3.77-7.48-7.94-7.94V1h-2v2.06C6.83 3.52 3.52 6.83 3.06 11H1v2h2.06c.46 4.17 3.77 7.48 7.94 7.94V23h2v-2.06c4.17-.46 7.48-3.77 7.94-7.94H23v-2h-2.06zM12 19c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"/></svg>';

                    L.DomEvent.on(button, 'click', L.DomEvent.stopPropagation)
                        .on(button, 'click', L.DomEvent.preventDefault)
                        .on(button, 'click', function() {
                            map.locate({
                                setView: true,
                                maxZoom: 16
                            });
                        });

                    return container;
                }
            });
            map.addControl(new LocateControl());

            map.on('locationfound', function(e) {
                setMarker(e.latlng.lat, e.latlng.lng);
            });

            map.on('locationerror', function(e) {
                alert("Tidak dapat menemukan lokasi Anda. Pastikan browser memberikan izin GPS.");
            });

            if (marker) {
                marker.on('dragend', function(e) {
                    var position = marker.getLatLng();
                    updateInputs(position.lat, position.lng);
                });
            }
        });
    </script>
@endpush
