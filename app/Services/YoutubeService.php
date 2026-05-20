<?php

namespace App\Services;

use App\Models\TmYoutubeVideo;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class YoutubeService
{
    private string $apiKey;
    private string $baseUrl = 'https://www.googleapis.com/youtube/v3';
    private ?string $channelId;

    public function __construct()
    {
        $this->apiKey = config('services.youtube.api_key');
        $this->channelId = config('services.youtube.channel_id') ?: null;
    }

    /**
     * Resolve channel ID dari handle jika belum diset
     */
    public function resolveChannelId(string $handle): ?string
    {
        $handle = ltrim($handle, '@');

        $response = Http::timeout(10)->get("{$this->baseUrl}/channels", [
            'part'      => 'id',
            'forHandle' => $handle,
            'key'       => $this->apiKey,
        ]);

        if (!$response->successful()) {
            Log::error('YouTube API resolve channel failed: ' . $response->body());
            return null;
        }

        $items = $response->json('items');
        return $items[0]['id'] ?? null;
    }

    /**
     * Fetch video terbaru dari channel menggunakan Search API
     */
    private function fetchVideoIds(string $channelId, int $maxResults = 10): array
    {
        $response = Http::timeout(10)->get("{$this->baseUrl}/search", [
            'part'       => 'snippet',
            'channelId'  => $channelId,
            'type'       => 'video',
            'order'      => 'date',
            'maxResults' => $maxResults,
            'key'        => $this->apiKey,
        ]);

        if (!$response->successful()) {
            Log::error('YouTube API search failed: ' . $response->body());
            return [];
        }

        $videos = [];
        foreach ($response->json('items') ?? [] as $item) {
            $videos[$item['id']['videoId']] = [
                'youtube_id'   => $item['id']['videoId'],
                'title'        => $item['snippet']['title'],
                'description'  => $item['snippet']['description'],
                'channel_name' => $item['snippet']['channelTitle'],
                'published_at' => $item['snippet']['publishedAt'],
                'thumbnail_url' => $item['snippet']['thumbnails']['high']['url']
                    ?? $item['snippet']['thumbnails']['medium']['url']
                    ?? $item['snippet']['thumbnails']['default']['url'],
            ];
        }

        return $videos;
    }

    /**
     * Ambil duration dari Videos API (ISO 8601 → readable)
     */
    private function fetchVideoDurations(array $videoIds): array
    {
        if (empty($videoIds)) {
            return [];
        }

        $response = Http::timeout(10)->get("{$this->baseUrl}/videos", [
            'part' => 'contentDetails',
            'id'   => implode(',', $videoIds),
            'key'  => $this->apiKey,
        ]);

        if (!$response->successful()) {
            Log::error('YouTube API videos detail failed: ' . $response->body());
            return [];
        }

        $durations = [];
        foreach ($response->json('items') ?? [] as $item) {
            $durations[$item['id']] = $this->parseDuration($item['contentDetails']['duration']);
        }

        return $durations;
    }

    /**
     * Convert ISO 8601 duration (PT1H24M5S) → readable (1:24:05)
     */
    private function parseDuration(string $iso): string
    {
        preg_match('/PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?/', $iso, $m);

        $h = (int) ($m[1] ?? 0);
        $i = (int) ($m[2] ?? 0);
        $s = (int) ($m[3] ?? 0);

        if ($h > 0) {
            return sprintf('%d:%02d:%02d', $h, $i, $s);
        }

        return sprintf('%d:%02d', $i, $s);
    }

    /**
     * Sync semua video ke database
     */
    public function syncVideos(): int
    {
        if (empty($this->apiKey)) {
            Log::error('YOUTUBE_API_KEY tidak diset di .env');
            return 0;
        }

        $channelId = $this->channelId;

        // Auto-resolve channel ID dari handle jika belum diset
        if (empty($channelId)) {
            $handle = config('services.youtube.channel_handle');
            if (empty($handle)) {
                Log::error('YOUTUBE_CHANNEL_ID atau YOUTUBE_CHANNEL_HANDLE harus diset di .env');
                return 0;
            }
            $channelId = $this->resolveChannelId($handle);
            if (!$channelId) {
                Log::error('Gagal resolve channel ID dari handle: ' . $handle);
                return 0;
            }
            Log::info("Channel ID resolved: {$channelId}");
        }

        $videos = $this->fetchVideoIds($channelId, 10);

        if (empty($videos)) {
            Log::info('Tidak ada video ditemukan dari YouTube API');
            return 0;
        }

        // Fetch duration untuk semua video sekaligus (1 API call)
        $durations = $this->fetchVideoDurations(array_keys($videos));

        $syncedCount = 0;
        foreach ($videos as $videoId => $data) {
            try {
                TmYoutubeVideo::updateOrCreate(
                    ['youtube_id' => $videoId],
                    array_merge($data, [
                        'duration'   => $durations[$videoId] ?? 'N/A',
                        'synced_at'  => now(),
                    ])
                );
                $syncedCount++;
            } catch (Exception $e) {
                Log::error("Gagal sync video {$videoId}: " . $e->getMessage());
            }
        }

        Log::info("YouTube API sync selesai: {$syncedCount} video");

        return $syncedCount;
    }
}
