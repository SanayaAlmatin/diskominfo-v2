<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$images = \App\Models\TrNewsImage::take(5)->get();
foreach ($images as $img) {
    echo $img->image . "\n";
}
