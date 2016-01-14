<?php

namespace Fungku\SpamGuard\Middleware;

use Closure;
use Fungku\SpamGuard\Config;

class SpamGuard extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Fungku\SpamGuard\Exceptions\SpamException
     */
    public function handle($request, Closure $next)
    {
        $validators = $this->makeValidators();

        foreach ($validators as $middleware => $validator) {
            if (! $validator->validate($request)) {
                return $this->failedResponse($middleware, $request->ajax());
            }
        }

        return $next($request);
    }

    /**
     * Get all the validators.
     *
     * @return array
     */
    private function makeValidators()
    {
        $validators = [];

        foreach (Config::$elements as $middleware) {
            $validators[$middleware] = $this->makeValidator($middleware);
        }

        return $validators;
    }
}
