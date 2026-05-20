<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tm_footer_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_organisasi');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('email');
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('maps_embed_url')->nullable();
            $table->string('privacy_policy_url')->nullable();
            $table->string('terms_url')->nullable();
            $table->string('sitemap_url')->nullable();
            $table->string('copyright_text')->nullable();
            $table->timestamps();
        });

        Schema::create('tm_footer_portals', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_footer_portals');
        Schema::dropIfExists('tm_footer_settings');
    }
};
