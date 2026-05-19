<?php

namespace App\Livewire\Pages;

use App\Models\TmLowongan;
use Illuminate\Support\Str;
use Livewire\Component;

class LowonganDetail extends Component
{
    public TmLowongan $lowongan;

    public function mount(int $id): void
    {
        $this->lowongan = TmLowongan::buka()->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.pages.lowongan-detail', ['lowongan' => $this->lowongan])
            ->extends('layouts.app', [
                'title'           => $this->lowongan->posisi . ' - Diskominfo Tangerang Selatan',
                'metaDescription' => Str::limit(strip_tags($this->lowongan->deskripsi ?? ''), 160),
                'metaKeywords'    => 'Lowongan ' . $this->lowongan->posisi . ', Karir Diskominfo, Tangsel',
                'bodyClass'       => 'lowongan-detail bg-[#F5F8FC] text-slate-900 selection:bg-indigo-100 selection:text-indigo-900',
            ])
            ->section('content');
    }
}
