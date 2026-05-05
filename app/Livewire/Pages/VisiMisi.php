<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class VisiMisi extends Component
{
    public string $vision = 'Terwujudnya Tangsel Unggul, Menuju Kota Lestari, Saling Terkoneksi, Efektif dan Efisien';

    /**
     * @var list<string>
     */
    public array $missions = [
        'Pembangunan Sumber Daya Manusia (SDM) yang Unggul;',
        'Pembangunan Infrastruktur yang Saling Terkoneksi;',
        'Membangun Kota yang Lestari;',
        'Meningkatkan Ekonomi Berbasis Nilai Tambah Tinggi di Sektor Ekonomi Kreatif;',
        'Membangun Birokrasi yang Efektif dan Efisien.',
    ];

    public function render()
    {
        return view('livewire.pages.visi-misi')
            ->extends('layouts.app', [
                'title' => 'Visi dan Misi - Diskominfo Tangerang Selatan',
                'metaDescription' => 'Visi dan misi pembangunan Kota Tangerang Selatan menuju kota unggul, lestari, saling terkoneksi, efektif, dan efisien.',
                'metaKeywords' => 'Visi Misi Tangsel, Visi Misi Tangerang Selatan, Diskominfo Tangerang Selatan, Kota Lestari, Tangsel Unggul',
                'bodyClass' => 'profile-visi-misi bg-[#F5F8FC] text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]',
            ])
            ->section('content');
    }
}
