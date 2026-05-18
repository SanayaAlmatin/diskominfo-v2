<?php

namespace App\Livewire\Pages;

use App\Models\TmVisiMisi;
use Livewire\Component;

class VisiMisi extends Component
{
    public function render()
    {
        $visiMisi = TmVisiMisi::where('is_active', true)->orderBy('sort_order')->get();
        $vision   = $visiMisi->firstWhere('tipe', 'visi')?->konten ?? '';
        $missions = $visiMisi->where('tipe', 'misi')->pluck('konten')->toArray();

        return view('livewire.pages.visi-misi', compact('vision', 'missions'))
            ->extends('layouts.app', [
                'title' => 'Visi dan Misi - Diskominfo Tangerang Selatan',
                'metaDescription' => 'Visi dan misi pembangunan Kota Tangerang Selatan menuju kota unggul, lestari, saling terkoneksi, efektif, dan efisien.',
                'metaKeywords' => 'Visi Misi Tangsel, Visi Misi Tangerang Selatan, Diskominfo Tangerang Selatan, Kota Lestari, Tangsel Unggul',
                'bodyClass' => 'profile-visi-misi bg-[#F5F8FC] text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]',
            ])
            ->section('content');
    }
}
