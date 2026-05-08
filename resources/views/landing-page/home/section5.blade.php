@php
    $wifiLocations = [
        [
            'name' => 'Puskesmas Serpong',
            'type' => 'Public Health Center',
            'status' => 'Active',
            'distance' => '200m',
            'icon' => 'health_and_safety',
            'top' => '25%',
            'left' => '33%',
        ],
        [
            'name' => 'Taman Kota BSD',
            'type' => 'Public Park',
            'status' => 'Active',
            'distance' => '450m',
            'icon' => 'library_books',
            'top' => '50%',
            'left' => '66%',
        ],
        [
            'name' => 'Kantor Walikota',
            'type' => 'Government Office',
            'status' => 'Active',
            'distance' => '1.2km',
            'icon' => 'account_balance',
            'top' => '66%',
            'left' => '50%',
        ],
        [
            'name' => 'Stasiun Rawa Buntu',
            'type' => 'Transit Hub',
            'status' => 'Active',
            'distance' => '2.5km',
            'icon' => 'train',
            'top' => '80%',
            'left' => '20%',
        ],
    ];
@endphp

<section id="wifi" class="py-16 bg-[#F8FAFC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ── Split Layout (40 / 60) ── --}}
        <div x-data="{
            query: '',
            locations: {{ json_encode($wifiLocations) }},
            get filtered() {
                if (!this.query.trim()) return this.locations;
                const q = this.query.toLowerCase();
                return this.locations.filter(l =>
                    l.name.toLowerCase().includes(q) || l.type.toLowerCase().includes(q)
                );
            }
        }" class="flex flex-col md:flex-row h-auto md:h-[600px] gap-6">

            {{-- ── Left Sidebar — Directory (40%) ── --}}
            <aside class="w-full md:w-[40%] flex flex-col gap-6 overflow-hidden">
                
                {{-- Search & Stats --}}
                <div class="flex flex-col gap-4">
                    {{-- Search Input --}}
                    <div class="relative group">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-600 transition-colors">search</span>
                        <input x-model="query" type="text" placeholder="Find nearest WiFi spot..." 
                            class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 transition-all placeholder:text-slate-400" />
                    </div>

                    {{-- Featured Stats Card --}}
                    <div class="bg-indigo-50/80 p-5 rounded-xl border border-indigo-100 flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold text-indigo-700 uppercase tracking-widest mb-1">Active Connectivity</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">150+ Spots</h3>
                        </div>
                        <div class="bg-indigo-200/50 p-3 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-indigo-700 text-3xl" style="font-variation-settings: 'FILL' 1;">wifi</span>
                        </div>
                    </div>
                </div>

                {{-- Scrollable Directory --}}
                <div class="flex-grow overflow-y-auto pr-2 flex flex-col gap-3 scrollbar-thin scrollbar-thumb-slate-200 scrollbar-track-transparent">
                    
                    <template x-for="(loc, idx) in filtered" :key="idx">
                        {{-- WiFi List Item --}}
                        <div class="p-4 bg-white border border-slate-200 rounded-xl flex items-center justify-between hover:shadow-md hover:-translate-y-0.5 transition-all cursor-pointer group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-100 transition-colors">
                                    <span class="material-symbols-outlined" x-text="loc.icon"></span>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-slate-900" x-text="loc.name"></h4>
                                    <p class="text-sm text-slate-500">
                                        <span x-text="loc.type"></span> &bull; <span x-text="loc.status"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <p class="text-xs font-bold text-indigo-700" x-text="loc.distance"></p>
                            </div>
                        </div>
                    </template>

                    {{-- Empty State (If Search Not Found) --}}
                    <div x-show="filtered.length === 0" class="py-10 text-center text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2 opacity-50">location_off</span>
                        <p class="text-sm">Tidak ada titik WiFi yang cocok.</p>
                    </div>

                </div>
            </aside>

            {{-- ── Right Column — Map (60%) ── --}}
            <section class="w-full md:w-[60%] relative bg-slate-200 rounded-2xl overflow-hidden shadow-inner border border-slate-200 min-h-[400px]">
                
                {{-- Mock Map Background --}}
                <div class="absolute inset-0 z-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-30 mix-blend-multiply"></div>
                
                {{-- Overlay Markers (Rendered from Alpine data) --}}
                <div class="absolute inset-0 pointer-events-none">
                    <template x-for="(loc, idx) in locations" :key="'map-'+idx">
                        <div class="absolute pointer-events-auto cursor-pointer group flex flex-col items-center -translate-x-1/2 -translate-y-1/2"
                             :style="`top: ${loc.top}; left: ${loc.left};`">
                            <div class="bg-indigo-600 w-10 h-10 rounded-full flex items-center justify-center text-white border-2 border-white shadow-md transform group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">wifi</span>
                            </div>
                            <div class="mt-2 bg-white px-3 py-1.5 rounded-full shadow-sm border border-slate-200 transition-all group-hover:shadow-md">
                                <span class="text-xs font-semibold text-slate-800 whitespace-nowrap" x-text="loc.name"></span>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Map Controls --}}
                <div class="absolute right-6 bottom-6 flex flex-col gap-2 z-10">
                    <div class="flex flex-col bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
                        <button class="p-2.5 text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors border-b border-slate-100 flex items-center justify-center">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                        <button class="p-2.5 text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition-colors flex items-center justify-center">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                    </div>
                    <button class="bg-indigo-600 text-white p-3 rounded-xl shadow-md hover:bg-indigo-700 transition-colors mt-1 flex items-center justify-center focus:ring-2 focus:ring-indigo-300 focus:outline-none">
                        <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">my_location</span>
                    </button>
                </div>

            </section>

        </div>
    </div>
</section>