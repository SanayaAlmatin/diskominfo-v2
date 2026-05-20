<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\FooterPortalController;
use App\Http\Controllers\Admin\InfrastrukturTikController;
use App\Http\Controllers\Admin\FotoController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\ProgramVacancyController;
use App\Http\Controllers\Admin\SekilasController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisiMisiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WifiLocationController;
use App\Http\Middleware\TrackPageVisit;
use App\Livewire\Pages\GaleriPhoto;
use App\Livewire\Pages\InfrastrukturTik;
use App\Livewire\Pages\LowonganDetail;
use App\Livewire\Pages\LowonganIndex;
use App\Livewire\Pages\SekilasDiskominfo;
use App\Livewire\Pages\StatistikLayananInformasi;
use App\Livewire\Pages\StrukturOrganisasi;
use App\Livewire\Pages\VisiMisi;
use Illuminate\Support\Facades\Route;

// ─── Landing Page (Livewire) ──────────────────────────────────────────────────
Route::middleware([TrackPageVisit::class])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/profil/visi-misi', VisiMisi::class)->name('profil.visi-misi');
    Route::get('/profil/sekilas-diskominfo', SekilasDiskominfo::class)->name('profil.sekilas-diskominfo');
    Route::get('/profil/struktur-organisasi', StrukturOrganisasi::class)->name('profil.struktur-organisasi');

    Route::get('/unit-kerja/infrastruktur-tik', InfrastrukturTik::class)->name('unit-kerja.infrastruktur-tik');
    Route::get('/unit-kerja/statistik-layanan-informasi', StatistikLayananInformasi::class)->name('unit-kerja.statistik-layanan-informasi');

    Route::get('/lowongan', LowonganIndex::class)->name('lowongan.index');
    Route::get('/karir/{id}', LowonganDetail::class)->name('karir.show');

    Route::get('/galeri/foto', GaleriPhoto::class)->name('galeri.foto');
});

Route::get('/wifi/locations', [WifiLocationController::class, 'index'])
    ->middleware('throttle:120,1')
    ->name('wifi.locations');

// ─── CMS Admin ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Auth (guest only)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
        Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected CMS routes
    Route::middleware(['admin.auth'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Sekilas Diskominfo
        Route::resource('sekilas', SekilasController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin'])
            ->parameters(['sekilas' => 'sekilas']);

        // Visi & Misi
        Route::resource('visi-misi', VisiMisiController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin'])
            ->parameters(['visi-misi' => 'visiMisi']);

        // Struktur Organisasi
        Route::resource('struktur-organisasi', StrukturOrganisasiController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin'])
            ->parameters(['struktur-organisasi' => 'strukturOrganisasi']);

        // Infrastruktur TIK
        Route::resource('infrastruktur-tik', InfrastrukturTikController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin'])
            ->parameters(['infrastruktur-tik' => 'infrastrukturTik']);

        // Titik Wifi
        Route::resource('wifi', \App\Http\Controllers\Admin\WifiController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin']);

        // Statistik Layanan Informasi
        Route::resource('statistik', StatistikController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin']);
        Route::post('statistik/{statistik}/files', [StatistikController::class, 'storeFile'])
            ->name('statistik.storeFile')
            ->middleware(['admin.role:super-admin,admin']);
        Route::delete('statistik/{statistik}/files/{file}', [StatistikController::class, 'destroyFile'])
            ->name('statistik.destroyFile')
            ->middleware(['admin.role:super-admin']);

        // Program & Lowongan (Carousel)
        Route::resource('program-vacancy', ProgramVacancyController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin'])
            ->parameters(['program-vacancy' => 'programVacancy']);

        // Lowongan Karir
        Route::resource('lowongan', LowonganController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin']);

        // Galeri Foto
        Route::resource('foto', FotoController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin,admin']);

        // Konten Footer
        Route::middleware(['admin.role:super-admin,admin'])->group(function () {
            Route::get('footer/identitas', [FooterController::class, 'editIdentitas'])->name('footer.identitas');
            Route::put('footer/identitas', [FooterController::class, 'updateIdentitas'])->name('footer.identitas.update');

            Route::get('footer/sosmed', [FooterController::class, 'editSosmed'])->name('footer.sosmed');
            Route::put('footer/sosmed', [FooterController::class, 'updateSosmed'])->name('footer.sosmed.update');

            Route::get('footer/kontak', [FooterController::class, 'editKontak'])->name('footer.kontak');
            Route::put('footer/kontak', [FooterController::class, 'updateKontak'])->name('footer.kontak.update');

            Route::get('footer/utilitas', [FooterController::class, 'editUtilitas'])->name('footer.utilitas');
            Route::put('footer/utilitas', [FooterController::class, 'updateUtilitas'])->name('footer.utilitas.update');

            Route::resource('footer/portals', FooterPortalController::class)
                ->except(['show'])
                ->names([
                    'index'   => 'footer.portals.index',
                    'create'  => 'footer.portals.create',
                    'store'   => 'footer.portals.store',
                    'edit'    => 'footer.portals.edit',
                    'update'  => 'footer.portals.update',
                    'destroy' => 'footer.portals.destroy',
                ])
                ->parameters(['portals' => 'portal']);
        });

        // User Management (Super Admin only)
        Route::resource('users', UserController::class)
            ->except(['show'])
            ->middleware(['admin.role:super-admin']);
    });
});
