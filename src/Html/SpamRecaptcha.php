<?php

namespace Fungku\SpamGuard\Html;

class SpamRecaptcha extends Html
{
    public function html()
    {
        $site_key = $this->config->getRecaptchaSiteKey();

        $html = require "templates/recaptcha.php";

        return $html;
    }
}
