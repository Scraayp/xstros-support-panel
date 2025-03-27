<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

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
        Cashier::calculateTaxes();

        // Event::listen(SocialiteWasCalled::class, function (SocialiteWasCalled $event) {
        //     $event->extendSocialite('github', \SocialiteProviders\Github\Provider::class);
        //     $event->extendSocialite('discord', \SocialiteProviders\Discord\Provider::class);
        //     // $event->extendSocialite('microsoft', \SocialiteProviders\Microsoft\Provider::class);
        // });
    }
}
