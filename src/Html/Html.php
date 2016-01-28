<?php

namespace Fungku\SpamGuard\Html;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Encryption\Encrypter;

abstract class Html
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * @param Config $config
     * @param Encrypter $encrypter
     */
    public function __construct(Config $config, Encrypter $encrypter)
    {
        $this->config = $config;
        $this->encrypter = $encrypter;
    }
}
