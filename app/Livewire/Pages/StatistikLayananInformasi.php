<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class StatistikLayananInformasi extends Component
{
    public function render()
    {
        return view('livewire.pages.statistik-layanan-informasi')
            ->extends('layouts.app', [
                'title' => 'Bidang Statistik & Layanan Informasi Publik - Diskominfo Tangerang Selatan',
                'metaDescription' => 'Bidang Penyelenggaraan Statistik & Layanan Informasi Publik Dinas Komunikasi dan Informatika Kota Tangerang Selatan — tugas, fungsi, dan tim kerja.',
                'metaKeywords' => 'Statistik Sektoral, Layanan Informasi Publik, PPID, Satu Data, Diskominfo Tangsel',
                'bodyClass' => 'unit-kerja-statistik bg-slate-50 text-slate-900 selection:bg-[#F7D558] selection:text-[#044FA0]',
            ])
            ->section('content');
    }
}
