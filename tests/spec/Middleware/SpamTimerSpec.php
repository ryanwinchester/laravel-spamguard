<?php

namespace spec\Fungku\SpamGuard\Middleware;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Routing\Redirector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamTimerSpec extends ObjectBehavior
{
    function let(Repository $config, ResponseFactory $response, Redirector $redirector)
    {
        $this->beConstructedWith($config, $response, $redirector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Middleware\SpamTimer');
    }
}
