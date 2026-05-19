@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <style>
        #wifiMap .leaflet-control-attribution {
            font-size: 10px;
            background: rgba(255, 255, 255, 0.7);
        }

        #wifiMap .wifi-marker-icon {
            background-color: #044FA0;
            border: 3px solid white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            color: white;
            font-size: 14px;
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
                                    {{ number_format($wifis->count()) }}</h3>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map centered on South Tangerang, zoom control disabled (re-added bottom-right)
            var map = L.map('wifiMap', {
                zoomControl: false
            }).setView([-6.2886, 106.7179], 13);

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

            // WiFi hotspot locations from Database
            var locations = @json($wifis);

            if (locations && locations.length > 0) {
                // If there are locations, fit the bounds to include all markers
                var bounds = [];

                locations.forEach(function(loc) {
                    if (loc.latitude && loc.longitude) {
                        var lat = parseFloat(loc.latitude);
                        var lng = parseFloat(loc.longitude);
                        bounds.push([lat, lng]);

                        var keterangan = loc.keterangan ? loc.keterangan : 'Titik WiFi Publik';
                        var ssid = loc.ssid ? 'SSID: <b>' + loc.ssid + '</b>' : '';
                        var kecepatan = loc.kecepatan ? ' | ' + loc.kecepatan : '';
                        var extraInfo = (ssid || kecepatan) ?
                            '<br><span style="color:#333; font-size:12px;">' + ssid + kecepatan +
                            '</span>' : '';

                        L.marker([lat, lng], {
                                icon: makeIcon()
                            })
                            .addTo(map)
                            .bindPopup(
                                '<b style="color:#044FA0;">' + loc.n_wilayah + '</b>' +
                                '<br><span style="color:#555;">' + keterangan + '</span>' +
                                extraInfo +
                                '<br><span style="color:#22c55e;font-size:12px;">&#9679; Active</span>'
                            );
                    }
                });

                if (bounds.length > 0) {
                    map.fitBounds(bounds);
                }
            }


        });
    </script>
@endpush
