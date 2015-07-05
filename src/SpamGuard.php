<?php

namespace Fungku\SpamGuard;

use Fungku\SpamGuard\Services\HtmlGenerator;
use Fungku\SpamGuard\Services\MiddlewareAssigner;

class SpamGuard
{
    /**
     * @var HtmlGenerator
     */
    protected $htmlGenerator;

    /**
     * @var MiddlewareAssigner
     */
    protected $middlewareAssigner;

    /**
     * @param HtmlGenerator $htmlGenerator
     * @param MiddlewareAssigner $middlewareAssigner
     */
    public function __construct(HtmlGenerator $htmlGenerator, MiddlewareAssigner $middlewareAssigner)
    {
        $this->htmlGenerator = $htmlGenerator;
        $this->middlewareAssigner = $middlewareAssigner;
    }

    /**
     * @param  array $elements
     * @return string
     * @throws Exceptions\SpamGuardException
     */
    public function html($elements = [])
    {
        return $this->htmlGenerator->generate($elements);
    }

    /**
     * @param  \Illuminate\Routing\Controller $controller
     * @param  array $actions
     * @param  array $middleware
     * @return void
     */
    public function middleware($controller, $actions = [], $middleware = [])
    {
        $this->middlewareAssigner->assign($controller, $actions, $middleware);
    }
}
