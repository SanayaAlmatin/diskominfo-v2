<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TmNews;
use Illuminate\Support\Facades\Storage;

class FixBeritaImages extends Command
{
    protected $signature = 'fix:berita-images {--dry-run : Tampilkan perubahan tanpa mengeksekusi}';
    protected $description = 'Perbaiki path gambar berita migrasi dan verifikasi file gambar ada di storage';

    public function handle()
    {
        $this->info('🔍 Memulai pengecekan gambar berita...');
        $this->newLine();

        $disk = Storage::disk('public');

        $news = TmNews::withTrashed()->whereNotNull('description_image')->get();

        $stats = [
            'total'     => $news->count(),
            'valid'     => 0,
            'fixed'     => 0,
            'not_found' => 0,
        ];

        $isDryRun = $this->option('dry-run');

        foreach ($news as $item) {
            $currentPath = $item->description_image;

            // 1. Cek apakah file sudah valid (path ada di storage)
            if ($disk->exists($currentPath)) {
                $stats['valid']++;
                continue;
            }

            // 2. Path tidak valid, coba cari file di folder berita-portal-kominfo/{id}/
            $folderPath = 'berita-portal-kominfo/' . $item->id;

            if (! $disk->exists($folderPath)) {
                $this->warn("❌ ID {$item->id}: Folder tidak ditemukan — {$folderPath}");
                $stats['not_found']++;
                
                if (! $isDryRun) {
                    $item->description_image = null;
                    $item->save();
                    $this->line("🔧 ID {$item->id}: description_image di-set null karena file tidak ada.");
                }
                continue;
            }

            // Ambil file pertama yang ada di folder
            $files = $disk->files($folderPath);

            if (empty($files)) {
                $this->warn("❌ ID {$item->id}: Folder ada tapi kosong — {$folderPath}");
                $stats['not_found']++;
                
                if (! $isDryRun) {
                    $item->description_image = null;
                    $item->save();
                    $this->line("🔧 ID {$item->id}: description_image di-set null karena file tidak ada.");
                }
                continue;
            }

            // Ambil file gambar pertama (prioritaskan jpg/jpeg/png/webp)
            $imageFile = null;
            $imageExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            foreach ($files as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, $imageExtensions)) {
                    $imageFile = $file;
                    break;
                }
            }

            if (! $imageFile) {
                $this->warn("❌ ID {$item->id}: Tidak ada file gambar di folder — {$folderPath}");
                $stats['not_found']++;
                
                if (! $isDryRun) {
                    $item->description_image = null;
                    $item->save();
                    $this->line("🔧 ID {$item->id}: description_image di-set null karena file tidak ada.");
                }
                continue;
            }

            // Fix path
            if ($isDryRun) {
                $this->line("🔧 ID {$item->id}: Akan diubah dari [{$currentPath}] → [{$imageFile}]");
            } else {
                $item->description_image = $imageFile;
                $item->save();
                $this->line("✅ ID {$item->id}: Fixed [{$currentPath}] → [{$imageFile}]");
            }

            $stats['fixed']++;
        }

        $this->newLine();
        $this->info('📊 Ringkasan:');
        $this->table(
            ['Metrik', 'Jumlah'],
            [
                ['Total berita dengan gambar', $stats['total']],
                ['Gambar valid (file ditemukan)', $stats['valid']],
                ['Gambar di-fix path-nya', $stats['fixed']],
                ['File tidak ditemukan', $stats['not_found']],
            ]
        );

        if ($isDryRun) {
            $this->warn('⚠️  Mode dry-run: tidak ada perubahan yang disimpan. Jalankan tanpa --dry-run untuk menyimpan.');
        }
    }
}
