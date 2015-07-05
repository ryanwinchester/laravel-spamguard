<?php

namespace Fungku\SpamGuard\Providers;

use Illuminate\Support\ServiceProvider;

class SpamGuardConfigServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/spamguard.php' => config_path('spamguard.php'),
        ], 'config');
    }

    public function register()
    {
        //
    }
}