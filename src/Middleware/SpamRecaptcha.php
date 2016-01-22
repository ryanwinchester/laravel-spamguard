<?php

namespace Fungku\SpamGuard\Middleware;

use Closure;

class SpamRecaptcha extends Middleware
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
        $validator = $this->makeValidator('spam_recaptcha');

        if (! $validator->validate($request)) {
            return $this->failedResponse('spam_recaptcha', $request->ajax());
        }

        return $next($request);
    }
}
