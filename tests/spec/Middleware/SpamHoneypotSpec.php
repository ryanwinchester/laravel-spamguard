<?php

namespace spec\Fungku\SpamGuard\Middleware;

use Fungku\SpamGuard\Validators\SpamHoneypotValidator;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamHoneypotSpec extends ObjectBehavior
{
    function let(Repository $config, Redirector $redirector)
    {
        $this->beConstructedWith($config, $redirector);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Middleware\SpamHoneypot');
    }

//    function it_passes(Request $request, SpamHoneypotValidator $validator)
//    {
//        // code here...
//
//        $next = (function(){throw new \Exception('Called execution of $next');});
//
//        $this
//            ->shouldThrow(new \Exception('Called execution of $next'))
//            ->during('handle',[$request, $next]);
//    }
}
