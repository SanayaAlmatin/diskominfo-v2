<?php

namespace Database\Seeders;

use App\Models\TmFooterPortal;
use App\Models\TmFooterSetting;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    public function run(): void
    {
        TmFooterSetting::firstOrCreate([], [
            'nama_organisasi' => 'Dinas Komunikasi dan Informatika Kota Tangerang Selatan',
            'deskripsi'       => 'Dinas Komunikasi dan Informatika Kota Tangerang Selatan — mendorong transformasi digital demi layanan publik yang cerdas, terbuka, dan terpercaya.',
            'alamat'          => "Jl. Maruga No. 1, Serua, Ciputat,\nKota Tangerang Selatan,\nBanten 15414",
            'telepon'         => '(021) 538 8833',
            'email'           => 'diskominfo@tangselkota.go.id',
            'copyright_text'  => 'South Tangerang City Government — Dinas Komunikasi dan Informatika. All rights reserved.',
        ]);

        $portals = [
            ['label' => 'Dinkes Tangsel',    'url' => '#', 'sort_order' => 1],
            ['label' => 'Dispora Tangsel',   'url' => '#', 'sort_order' => 2],
            ['label' => 'DPMPTSP Tangsel',   'url' => '#', 'sort_order' => 3],
            ['label' => 'Dinas Pendidikan',  'url' => '#', 'sort_order' => 4],
            ['label' => 'BPBD Tangsel',      'url' => '#', 'sort_order' => 5],
            ['label' => 'Pemerintah Kota',   'url' => '#', 'sort_order' => 6],
        ];

        foreach ($portals as $portal) {
            TmFooterPortal::firstOrCreate(['label' => $portal['label']], $portal);
        }
    }
}
