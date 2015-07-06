<?php

namespace Fungku\SpamGuard\Middleware;

use Closure;

class SpamHoneypot extends Middleware
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
        $validator = $this->makeValidator('spam_honeypot');

        if (! $validator->validate($request)) {
            return $this->failedResponse('spam_honeypot');
        }

        return $next($request);
    }
}
