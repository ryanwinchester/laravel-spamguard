<?php

namespace Fungku\SpamGuard\Validators;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Encryption\Encrypter;

abstract class Validator
{
    /**
     * Validate the form request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  array $options
     * @return mixed
     */
    abstract public function validate($request, $options = []);
}
