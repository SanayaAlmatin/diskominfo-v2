<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // admin -> verifikator
        if (!DB::table('roles')->where('name', 'verifikator')->exists()) {
            DB::table('roles')->where('name', 'admin')->update([
                'name' => 'verifikator',
                'display_name' => 'Verifikator'
            ]);
        }

        // super-admin -> admin
        if (DB::table('roles')->where('name', 'super-admin')->exists()) {
            DB::table('roles')->where('name', 'super-admin')->update([
                'name' => 'admin',
                'display_name' => 'Admin'
            ]);
        }

        // guest -> pejabat-dinas
        if (!DB::table('roles')->where('name', 'pejabat-dinas')->exists()) {
            DB::table('roles')->where('name', 'guest')->update([
                'name' => 'pejabat-dinas',
                'display_name' => 'Pejabat Dinas'
            ]);
        }
        
        // Ensure users with the legacy column get updated (optional safeguard)
        // Change the column to string first to avoid ENUM truncation errors
        \Illuminate\Support\Facades\Schema::table('users', function (\Illuminate\Database\Schema\Blueprint $table) {
            $table->string('role')->nullable()->change();
        });

        DB::table('users')->where('role', 'super-admin')->update(['role' => 'admin']);
        DB::table('users')->where('role', 'guest')->update(['role' => 'pejabat-dinas']);
        // If we update 'admin' to 'verifikator' in users table it might conflict with super-admin converted to admin
        // so we need to do it carefully.
        // Actually the CMS mainly relies on the roles table now, the fallback is in User::getCmsRole()
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // pejabat-dinas -> guest
        DB::table('roles')->where('name', 'pejabat-dinas')->update([
            'name' => 'guest',
            'display_name' => 'Guest'
        ]);

        // verifikator -> admin
        DB::table('roles')->where('name', 'verifikator')->update([
            'name' => 'admin',
            'display_name' => 'Admin'
        ]);

        // admin -> super-admin
        DB::table('roles')->where('name', 'admin')->where('display_name', 'Admin')->update([
            'name' => 'super-admin',
            'display_name' => 'Super Admin'
        ]);
    }
};
