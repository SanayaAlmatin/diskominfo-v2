<?php

namespace Database\Seeders;

use App\Models\TmPortalApp;
use Illuminate\Database\Seeder;

class PortalAppSeeder extends Seeder
{
    public function run(): void
    {
        $apps = [
            [
                'name' => 'Sisumaker',
                'category' => 'admin',
                'description' => 'Manajemen persuratan dinas dan dokumen administratif warga.',
                'icon_type' => 'material',
                'icon_material' => 'description',
                'icon_bg' => 'bg-indigo-100',
                'icon_color' => 'text-indigo-600',
                'href' => '#',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'Simponi',
                'category' => 'finance',
                'description' => 'Portal pembayaran dan pelaporan pajak daerah.',
                'icon_type' => 'material',
                'icon_material' => 'payments',
                'icon_bg' => 'bg-sky-100',
                'icon_color' => 'text-sky-600',
                'href' => '#',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 20,
            ],
            [
                'name' => 'Tangsel Sehat',
                'category' => 'health',
                'description' => 'Reservasi jadwal dokter dan antrean fasilitas kesehatan lokal.',
                'icon_type' => 'material',
                'icon_material' => 'medical_information',
                'icon_bg' => 'bg-emerald-100',
                'icon_color' => 'text-emerald-600',
                'href' => '#',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 30,
            ],
            [
                'name' => 'e-SPPD',
                'category' => 'admin',
                'description' => 'Pengajuan perjalanan dinas elektronik bagi aparatur sipil.',
                'icon_type' => 'material',
                'icon_material' => 'flight_takeoff',
                'icon_bg' => 'bg-amber-100',
                'icon_color' => 'text-amber-600',
                'href' => '#',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 40,
            ],
            [
                'name' => 'SiPATU',
                'category' => 'safety',
                'description' => 'Sistem pemantauan terpadu keamanan lingkungan warga.',
                'icon_type' => 'material',
                'icon_material' => 'security',
                'icon_bg' => 'bg-red-100',
                'icon_color' => 'text-red-600',
                'href' => '#',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 50,
            ],
            [
                'name' => 'e-Absen',
                'category' => 'admin',
                'description' => 'Pencatatan kehadiran digital untuk pegawai kota.',
                'icon_type' => 'material',
                'icon_material' => 'fingerprint',
                'icon_bg' => 'bg-violet-100',
                'icon_color' => 'text-violet-600',
                'href' => '#',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 60,
            ],
            [
                'name' => 'BPJS Online',
                'category' => 'health',
                'description' => 'Layanan informasi dan pendaftaran jaminan kesehatan.',
                'icon_type' => 'material',
                'icon_material' => 'medical_services',
                'icon_bg' => 'bg-teal-100',
                'icon_color' => 'text-teal-600',
                'href' => '#',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 70,
            ],
            [
                'name' => 'SiGa',
                'category' => 'safety',
                'description' => 'Sistem siaga pelaporan kondisi darurat masyarakat.',
                'icon_type' => 'material',
                'icon_material' => 'emergency',
                'icon_bg' => 'bg-orange-100',
                'icon_color' => 'text-orange-600',
                'href' => '#',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 80,
            ],
            [
                'name' => 'e-Musrenbang',
                'category' => 'admin',
                'description' => 'Perencanaan pembangunan partisipatif dari tingkat wilayah.',
                'icon_type' => 'material',
                'icon_material' => 'groups',
                'icon_bg' => 'bg-blue-100',
                'icon_color' => 'text-blue-600',
                'href' => '#',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 90,
            ],
            [
                'name' => 'SimKes',
                'category' => 'health',
                'description' => 'Sistem informasi terpadu puskesmas dan rumah sakit.',
                'icon_type' => 'material',
                'icon_material' => 'local_hospital',
                'icon_bg' => 'bg-green-100',
                'icon_color' => 'text-green-600',
                'href' => '#',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 100,
            ],
        ];

        foreach ($apps as $app) {
            TmPortalApp::create($app);
        }
    }
}
