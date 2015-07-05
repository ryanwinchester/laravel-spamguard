<?php

namespace Fungku\SpamGuard\Validators;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Encryption\Encrypter;

abstract class Validator
{
    /**
     * @var Repository
     */
    protected $config;

    /**
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * @param Repository $config
     * @param Encrypter $encrypter
     */
    public function __construct(Repository $config, Encrypter $encrypter)
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
