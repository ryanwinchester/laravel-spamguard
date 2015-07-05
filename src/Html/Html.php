<?php

namespace Fungku\SpamGuard\Html;

use Illuminate\Contracts\Encryption\Encrypter;

abstract class Html
{
    /**
     * @var Encrypter
     */
    protected $encrypter;

    /**
     * @param Encrypter $encrypter
     */
    public function __construct(Encrypter $encrypter)
    {
        $this->encrypter = $encrypter;
    }
}
