<?php

namespace App\Livewire\Pages;

use App\Models\TmLowongan;
use Livewire\Component;
use Livewire\WithPagination;

class LowonganIndex extends Component
{
    use WithPagination;

    public int $perPage = 6;

    public function setPerPage(int $n): void
    {
        $this->perPage = $n;
        $this->resetPage();
    }

    public function render()
    {
        $lowongan = TmLowongan::buka()
            ->orderBy('tanggal_tutup')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.pages.lowongan-index', compact('lowongan'))
            ->extends('layouts.app', [
                'title'           => 'Lowongan & Program — Diskominfo Kota Tangerang Selatan',
                'metaDescription' => 'Temukan lowongan pekerjaan, program magang, dan kompetisi terbuka dari Diskominfo Kota Tangerang Selatan.',
                'metaKeywords'    => 'lowongan kerja, magang, program, kompetisi, diskominfo, tangerang selatan',
                'bodyClass'       => 'lowongan-index bg-[#F5F8FC] text-slate-900 antialiased selection:bg-indigo-100 selection:text-indigo-900',
            ])
            ->section('content');
    }
}
