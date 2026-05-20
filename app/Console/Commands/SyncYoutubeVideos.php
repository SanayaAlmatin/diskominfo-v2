<?php

namespace App\Console\Commands;

use App\Services\YoutubeService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncYoutubeVideos extends Command
{
    protected $signature = 'youtube:sync';

    protected $description = 'Sync latest videos dari YouTube channel via YouTube Data API v3';

    public function handle(YoutubeService $youtubeService): int
    {
        $this->info('Starting YouTube video sync...');

        try {
            $count = $youtubeService->syncVideos();

            $this->info("✓ Successfully synced {$count} video(s)");
            Log::info("YouTube sync command executed: {$count} videos synced");

            return 0;
        } catch (\Exception $e) {
            $this->error('Error during YouTube sync: ' . $e->getMessage());
            Log::error('YouTube sync command failed: ' . $e->getMessage());

            return 1;
        }
    }
}
