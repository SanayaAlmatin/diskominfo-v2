<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tm_portal_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('category', ['admin', 'health', 'finance', 'safety'])->default('admin');
            $table->enum('icon_type', ['material', 'upload'])->default('material');
            $table->string('icon_material')->nullable();
            $table->string('icon_bg')->default('bg-blue-100');
            $table->string('icon_color')->default('text-blue-600');
            $table->string('logo_path')->nullable();
            $table->string('href')->default('#');
            $table->json('tags')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tm_portal_apps');
    }
};
