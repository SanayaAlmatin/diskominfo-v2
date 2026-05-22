<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\TmNews;

class MigrateBeritaLama extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:berita-lama {--truncate : Kosongkan tabel berita baru sebelum migrasi}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrasi data berita dari tabel tmkegiatan (kominfo_db) ke portal_kominfo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai proses migrasi berita lama...');

        if ($this->option('truncate')) {
            if ($this->confirm('Anda yakin ingin mengosongkan tabel tm_news dan tr_news_images terlebih dahulu?')) {
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                DB::table('tr_news_images')->truncate();
                DB::table('tm_news')->truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                $this->info('Tabel berhasil dikosongkan.');
            }
        }

        // Hitung total data dari tmkegiatan
        try {
            $totalData = DB::connection('mysql_old')->table('tmkegiatan')->count();
        } catch (\Exception $e) {
            $this->error('Gagal terkoneksi ke database lama (mysql_old). Pastikan konfigurasi di .env dan database.php sudah benar.');
            $this->error($e->getMessage());
            return;
        }
        
        $this->info("Ditemukan {$totalData} berita di database lama.");

        $bar = $this->output->createProgressBar($totalData);
        $bar->start();

        // Ambil data dari tabel tmkegiatan
        DB::connection('mysql_old')->table('tmkegiatan')
            ->orderBy('kegiatanid')
            ->chunk(100, function ($beritaLamaChunk) use ($bar) {
                foreach ($beritaLamaChunk as $lama) {
                    
                    // Ambil gambar-gambar dari trkegiatanimg
                    $gambarLama = DB::connection('mysql_old')->table('trkegiatanimg')
                        ->where('kegiatanid', $lama->kegiatanid)
                        ->get();
                        
                    $descriptionImage = null;
                    if ($gambarLama->count() > 0) {
                        $firstImage = $gambarLama->first();
                        // NOTE: Secara struktur data lama, gambar kegiatan disimpan sesuai format:
                        $descriptionImage = 'berita-portal-kominfo/' . $lama->kegiatanid . '/' . $firstImage->img;
                    }
                    
                    // Slug generation
                    $slug = Str::slug($lama->n_kegiatan);
                    if (empty($slug)) {
                        $slug = 'berita-' . $lama->kegiatanid;
                    }
                    
                    // Cek jika ID sudah ada (upsert)
                    $news = TmNews::find($lama->kegiatanid);
                    if (!$news) {
                        $news = new TmNews();
                        $news->id = $lama->kegiatanid; // Force ID
                    }
                    
                    $news->title = $lama->n_kegiatan ?: 'Tanpa Judul';
                    $news->slug = $slug;
                    $news->content = $lama->v_kegiatan ?: '';
                    $news->excerpt = $lama->deskripsi ?: Str::limit(strip_tags($lama->v_kegiatan), 150);
                    $news->category_id = 1; // Default Kategori
                    $news->author_id = 1; // Default Author Admin
                    $news->status = $lama->c_status == 1 ? 1 : 0;
                    
                    // Validasi tanggal (mencegah error timestamp MySQL untuk tanggal tidak valid)
                    $isValidDate = function($date) {
                        return !empty($date) && $date !== '0000-00-00 00:00:00' && $date !== '1000-01-01 00:00:00' && strtotime($date) > 0;
                    };

                    $validEntryDate = $isValidDate($lama->d_entry) ? $lama->d_entry : now();
                    $validUpdateDate = $isValidDate($lama->d_update) ? $lama->d_update : $validEntryDate;

                    $news->published_at = $validEntryDate;
                    $news->created_at = $validEntryDate;
                    $news->updated_at = $validUpdateDate;
                    $news->description_image = $descriptionImage;
                    
                    $news->save();
                    
                    // Simpan gambar tambahan ke tr_news_images
                    DB::table('tr_news_images')->where('news_id', $lama->kegiatanid)->delete();
                    
                    $imagesToInsert = [];
                    foreach ($gambarLama as $img) {
                        $imagesToInsert[] = [
                            'news_id' => $lama->kegiatanid,
                            'image' => 'berita-portal-kominfo/' . $lama->kegiatanid . '/' . $img->img,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                    
                    if (count($imagesToInsert) > 0) {
                        DB::table('tr_news_images')->insert($imagesToInsert);
                    }

                    $bar->advance();
                }
            });

        $bar->finish();
        $this->newLine(2);
        $this->info('Migrasi Berita Selesai!');
    }
}
