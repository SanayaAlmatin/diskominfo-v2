<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CmsRolesSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Seed roles
        $roles = [
            ['name' => 'super-admin', 'display_name' => 'Super Admin', 'description' => 'Akses penuh ke semua fitur CMS termasuk manajemen pengguna.'],
            ['name' => 'admin',       'display_name' => 'Admin',       'description' => 'Dapat mengelola konten landing page namun tidak dapat mengakses manajemen pengguna.'],
            ['name' => 'guest',       'display_name' => 'Guest',       'description' => 'Akses hanya-baca ke dashboard CMS.'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                array_merge($role, ['created_at' => $now, 'updated_at' => $now])
            );
        }

        // Create a default super-admin user if none exists
        if (DB::table('users')->count() === 0) {
            $userId = DB::table('users')->insertGetId([
                'username'   => 'superadmin',
                'nama'       => 'Super Administrator',
                'email'      => 'admin@diskominfo.go.id',
                'role'       => 'super-admin',
                'password'   => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $superAdminRole = DB::table('roles')->where('name', 'super-admin')->first();
            if ($superAdminRole && $userId) {
                DB::table('user_has_roles')->insert([
                    'user_id' => $userId,
                    'role_id' => $superAdminRole->id,
                ]);
            }
        }
    }
}
