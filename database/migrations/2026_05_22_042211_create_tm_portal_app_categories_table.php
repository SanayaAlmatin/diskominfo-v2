<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tm_portal_app_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('icon_material')->nullable();
            $table->string('color_class')->nullable();
            $table->timestamps();
        });

        // Seed default categories
        $defaults = [
            [
                'name' => 'Administrasi',
                'icon_material' => 'description',
                'color_class' => 'text-blue-600 bg-blue-50 border-blue-200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kesehatan',
                'icon_material' => 'health_and_safety',
                'color_class' => 'text-emerald-600 bg-emerald-50 border-emerald-200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keuangan',
                'icon_material' => 'account_balance',
                'color_class' => 'text-amber-600 bg-amber-50 border-amber-200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Keamanan Publik',
                'icon_material' => 'security',
                'color_class' => 'text-red-600 bg-red-50 border-red-200',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        \Illuminate\Support\Facades\DB::table('tm_portal_app_categories')->insert($defaults);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_portal_app_categories');
    }
};
