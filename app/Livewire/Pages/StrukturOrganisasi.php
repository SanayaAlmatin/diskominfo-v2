<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class StrukturOrganisasi extends Component
{
    public function render()
    {
        return view('livewire.pages.struktur-organisasi')
            ->extends('layouts.app', [
                'title'           => 'Struktur Organisasi - Diskominfo Tangerang Selatan',
                'metaDescription' => 'Struktur organisasi Dinas Komunikasi dan Informatika Kota Tangerang Selatan tahun 2026.',
                'metaKeywords'    => 'Struktur Organisasi, SOTK, Diskominfo, Tangerang Selatan',
                'bodyClass'       => 'profile-struktur-org bg-slate-50 text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]',
            ])
            ->section('content');
    }
}
