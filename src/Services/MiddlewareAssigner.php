<?php

namespace Fungku\SpamGuard\Services;

use Fungku\SpamGuard\Config;

class MiddlewareAssigner
{
    /**
     * Register the spamguard middleware on a controller.
     *
     * @param  \Illuminate\Routing\Controller $controller
     * @param  array $actions
     * @param  array $elements
     * @return void
     */
    public function assign($controller, $actions = [], $elements = [])
    {
        $elements = $elements ?: Config::$elements;

        foreach ($elements as $middleware) {
            $controller->middleware($middleware, $actions);
        }
    }
}