<?php

namespace spec\Fungku\SpamGuard\Html;

use Illuminate\Contracts\Encryption\Encrypter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamTimerSpec extends ObjectBehavior
{
    function let(Encrypter $encrypter)
    {
        $this->beConstructedWith($encrypter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Html\SpamTimer');
    }

    function it_returns_the_timer_html(Encrypter $encrypter)
    {
        $time = time();
        $encrypter->encrypt($time)->willReturn($time);
        $html = require __DIR__ . "/../../../src/Html/templates/timer.php";

        $this->html()->shouldReturn($html);
    }
}
