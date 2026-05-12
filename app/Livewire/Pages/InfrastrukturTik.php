<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class InfrastrukturTik extends Component
{
    public function render()
    {
        return view('livewire.pages.infrastruktur-tik')
            ->extends('layouts.app', [
                'title' => 'Bidang Infrastruktur TIK - Diskominfo Tangerang Selatan',
                'metaDescription' => 'Bidang Pengelolaan Infrastruktur TIK Dinas Komunikasi dan Informatika Kota Tangerang Selatan — tugas, fungsi, dan tim kerja.',
                'metaKeywords' => 'Infrastruktur TIK, Jaringan, Pusat Data, Menara Telekomunikasi, Diskominfo Tangsel',
                'bodyClass' => 'unit-kerja-tik bg-slate-50 text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]',
            ])
            ->section('content');
    }
}
