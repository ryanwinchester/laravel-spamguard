<?php

namespace Fungku\SpamGuard;

use Illuminate\Contracts\Config\Repository;

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
        'spam_recaptcha',
    ];

    /**
     * The default error messages for each failing middleware validation.
     *
     * @var array
     */
    public static $messages = [
        'spam_honeypot' => 'I guess the honey was just too sweet for you.',
        'spam_timer' => 'Please, not too fast or not too slow. There is a happy medium.',
        'spam_recaptcha' => 'Please look more human.',
    ];

    /**
     * The default times used for the spam_timer middleware.
     */
    const DEFAULT_MIN_TIME = 5;
    const DEFAULT_MAX_TIME = 3600;

    /**
     * @var Repository
     */
    protected $config;

    /**
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * @return int
     */
    public function getDefaultMinTime()
    {
        return $this->config->get("spamguard.min_time", static::DEFAULT_MIN_TIME);
    }

    /**
     * @return int
     */
    public function getDefaultMaxTime()
    {
        return $this->config->get("spamguard.max_time", static::DEFAULT_MAX_TIME);
    }

    /**
     * @return string|null
     */
    public function getRecaptchaSecret()
    {
        return $this->config->get("spamguard.recaptcha.secret");
    }
}
