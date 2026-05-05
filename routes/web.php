<?php

use App\Livewire\Pages\VisiMisi;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/profil/visi-misi', VisiMisi::class)->name('profil.visi-misi');
