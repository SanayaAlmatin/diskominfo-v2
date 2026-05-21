@extends('admin.layouts.admin')
@section('title', 'Media Sosial & Peta')
@section('page-title', 'Konten Footer — Media Sosial & Peta')

@section('content')
    <div class="max-w-2xl space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Media Sosial & Peta Lokasi</h2>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl px-4 py-3 text-sm text-green-700 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.footer.sosmed.update') }}">
                @csrf @method('PUT')

                <div class="space-y-5">
                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Link Media Sosial</p>

                    @php
                        $socialFields = [
                            [
                                'name' => 'instagram_url',
                                'label' => 'Instagram',
                                'placeholder' => 'https://instagram.com/...',
                            ],
                            ['name' => 'tiktok_url', 'label' => 'TikTok', 'placeholder' => 'https://tiktok.com/@...'],
                            [
                                'name' => 'twitter_url',
                                'label' => 'Twitter / X',
                                'placeholder' => 'https://twitter.com/...',
                            ],
                            [
                                'name' => 'facebook_url',
                                'label' => 'Facebook',
                                'placeholder' => 'https://facebook.com/...',
                            ],
                            ['name' => 'youtube_url', 'label' => 'YouTube', 'placeholder' => 'https://youtube.com/...'],
                        ];
                    @endphp

                    @foreach ($socialFields as $field)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">{{ $field['label'] }}</label>
                            <input type="url" name="{{ $field['name'] }}"
                                value="{{ old($field['name'], $settings->{$field['name']}) }}"
                                placeholder="{{ $field['placeholder'] }}"
                                class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error($field['name']) border-red-400 @enderror">
                            @error($field['name'])
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <hr class="border-gray-100">

                    <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Peta Lokasi Kantor</p>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Google Maps Embed URL</label>

                        {{-- Step-by-step guide --}}
                        <div
                            class="bg-blue-50 border border-blue-100 rounded-lg px-4 py-3 mb-3 text-xs text-blue-800 space-y-1">
                            <p class="font-semibold mb-1">Cara mendapatkan Embed URL yang benar:</p>
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Buka <strong>Google Maps</strong> dan cari lokasi yang diinginkan</li>
                                <li>Klik tombol <strong>"Bagikan"</strong> (ikon berbagi)</li>
                                <li>Pilih tab <strong>"Sematkan peta"</strong></li>
                                <li>Klik <strong>"SALIN HTML"</strong></li>
                                <li>Paste seluruh kode <code class="bg-blue-100 px-1 rounded font-mono">&lt;iframe src="..."&gt;</code> <em>atau</em> hanya URL dari atribut <code class="bg-blue-100 px-1 rounded font-mono">src</code> — sistem otomatis mengekstrak URL-nya</li>
                            </ol>
                            <p class="mt-2 text-blue-600">URL yang benar diawali dengan: <code
                                    class="bg-blue-100 px-1 rounded font-mono">https://www.google.com/maps/embed?pb=...</code>
                            </p>
                        </div>

                        <textarea name="maps_embed_url" id="maps_embed_url" rows="3"
                            placeholder="Paste URL atau seluruh kode <iframe src=&quot;...&quot;> dari Google Maps"
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 @error('maps_embed_url') border-red-400 @enderror">{{ old('maps_embed_url', $settings->maps_embed_url) }}</textarea>

                        {{-- Client-side warning for wrong URL --}}
                        <div id="maps-url-warning"
                            class="hidden mt-2 flex items-start gap-2 bg-amber-50 border border-amber-200 rounded-lg px-3 py-2 text-xs text-amber-800">
                            <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-amber-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                            </svg>
                            <span>URL ini tampaknya bukan embed URL. Pastikan URL diawali dengan <code
                                    class="bg-amber-100 px-1 rounded font-mono">https://www.google.com/maps/embed</code>,
                                bukan link share biasa.</span>
                        </div>

                        @error('maps_embed_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($settings->maps_embed_url)
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Preview peta saat ini:</p>
                            <div class="rounded-xl overflow-hidden aspect-video border border-gray-100" style="color-scheme: light;">
                                <iframe src="{{ $settings->maps_embed_url }}" class="w-full h-full" style="border:0; color-scheme: light;"
                                    allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit"
                        class="px-5 py-2 rounded-lg text-sm font-semibold text-white hover:opacity-90 transition-opacity"
                        style="background-color: #0F2044;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const mapsInput = document.getElementById('maps_embed_url');
    const mapsWarning = document.getElementById('maps-url-warning');

    function checkMapsUrl() {
        const val = mapsInput.value.trim();
        if (val && !val.startsWith('https://www.google.com/maps/embed')) {
            mapsWarning.classList.remove('hidden');
        } else {
            mapsWarning.classList.add('hidden');
        }
    }

    mapsInput.addEventListener('input', checkMapsUrl);
    checkMapsUrl(); // check on page load if value already exists
</script>
@endpush
