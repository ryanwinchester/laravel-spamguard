<?php

namespace Fungku\SpamGuard\Services;

use Fungku\SpamGuard\Config;
use Illuminate\Routing\Controller;

class MiddlewareAssigner
{
    /**
     * Register the spamguard middleware on a controller.
     *
     * @param  Controller $controller
     * @param  array $actions
     * @param  array $elements
     * @return void
     */
    public function assign(Controller $controller, $actions = [], $elements = [])
    {
        $elements = $elements ?: Config::$elements;

        foreach ($elements as $middleware) {
            $controller->middleware($middleware, $actions);
        }
    }
}
