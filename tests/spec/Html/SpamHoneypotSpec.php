<?php

namespace spec\Fungku\SpamGuard\Html;

use Illuminate\Contracts\Encryption\Encrypter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamHoneypotSpec extends ObjectBehavior
{
    function let(Encrypter $encrypter)
    {
        $this->beConstructedWith($encrypter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Html\SpamHoneypot');
    }

    function it_returns_the_honeypot_html()
    {
        $html = require __DIR__ . "/../../../src/Html/templates/honeypot.php";

        $this->html()->shouldReturn($html);
    }
}
