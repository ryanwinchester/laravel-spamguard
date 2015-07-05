<?php

namespace spec\Fungku\SpamGuard\Validators;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamHoneypotValidatorSpec extends ObjectBehavior
{
    function let(Repository $config, Encrypter $encrypter)
    {
        $this->beConstructedWith($config, $encrypter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Validators\SpamHoneypotValidator');
    }

    function it_passes_when_honeypot_empty(Request $request)
    {
        $request->has('_guard_pot')->willReturn(false);

        $this->validate($request)->shouldReturn(true);
    }

    function it_fails_when_honeypot_set(Request $request)
    {
        $request->has('_guard_pot')->willReturn(true);

        $this->validate($request)->shouldReturn(false);
    }
}
