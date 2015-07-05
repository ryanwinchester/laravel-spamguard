<?php

namespace Fungku\SpamGuard\Facades;

use Illuminate\Support\Facades\Facade;

class SpamGuard extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'spamguard';
    }
}
