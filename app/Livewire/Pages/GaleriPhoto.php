<?php

namespace App\Livewire\Pages;

use App\Models\TmFoto;
use Livewire\Component;
use Livewire\WithPagination;

class GaleriPhoto extends Component
{
    use WithPagination;

    public int $perPage = 12;

    public function setPerPage(int $n): void
    {
        $this->perPage = $n;
        $this->resetPage();
    }

    public function render()
    {
        $fotos = TmFoto::active()
            ->orderBy('sort_order')
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.pages.galeri-photo', compact('fotos'))
            ->extends('layouts.app', [
                'title'           => 'Galeri Foto — Diskominfo Kota Tangerang Selatan',
                'metaDescription' => 'Dokumentasi foto kegiatan dan program Diskominfo Kota Tangerang Selatan.',
                'metaKeywords'    => 'galeri foto, kegiatan, dokumentasi, diskominfo, tangerang selatan',
                'bodyClass'       => 'galeri-photo bg-[#F5F8FC] text-slate-900 antialiased selection:bg-[#F7D558]',
            ])
            ->section('content');
    }
}
