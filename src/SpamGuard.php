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
     * @param  array $options
     * @return string
     * @throws Exceptions\SpamGuardException
     */
    public function html($options = [])
    {
        $elements = $this->filterElements($options);

        return $this->htmlGenerator->generate($elements);
    }

    /**
     * @param  \Illuminate\Routing\Controller $controller
     * @param  array $actions
     * @param  array $options
     * @return void
     */
    public function middleware($controller, $actions = [], $options = [])
    {
        $elements = $this->filterElements($options);

        $this->middlewareAssigner->assign($controller, $elements, $actions);
    }

    /**
     * Filter the spamguard elements by an options array.
     *
     * @param  array $options
     * @return string
     */
    protected function filterElements($options = [])
    {
        $elements = Config::$elements;

        if (isset($options['only'])) {
            return $options['only'];
        }

        if (isset($options['except'])) {
            array_forget($elements, $options['except']);
        }

        return $elements;
    }
}