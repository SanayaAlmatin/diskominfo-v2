<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\TmJenisLowongan;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Insert default jenis lowongan
        $jenisList = [
            'pekerjaan' => ['nama' => 'Pekerjaan', 'warna' => 'bg-indigo-50 text-indigo-700 border-indigo-100'],
            'magang'    => ['nama' => 'Magang', 'warna' => 'bg-sky-50 text-sky-700 border-sky-100'],
            'program'   => ['nama' => 'Program', 'warna' => 'bg-emerald-50 text-emerald-700 border-emerald-100'],
            'kompetisi' => ['nama' => 'Kompetisi', 'warna' => 'bg-amber-50 text-amber-700 border-amber-100'],
        ];

        foreach ($jenisList as $key => $val) {
            TmJenisLowongan::firstOrCreate(
                ['nama' => $val['nama']],
                ['warna' => $val['warna']]
            );
        }

        // 2. Add id_jenis column
        Schema::table('tm_lowongan', function (Blueprint $table) {
            $table->foreignId('id_jenis')->nullable()->after('posisi')->constrained('tm_jenis_lowongan')->nullOnDelete();
        });

        // 3. Migrate data
        $lowongans = DB::table('tm_lowongan')->get();
        foreach ($lowongans as $lowongan) {
            if ($lowongan->jenis) {
                $namaJenis = match ($lowongan->jenis) {
                    'pekerjaan' => 'Pekerjaan',
                    'magang'    => 'Magang',
                    'program'   => 'Program',
                    'kompetisi' => 'Kompetisi',
                    default     => ucfirst($lowongan->jenis),
                };
                $jenisDb = TmJenisLowongan::firstOrCreate(['nama' => $namaJenis]);
                DB::table('tm_lowongan')->where('id', $lowongan->id)->update(['id_jenis' => $jenisDb->id]);
            }
        }

        // 4. Drop old jenis column
        Schema::table('tm_lowongan', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }

    public function down(): void
    {
        Schema::table('tm_lowongan', function (Blueprint $table) {
            // Re-add the enum column
            $table->enum('jenis', ['pekerjaan', 'magang', 'program', 'kompetisi'])->default('pekerjaan')->after('posisi');
        });

        // Migrate back
        $lowongans = DB::table('tm_lowongan')->get();
        foreach ($lowongans as $lowongan) {
            if ($lowongan->id_jenis) {
                $jenisDb = DB::table('tm_jenis_lowongan')->where('id', $lowongan->id_jenis)->first();
                if ($jenisDb) {
                    $enumVal = match (strtolower($jenisDb->nama)) {
                        'pekerjaan' => 'pekerjaan',
                        'magang'    => 'magang',
                        'program'   => 'program',
                        'kompetisi' => 'kompetisi',
                        default     => 'pekerjaan',
                    };
                    DB::table('tm_lowongan')->where('id', $lowongan->id)->update(['jenis' => $enumVal]);
                }
            }
        }

        Schema::table('tm_lowongan', function (Blueprint $table) {
            $table->dropForeign(['id_jenis']);
            $table->dropColumn('id_jenis');
        });
    }
};
