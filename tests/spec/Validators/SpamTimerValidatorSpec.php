<?php

namespace spec\Fungku\SpamGuard\Validators;

use Fungku\SpamGuard\Config;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SpamTimerValidatorSpec extends ObjectBehavior
{
    function let(Config $config, Encrypter $encrypter)
    {
        $config->getDefaultMinTime()->willReturn(5);
        $config->getDefaultMaxTime()->willReturn(3600);

        $this->beConstructedWith($config, $encrypter);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Fungku\SpamGuard\Validators\SpamTimerValidator');
    }

    function it_passes_with_a_reasonable_time(Encrypter $encrypter, Request $request)
    {
        $time = strtotime("120 seconds ago", time());

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request)->shouldReturn(true);
    }

    function it_passes_with_a_reasonable_quick_time(Encrypter $encrypter, Request $request)
    {
        $time = strtotime("10 seconds ago", time());

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request)->shouldReturn(true);
    }

    function it_fails_when_too_fast(Encrypter $encrypter, Request $request)
    {
        $time = strtotime("2 seconds ago", time());

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request)->shouldReturn(false);
    }

    function it_fails_when_too_slow(Encrypter $encrypter, Request $request)
    {
        $time = strtotime("3601 seconds ago", time());

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request)->shouldReturn(false);
    }

    function it_fails_when_time_is_future(Encrypter $encrypter, Request $request)
    {
        $time = strtotime("120 seconds from now", time());

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request)->shouldReturn(false);
    }

    function it_passes_with_parameters(Encrypter $encrypter, Request $request)
    {
        $params = [
            'min_time' => 15,
            'max_time' => 30,
        ];

        $time = strtotime("20 seconds ago", time());

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request, $params)->shouldReturn(true);
    }

    function it_fails_with_parameters(Encrypter $encrypter, Request $request)
    {
        $params = [
            'min_time' => 15,
            'max_time' => 30,
        ];

        $time = strtotime("10 seconds ago", time());

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request, $params)->shouldReturn(false);
    }

    function it_fails_on_decrypt_exception(Encrypter $encrypter, Request $request)
    {
        $request->get('_guard_opened')->willReturn(null);
        $encrypter->decrypt(null)->willThrow(new DecryptException());

        $this->validate($request)->shouldReturn(false);
    }

    function it_fails_with_string(Encrypter $encrypter, Request $request)
    {
        $time = date("Y-m-d H:i:s", strtotime("30 seconds ago"));

        $request->get('_guard_opened')->willReturn($time);
        $encrypter->decrypt($time)->willReturn($time);

        $this->validate($request)->shouldReturn(false);
    }
}
