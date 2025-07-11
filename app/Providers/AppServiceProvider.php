<?php

namespace App\Providers;

use App\Models\TelaahanStaff;
use App\Observers\TelaahanStaffObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        TelaahanStaff::observe(TelaahanStaffObserver::class);

        // if (config('app.env') === 'local') {
        //     URL::forceScheme('https');
        // }
    }
}
