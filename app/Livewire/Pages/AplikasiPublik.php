<?php

namespace App\Livewire\Pages;

use App\Models\TmPortalApp;
use Livewire\Component;

class AplikasiPublik extends Component
{
    public string $search = '';
    public string $activeTab = 'all';

    public function selectTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function resetFilter(): void
    {
        $this->search = '';
        $this->activeTab = 'all';
    }

    public function render()
    {
        $allApps = TmPortalApp::active()->orderBy('sort_order')->orderBy('id', 'desc')->get();

        $filteredApps = $allApps
            ->when($this->activeTab !== 'all', fn ($c) => $c->where('category', $this->activeTab))
            ->when($this->search !== '', fn ($c) => $c->filter(
                fn ($app) => str_contains(strtolower($app->name), strtolower($this->search))
            ))
            ->values();

        return view('livewire.pages.aplikasi-publik', [
            'filteredApps'  => $filteredApps,
            'totalApps'     => $allApps->count(),
        ])->extends('layouts.app', [
            'title'          => 'Layanan Aplikasi Publik — Diskominfo Tangerang Selatan',
            'metaDescription' => 'Akses seluruh layanan digital Kota Tangerang Selatan dalam satu portal terpadu — administrasi, kesehatan, keuangan, dan keamanan publik.',
            'metaKeywords'   => 'aplikasi publik, layanan digital, Tangerang Selatan, Diskominfo, smart city, e-government',
            'bodyClass'      => 'aplikasi-publik bg-[#F8FAFC] text-slate-900 antialiased selection:bg-[#F7D558] selection:text-[#044FA0]',
        ])->section('content');
    }
}
