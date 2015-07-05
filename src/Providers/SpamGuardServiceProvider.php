<?php

namespace Fungku\SpamGuard\Providers;

use Fungku\SpamGuard\Middleware;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SpamGuardServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        // Register Middleware
        $router->middleware('spam_honeypot', Middleware\SpamHoneypot::class);
        $router->middleware('spam_timer', Middleware\SpamTimer::class);
    }

    public function register()
    {
        //
    }
}