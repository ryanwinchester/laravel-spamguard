<?php

namespace spec\Fungku\SpamGuard\Middleware;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\Redirector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamGuardSpec extends ObjectBehavior
{
    function let(Repository $config, Redirector $redirector)
    {
        $this->beConstructedWith($config, $redirector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Middleware\SpamGuard');
    }
}
