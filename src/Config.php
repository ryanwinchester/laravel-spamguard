<?php

namespace Fungku\SpamGuard;

class Config
{
    public static $elements = [
        'spam_honeypot',
        'spam_timer',
    ];

    const DEFAULT_MIN_TIME = 5;
    const DEFAULT_MAX_TIME = 3600;
}
