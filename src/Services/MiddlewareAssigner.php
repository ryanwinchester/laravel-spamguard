<?php

namespace Fungku\SpamGuard\Services;

class MiddlewareAssigner
{
    /**
     * Register the spamguard middleware on a controller.
     *
     * @param  \Illuminate\Routing\Controller $controller
     * @param  array $options
     * @return void
     */
    public static function assign($controller, $options = [])
    {
        $aliases = filter_elements($options);

        foreach ($aliases as $middleware) {
            $controller->middleware($middleware);
        }
    }
}