<?php

namespace App\Providers;

use App\Models\TmFooterPortal;
use App\Models\TmFooterSetting;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureDefaults();
        $this->shareFooterData();
    }

    protected function shareFooterData(): void
    {
        View::composer('*', function ($view) {
            static $footerSettings = null;
            static $footerPortals = null;

            if ($footerSettings === null) {
                try {
                    $footerSettings = TmFooterSetting::getSettings();
                    $footerPortals  = TmFooterPortal::active()->ordered()->get();
                } catch (\Throwable) {
                    $footerSettings = new TmFooterSetting();
                    $footerPortals  = collect();
                }
            }

            $view->with('footerSettings', $footerSettings)
                 ->with('footerPortals', $footerPortals);
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
