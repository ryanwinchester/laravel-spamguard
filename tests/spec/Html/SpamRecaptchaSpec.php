<?php

namespace spec\Fungku\SpamGuard\Html;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Encryption\Encrypter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamRecaptchaSpec extends ObjectBehavior
{
    function let(Config $config, Encrypter $encrypter)
    {
        $this->beConstructedWith($config, $encrypter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Html\SpamRecaptcha');
    }

    function it_returns_the_recaptcha_html(Config $config, Encrypter $encrypter)
    {
        $site_key = '1234567890';
        $config->getRecaptchaSiteKey()->willReturn($site_key);
        $html = require __DIR__ . "/../../../src/Html/templates/recaptcha.php";

        $this->html()->shouldReturn($html);
    }
}
