<?php

namespace Fungku\SpamGuard;

use Fungku\SpamGuard\Services\HtmlGenerator;
use Fungku\SpamGuard\Services\MiddlewareAssigner;

class SpamGuard
{
    /**
     * @param array $options
     * @return string
     * @throws Exceptions\SpamGuardException
     */
    public function html($options = [])
    {
        return HtmlGenerator::generate($options);
    }

    /**
     * @param $controller
     * @param array $options
     * @return void
     */
    public function middleware($controller, $options = [])
    {
        MiddlewareAssigner::assign($controller, $options);
    }
}