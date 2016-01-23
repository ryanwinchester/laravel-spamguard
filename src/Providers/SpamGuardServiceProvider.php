<?php

namespace Fungku\SpamGuard\Providers;

use Fungku\SpamGuard\Middleware;
use Fungku\SpamGuard\SpamGuard;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SpamGuardServiceProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        // Register Middleware
        $router->middleware('spamguard', Middleware\SpamGuard::class);
        $router->middleware('spam_honeypot', Middleware\SpamHoneypot::class);
        $router->middleware('spam_timer', Middleware\SpamTimer::class);
        $router->middleware('spam_recaptcha', Middleware\SpamRecaptcha::class);

        $this->publishes([
            __DIR__.'/../../config/spamguard.php' => config_path('spamguard.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->bind('spamguard', function() {
            return $this->app->make(SpamGuard::class);
        });

        $this->mergeConfigFrom(__DIR__.'/../../config/spamguard.php', 'spamguard');
    }
}
