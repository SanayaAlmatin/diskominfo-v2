@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <style>
        #wifiMap .leaflet-control-attribution {
            font-size: 10px;
            background: rgba(255, 255, 255, 0.7);
        }

        #wifiMap .wifi-marker-icon {
            background-color: #4F46E5;
            border: 2px solid #ffffff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px -2px rgba(79, 70, 229, 0.35);
            color: white;
            font-size: 14px;
        }

        #wifiMapLoading,
        #wifiMapHint {
            background: rgba(15, 23, 42, 0.78);
            color: #fff;
            font-size: 12px;
            line-height: 1.3;
            border-radius: 8px;
            padding: 6px 10px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.18);
        }

        #wifiMapHint.is-warning {
            background: rgba(180, 83, 9, 0.88);
        }

        #wifiMapHint.is-error {
            background: rgba(185, 28, 28, 0.88);
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endpush

<section id="wifi" class="py-16 md:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Title --}}
        <div class="mb-10 text-center">
            <span class="text-blue-600 font-bold tracking-widest text-sm uppercase">Infrastruktur & Jaringan</span>
            <h2 class="mt-2 text-3xl font-extrabold text-slate-900 sm:text-4xl">Peta Konektivitas Digital</h2>
            <p class="mt-4 text-slate-600 max-w-2xl mx-auto text-sm md:text-base">
                Pantauan persebaran titik WiFi publik dan jaringan intra pemerintah di seluruh wilayah Kota Tangerang
                Selatan.
            </p>
        </div>

        {{-- Rounded Frame Wrapper --}}
        <div class="relative w-full rounded-2xl md:rounded-3xl overflow-hidden shadow-2xl border border-gray-200">

            {{-- ── Leaflet Map Container ── --}}
            <div id="wifiMap" class="w-full h-[350px] md:h-[500px] lg:h-[600px] z-0"></div>
            <div class="pointer-events-none absolute left-3 top-3 z-[500] flex flex-col gap-2">
                <div id="wifiMapLoading" class="hidden">Memuat titik WiFi...</div>
                <div id="wifiMapHint" class="hidden"></div>
            </div>

            {{-- ── Stats Footer (below the map) ── --}}
            <div class="relative bg-[#044FA0] border-t border-white/10">
                <div class="max-w-7xl mx-auto px-2 py-4 md:px-6 md:py-6">
                    <div class="flex flex-row items-center justify-between divide-x divide-white/20">

                        {{-- Stat 1: WiFi Points --}}
                        <div class="flex items-center justify-center gap-3 w-1/2 px-2 md:px-4">
                            <div
                                class="w-10 h-10 md:w-14 md:h-14 rounded-full border border-white/20 bg-white/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-wifi text-[#F7D558] text-base md:text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-extrabold text-xl md:text-2xl leading-none">
                                    {{ number_format($wifiTotal ?? 0) }}</h3>
                                <p
                                    class="text-[#F7D558] font-bold text-[10px] md:text-xs tracking-wider uppercase mt-1">
                                    WiFi Points</p>
                                <p class="hidden md:block text-blue-200 text-sm mt-1">City-wide public hotspots</p>
                            </div>
                        </div>

                        {{-- Stat 2: Intra Networks --}}
                        <div class="flex items-center justify-center gap-3 w-1/2 px-2 md:px-4">
                            <div
                                class="w-10 h-10 md:w-14 md:h-14 rounded-full border border-white/20 bg-white/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-network-wired text-[#F7D558] text-base md:text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-extrabold text-xl md:text-2xl leading-none">8</h3>
                                <p
                                    class="text-[#F7D558] font-bold text-[10px] md:text-xs tracking-wider uppercase mt-1">
                                    Intra Networks</p>
                                <p class="hidden md:block text-blue-200 text-sm mt-1">Government intranet nodes</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>{{-- end rounded frame wrapper --}}
    </div>{{-- end max-w-7xl --}}
</section>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" data-navigate-once></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js" data-navigate-once></script>
    <script>
        (function() {
            var endpoint = @json(route('wifi.locations'));
            var MIN_DETAIL_ZOOM = 12;
            var REQUEST_DEBOUNCE_MS = 280;

            function bootWifiMap() {
                var mapEl = document.getElementById('wifiMap');
                if (!mapEl) return;
                if (mapEl._leaflet_id) return; // already initialized (guard against double-boot)

                var loadingEl = document.getElementById('wifiMapLoading');
                var hintEl = document.getElementById('wifiMapHint');
                if (typeof window.L === 'undefined') {
                    if (hintEl) {
                        hintEl.textContent = 'Library peta gagal dimuat. Coba muat ulang halaman.';
                        hintEl.classList.remove('hidden');
                        hintEl.classList.add('is-error');
                    }
                    return;
                }

                // Initialize map centered on South Tangerang, zoom control disabled (re-added bottom-right)
                var map = L.map('wifiMap', {
                    zoomControl: false,
                    maxZoom: 20
                }).setView([-6.2886, 106.7179], 13);
                var markersLayer = typeof L.markerClusterGroup === 'function' ?
                    L.markerClusterGroup({
                        chunkedLoading: true,
                        chunkInterval: 80,
                        chunkDelay: 20,
                        removeOutsideVisibleBounds: true,
                        spiderfyOnMaxZoom: true,
                        showCoverageOnHover: false,
                    }) :
                    L.layerGroup();
                var activeController = null;
                var latestRequestId = 0;

                // Move zoom control to bottom-right so it clears the stats overlay
                L.control.zoom({
                    position: 'bottomright'
                }).addTo(map);

                // Google Maps road tile layer
                L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
                    attribution: '&copy; <a href="https://maps.google.com" target="_blank" rel="noopener">Google Maps</a>'
                }).addTo(map);
                markersLayer.addTo(map);

                // Custom WiFi marker using a div icon
                function makeIcon() {
                    return L.divIcon({
                        className: '',
                        html: '<div class="wifi-marker-icon"><i class="fas fa-wifi"></i></div>',
                        iconSize: [36, 36],
                        iconAnchor: [18, 18],
                        popupAnchor: [0, -20]
                    });
                }

                function escapeHtml(value) {
                    return String(value ?? '')
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;')
                        .replace(/'/g, '&#039;');
                }

                function buildPopup(loc) {
                    var wilayah = escapeHtml(loc.n_wilayah || 'Titik WiFi');
                    var keterangan = escapeHtml(loc.keterangan || 'Titik WiFi Publik');
                    var ssid = loc.ssid ? 'SSID: <b>' + escapeHtml(loc.ssid) + '</b>' : '';
                    var kecepatan = loc.kecepatan ? ' | ' + escapeHtml(loc.kecepatan) : '';
                    var extraInfo = (ssid || kecepatan) ?
                        '<br><span style="color:#333; font-size:12px;">' + ssid + kecepatan + '</span>' : '';

                    return '<b style="color:#4F46E5;">' + wilayah + '</b>' +
                        '<br><span style="color:#555;">' + keterangan + '</span>' +
                        extraInfo +
                        '<br><span style="color:#22c55e;font-size:12px;">&#9679; Active</span>';
                }

                function setLoadingState(isLoading) {
                    loadingEl.classList.toggle('hidden', !isLoading);
                }

                function setHint(message, tone) {
                    if (!message) {
                        hintEl.classList.add('hidden');
                        hintEl.textContent = '';
                        hintEl.classList.remove('is-warning', 'is-error');
                        return;
                    }

                    hintEl.textContent = message;
                    hintEl.classList.remove('hidden');
                    hintEl.classList.toggle('is-warning', tone === 'warning');
                    hintEl.classList.toggle('is-error', tone === 'error');
                }

                function clearMarkerLayer() {
                    markersLayer.clearLayers();
                }

                function addMarkers(markers) {
                    if (typeof markersLayer.addLayers === 'function') {
                        markersLayer.addLayers(markers);
                        return;
                    }

                    markers.forEach(function(marker) {
                        markersLayer.addLayer(marker);
                    });
                }

                function debounce(callback, wait) {
                    var timeoutId = null;

                    return function() {
                        var args = arguments;
                        clearTimeout(timeoutId);
                        timeoutId = setTimeout(function() {
                            callback.apply(null, args);
                        }, wait);
                    };
                }

                function fetchLocations() {
                    if (map.getZoom() < MIN_DETAIL_ZOOM) {
                        if (activeController) {
                            activeController.abort();
                        }

                        clearMarkerLayer();
                        setLoadingState(false);
                        setHint('Perbesar peta untuk menampilkan titik WiFi.', 'warning');
                        return;
                    }

                    var bounds = map.getBounds();
                    var params = new URLSearchParams({
                        north: bounds.getNorth(),
                        south: bounds.getSouth(),
                        east: bounds.getEast(),
                        west: bounds.getWest(),
                        zoom: map.getZoom()
                    });
                    var requestId = ++latestRequestId;

                    if (activeController) {
                        activeController.abort();
                    }

                    activeController = new AbortController();
                    setLoadingState(true);
                    setHint('');

                    fetch(endpoint + '?' + params.toString(), {
                            headers: {
                                'Accept': 'application/json'
                            },
                            signal: activeController.signal
                        })
                        .then(function(response) {
                            if (!response.ok) {
                                throw new Error('Gagal memuat data titik WiFi.');
                            }

                            return response.json();
                        })
                        .then(function(payload) {
                            if (requestId !== latestRequestId) {
                                return;
                            }

                            var locations = Array.isArray(payload.data) ? payload.data : [];
                            var markers = [];

                            locations.forEach(function(loc) {
                                var lat = Number(String(loc.latitude ?? '').replace(',', '.'));
                                var lng = Number(String(loc.longitude ?? '').replace(',', '.'));

                                if (!Number.isFinite(lat) || !Number.isFinite(lng)) {
                                    return;
                                }

                                var marker = L.marker([lat, lng], {
                                    icon: makeIcon()
                                });
                                marker.bindPopup(buildPopup(loc));
                                markers.push(marker);
                            });

                            clearMarkerLayer();
                            addMarkers(markers);

                            if (payload.meta && payload.meta.has_more) {
                                setHint('Sebagian titik belum dimuat. Perbesar area peta untuk melihat lebih detail.', 'warning');
                                return;
                            }

                            setHint('');
                        })
                        .catch(function(error) {
                            if (error.name === 'AbortError') {
                                return;
                            }

                            setHint('Data titik WiFi gagal dimuat. Coba geser atau muat ulang halaman.', 'error');
                            console.error(error);
                        })
                        .finally(function() {
                            if (requestId === latestRequestId) {
                                setLoadingState(false);
                            }
                        });
                }

                var fetchLocationsDebounced = debounce(fetchLocations, REQUEST_DEBOUNCE_MS);

                map.whenReady(function() {
                    fetchLocations();
                });

                map.on('moveend zoomend', fetchLocationsDebounced);
            }

            document.addEventListener('DOMContentLoaded', bootWifiMap);
            document.addEventListener('livewire:navigated', bootWifiMap);
        })();
    </script>
@endpush
