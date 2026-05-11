<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class SekilasDiskominfo extends Component
{
    public function render()
    {
        return view('livewire.pages.sekilas-diskominfo')
            ->extends('layouts.app', [
                'title' => 'Sekilas Diskominfo - Diskominfo Tangerang Selatan',
                'metaDescription' => 'Dinas Komunikasi dan Informatika Kota Tangerang Selatan — profil singkat, sejarah, tugas pokok, dan fungsi organisasi.',
                'metaKeywords' => 'Sekilas Diskominfo, Profil Diskominfo, Tangerang Selatan, Komunikasi Informatika, SOTK',
                'bodyClass' => 'profile-sekilas-diskominfo bg-slate-50 text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]',
            ])
            ->section('content');
    }
}
