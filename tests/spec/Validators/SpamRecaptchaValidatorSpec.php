<?php

namespace spec\Fungku\SpamGuard\Validators;

use Illuminate\Http\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReCaptcha\ReCaptcha;
use ReCaptcha\Response;

class SpamRecaptchaValidatorSpec extends ObjectBehavior
{
    function let(Recaptcha $recaptcha)
    {
        $this->beConstructedWith($recaptcha);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Validators\SpamRecaptchaValidator');
    }

    function it_passes_on_recaptcha_success(Request $request, Recaptcha $recaptcha, Response $response)
    {
        $recaptcha->verify(Argument::any(), Argument::any())->willReturn($response);
        $response->isSuccess()->willReturn(true);

        $this->validate($request)->shouldReturn(true);
    }

    function it_fails_on_recaptcha_fail(Request $request, Recaptcha $recaptcha, Response $response)
    {
        $recaptcha->verify(Argument::any(), Argument::any())->willReturn($response);
        $response->isSuccess()->willReturn(false);

        $this->validate($request)->shouldReturn(false);
    }
}
