<?php

namespace Fungku\SpamGuard\Html;

class SpamTimer extends Html
{
    public function html()
    {
        $time = $this->encrypter->encrypt(time());

        $html = require "templates/timer.php";

        return $html;
    }
}
