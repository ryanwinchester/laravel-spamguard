<?php

namespace spec\Fungku\SpamGuard\Middleware;

use Fungku\SpamGuard\Validators\SpamHoneypotValidator;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamHoneypotSpec extends ObjectBehavior
{
    function let(Repository $config, ResponseFactory $response, Redirector $redirector)
    {
        $this->beConstructedWith($config, $response, $redirector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Middleware\SpamHoneypot');
    }
}
