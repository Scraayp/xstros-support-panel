<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;


class RouteServiceProvider
{

    public function boot()
    {
        parent::boot();

        // Define a custom rate limiter for login and registration
        RateLimiter::for('create', function ($request) {
            return Limit::perMinute(2); // 10 attempts per minute
        });

        RateLimiter::for('delete', function ($request) {
            return Limit::perMinute(5); // 10 attempts per minute
        });

    }

}
