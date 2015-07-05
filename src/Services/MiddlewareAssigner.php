<?php

namespace Fungku\SpamGuard\Services;

class MiddlewareAssigner
{
    /**
     * Register the spamguard middleware on a controller.
     *
     * @param  \Illuminate\Routing\Controller $controller
     * @param  array $elements
     * @param  array $actions
     * @return void
     */
    public function assign($controller, array $elements, $actions = [])
    {
        foreach ($elements as $middleware) {
            $controller->middleware($middleware, $actions);
        }
    }
}