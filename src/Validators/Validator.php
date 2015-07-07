<?php

namespace Fungku\SpamGuard\Validators;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Encryption\Encrypter;

abstract class Validator
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

    /**
     * Validate the form request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $options
     * @return mixed
     */
    abstract public function validate($request, $options = []);
}
