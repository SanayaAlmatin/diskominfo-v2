<?php

use App\Livewire\Pages\InfrastrukturTik;
use App\Livewire\Pages\SekilasDiskominfo;
use App\Livewire\Pages\StatistikLayananInformasi;
use App\Livewire\Pages\StrukturOrganisasi;
use App\Livewire\Pages\VisiMisi;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/profil/visi-misi', VisiMisi::class)->name('profil.visi-misi');
Route::get('/profil/sekilas-diskominfo', SekilasDiskominfo::class)->name('profil.sekilas-diskominfo');
Route::get('/profil/struktur-organisasi', StrukturOrganisasi::class)->name('profil.struktur-organisasi');

Route::get('/unit-kerja/infrastruktur-tik', InfrastrukturTik::class)->name('unit-kerja.infrastruktur-tik');
Route::get('/unit-kerja/statistik-layanan-informasi', StatistikLayananInformasi::class)->name('unit-kerja.statistik-layanan-informasi');
