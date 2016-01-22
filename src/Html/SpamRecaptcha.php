<?php

namespace Fungku\SpamGuard\Html;

class SpamRecaptcha extends Html
{
    public function html()
    {
        $site_key = config('spamguard.recaptcha.site_key');

        $html = require "templates/recaptcha.php";

        return $html;
    }
}
