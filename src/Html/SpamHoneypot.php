<?php

namespace Fungku\SpamGuard\Html;

class SpamHoneypot extends Html
{
    public function html()
    {
        $html = require "templates/honeypot.php";

        return $html;
    }
}
