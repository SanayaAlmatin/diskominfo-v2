@extends('admin.layouts.admin')
@section('title', 'Link Utilitas Footer')
@section('page-title', 'Konten Footer — Link Utilitas')

@section('content')
    <div class="max-w-2xl space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-gray-800">Link Utilitas & Copyright</h2>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 rounded-xl px-4 py-3 text-sm text-green-700 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <form method="POST" action="{{ route('admin.footer.utilitas.update') }}">
                @csrf @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL Privacy Policy</label>
                        <input type="url" name="privacy_policy_url"
                            value="{{ old('privacy_policy_url', $settings->privacy_policy_url) }}" placeholder="https://..."
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('privacy_policy_url') border-red-400 @enderror">
                        @error('privacy_policy_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL Terms of Use</label>
                        <input type="url" name="terms_url" value="{{ old('terms_url', $settings->terms_url) }}"
                            placeholder="https://..."
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('terms_url') border-red-400 @enderror">
                        @error('terms_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">URL Sitemap</label>
                        <input type="url" name="sitemap_url" value="{{ old('sitemap_url', $settings->sitemap_url) }}"
                            placeholder="https://..."
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sitemap_url') border-red-400 @enderror">
                        @error('sitemap_url')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="border-gray-100">

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Teks Copyright</label>
                        <p class="text-xs text-gray-400 mb-2">Teks ini ditampilkan di bagian bawah footer. Tahun akan
                            otomatis diperbarui.</p>
                        <input type="text" name="copyright_text"
                            value="{{ old('copyright_text', $settings->copyright_text) }}"
                            placeholder="South Tangerang City Government — Dinas Komunikasi dan Informatika. All rights reserved."
                            class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('copyright_text') border-red-400 @enderror">
                        @error('copyright_text')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-400 mt-1">Preview: &copy; {{ date('Y') }}
                            {{ old('copyright_text', $settings->copyright_text) }}</p>
                    </div>
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
