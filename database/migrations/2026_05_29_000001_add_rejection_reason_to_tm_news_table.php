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
        Schema::table('tm_news', function (Blueprint $table) {
            if (!Schema::hasColumn('tm_news', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('status');
            }
            if (!Schema::hasColumn('tm_news', 'verifikator_id')) {
                $table->unsignedBigInteger('verifikator_id')->nullable()->after('author_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_news', function (Blueprint $table) {
            $table->dropColumn(['rejection_reason', 'verifikator_id']);
        });
    }
};
