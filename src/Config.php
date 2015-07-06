<?php

namespace Fungku\SpamGuard;

class Config
{
    /**
     * These are the names of the registered middleware, as
     * well as the key used to refer to the html elements.
     *
     * @var array
     */
    public static $elements = [
        'spam_honeypot',
        'spam_timer',
    ];

    /**
     * The default error messages for each failing middleware validation.
     *
     * @var array
     */
    public static $messages = [
        'spam_honeypot' => 'I guess the honey was just too sweet for you.',
        'spam_timer'    => 'Please, not too fast or not too slow. There is a happy medium.',
    ];

    /**
     * The default times used for the spam_timer middleware.
     */
    const DEFAULT_MIN_TIME = 5;
    const DEFAULT_MAX_TIME = 3600;
}
