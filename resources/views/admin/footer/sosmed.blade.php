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
                        <p class="text-xs text-gray-400 mb-2">
                            Buka Google Maps → klik lokasi → bagikan → embed peta → salin URL dari atribut <code
                                class="bg-gray-100 px-1 rounded">src</code> pada tag <code
                                class="bg-gray-100 px-1 rounded">&lt;iframe&gt;</code>.
                        </p>
                        <textarea name="maps_embed_url" rows="4" placeholder="https://www.google.com/maps/embed?pb=..."
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 @error('maps_embed_url') border-red-400 @enderror">{{ old('maps_embed_url', $settings->maps_embed_url) }}</textarea>
                        @error('maps_embed_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($settings->maps_embed_url)
                        <div>
                            <p class="text-xs text-gray-500 mb-2">Preview peta saat ini:</p>
                            <div class="rounded-xl overflow-hidden aspect-video border border-gray-100">
                                <iframe src="{{ $settings->maps_embed_url }}" class="w-full h-full" style="border:0;"
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
