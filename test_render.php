<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $items = \App\Models\TmNews::with(['category', 'author', 'tags'])->latest('published_at')->get();
    echo "Found " . $items->count() . " items.\n";
    $html = view('admin.berita.index', [
        'items' => $items,
        'categories' => \App\Models\TmCategory::all(),
        'totalBerita' => 0,
        'totalDraft' => 0,
        'totalPublished' => 0,
        'totalHeadline' => 0
    ])->render();
    echo "HTML length: " . strlen($html) . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
